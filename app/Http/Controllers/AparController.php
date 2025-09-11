<?php

namespace App\Http\Controllers;

use App\Models\Apar;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;

class AparController extends Controller
{
    /**
     * Menampilkan daftar semua APAR.
     */
    public function index()
    {
        $apars = Apar::all();
        return view('apars.index', compact('apars'));
    }

    /**
     * Menampilkan formulir untuk membuat APAR baru.
     */
    public function create()
    {
        return view('apars.create');
    }

    /**
     * Menyimpan APAR baru ke database dan membuat QR Code.
     */
    public function store(Request $request)
    {
        try {
            // Validasi data yang masuk
            $validatedData = $request->validate([
                'nomor_seri' => 'required|unique:apars',
                'jenis_apar' => 'required',
                'kapasitas' => 'required',
                'kepemilikan' => 'required|in:Perusahaan,Subkon',
                'nama_subkon' => 'nullable|required_if:kepemilikan,Subkon',
                'gedung' => 'required',
                'lantai' => 'required',
                'koordinat_x' => 'required',
                'koordinat_y' => 'required',
                'status_posisi' => 'required|in:Permanen,Non-permanen',
                'tanggal_kadaluarsa' => 'required|date',
            ]);

            // Jika kepemilikan adalah Subkon, simpan nama subkon di kolom 'kepemilikan'
            if ($validatedData['kepemilikan'] === 'Subkon') {
                $validatedData['kepemilikan'] = $validatedData['nama_subkon'];
            }
            
            // Buat APAR baru
            $apar = Apar::create($validatedData);

            // Buat dan simpan QR Code
            $qrPath = public_path('qrcodes');
            if (!File::exists($qrPath)) {
                File::makeDirectory($qrPath, 0755, true, true);
            }
            $qrCodeName = 'apar-' . $apar->id . '.svg';
            QrCode::format('svg')->size(200)->generate($apar->id, $qrPath . '/' . $qrCodeName);

            // Simpan path QR Code ke database
            $apar->qr_code_path = $qrCodeName;
            $apar->save();

            return redirect()->route('admin.apars.index')->with('success', 'APAR berhasil ditambahkan!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Menampilkan detail APAR.
     */
    public function show(Apar $apar)
    {
        return view('apars.show', compact('apar'));
    }

    /**
     * Menampilkan formulir untuk mengedit APAR.
     */
    public function edit(Apar $apar)
    {
        return view('apars.edit', compact('apar'));
    }

    /**
     * Memperbarui data APAR di database.
     */
    public function update(Request $request, Apar $apar)
    {
        try {
            $validatedData = $request->validate([
                'nomor_seri' => 'required|unique:apars,nomor_seri,' . $apar->id,
                'jenis_apar' => 'required',
                'kapasitas' => 'required',
                'kepemilikan' => 'required|in:Perusahaan,Subkon',
                'nama_subkon' => 'nullable|required_if:kepemilikan,Subkon',
                'gedung' => 'required',
                'lantai' => 'required',
                'koordinat_x' => 'required',
                'koordinat_y' => 'required',
                'status_posisi' => 'required|in:Permanen,Non-permanen',
                'tanggal_kadaluarsa' => 'required|date',
            ]);

            // Jika kepemilikan adalah "Subkon", simpan nama subkon yang diinput
            if ($validatedData['kepemilikan'] === 'Subkon') {
                $apar->kepemilikan = $validatedData['nama_subkon']; 
            } else {
                // Jika bukan "Subkon", pastikan nilai kepemilikan sesuai dengan yang dipilih
                $apar->kepemilikan = $validatedData['kepemilikan'];
            }
            
            $apar->nomor_seri = $validatedData['nomor_seri'];
            $apar->jenis_apar = $validatedData['jenis_apar'];
            $apar->kapasitas = $validatedData['kapasitas'];
            $apar->gedung = $validatedData['gedung'];
            $apar->lantai = $validatedData['lantai'];
            $apar->status_posisi = $validatedData['status_posisi'];
            $apar->tanggal_kadaluarsa = $validatedData['tanggal_kadaluarsa'];
            $apar->koordinat_x = $validatedData['koordinat_x'];
            $apar->koordinat_y = $validatedData['koordinat_y'];

            $apar->save(); 

            return redirect()->route('admin.apars.index')->with('success', 'Data APAR berhasil diperbarui!');
        
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
    
    /**
     * Menghapus APAR dari database.
     */
    public function destroy(Apar $apar)
    {
        // Menghapus file QR Code yang terkait.
        if ($apar->qr_code_path) {
            File::delete(public_path('qrcodes/' . $apar->qr_code_path));
        }
        
        $apar->delete();

        return redirect()->route('admin.apars.index')->with('success', 'APAR berhasil dihapus!');
    }
}
