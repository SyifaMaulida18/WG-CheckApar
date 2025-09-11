<?php

namespace App\Http\Controllers;

use App\Models\Apar;
use App\Models\Inspeksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InspeksiController extends Controller
{
    /**
     * Menampilkan halaman untuk memindai QR Code.
     */
    public function scan()
    {
        return view('inspeksi.scan');
    }
    
    /**
     * Menampilkan detail APAR dan form inspeksi setelah QR Code dipindai.
     */
    public function showAparDetail(Apar $apar)
    {
        $user = Auth::user();
        
        // Memeriksa hak inspeksi berdasarkan kepemilikan APAR
        if ($user->role === 'so') {
            if ($user->subkon_nama === null && $apar->kepemilikan === 'Perusahaan') {
                // SO Perusahaan berhak menginspeksi APAR Perusahaan.
            } else if ($user->subkon_nama !== null && $apar->kepemilikan === $user->subkon_nama) {
                // SO Subkon berhak menginspeksi APAR Subkon miliknya.
            } else {
                return redirect()->route('inspeksi.scan')->with('error', 'Anda tidak berhak menginspeksi APAR ini.');
            }
        }

        return view('inspeksi.form', compact('apar'));
    }

    /**
     * Menyimpan hasil inspeksi ke database.
     */
    public function store(Request $request)
    {
        try {
            // Validasi data formulir
            $validatedData = $request->validate([
                'apar_id' => 'required|exists:apars,id',
                'kondisi_tekanan' => 'required',
                'kondisi_selang' => 'required',
                'kondisi_segel' => 'required',
                'catatan' => 'nullable',
                'foto_tekanan' => 'image|nullable|max:2048',
                'foto_selang' => 'image|nullable|max:2048',
                'foto_segel' => 'image|nullable|max:2048',
            ]);

            // Logika penyimpanan foto ke direktori 'inspeksi-photos'
            if ($request->hasFile('foto_tekanan')) {
                $validatedData['foto_tekanan'] = $request->file('foto_tekanan')->store('inspeksi-photos', 'public');
            }
            if ($request->hasFile('foto_selang')) {
                $validatedData['foto_selang'] = $request->file('foto_selang')->store('inspeksi-photos', 'public');
            }
            if ($request->hasFile('foto_segel')) {
                $validatedData['foto_segel'] = $request->file('foto_segel')->store('inspeksi-photos', 'public');
            }

            // Tambahkan user_id dari pengguna yang sedang login
            $validatedData['user_id'] = Auth::id();
            
            // Buat entri inspeksi baru
            Inspeksi::create($validatedData);

            // Perbarui status inspeksi APAR menjadi 'aktif'
            $apar = Apar::find($validatedData['apar_id']);
            if ($apar) {
                $apar->status_inspeksi = 'aktif';
                $apar->save();
            }

            return redirect()->route('inspeksi.scan')->with('success', 'Inspeksi berhasil disimpan!');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Tangkap kesalahan validasi
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Tangkap kesalahan umum lainnya
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
}
