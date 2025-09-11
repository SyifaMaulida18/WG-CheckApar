<?php

namespace App\Http\Controllers;

use App\Models\Apar;
use App\Models\Inspeksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InspeksiExport;

class AdminController extends Controller
{
    /**
     * Menampilkan dashboard admin dengan statistik ringkasan.
     */
    public function dashboard()
    {
        $totalApar = Apar::count();
        $aparAktif = Apar::where('status_inspeksi', 'aktif')->count();
        $aparNonAktif = Apar::where('status_inspeksi', 'non-aktif')->count();
        $totalInspeksi = Inspeksi::count();

        return view('admin.dashboard', compact('totalApar', 'aparAktif', 'aparNonAktif', 'totalInspeksi'));
    }

    /**
     * Menampilkan daftar semua pengguna.
     */
    public function index() // Nama metode diubah dari usersIndex
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Menampilkan formulir untuk membuat pengguna baru.
     */
    public function create() // Nama metode diubah dari usersCreate
    {
        return view('admin.users.create');
    }

    /**
     * Menyimpan pengguna baru ke database.
     */
    public function store(Request $request) // Nama metode diubah dari usersStore
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,so',
            'subkon_nama' => 'nullable|string|max:255|required_if:role,so',
        ]);
        User::create($validatedData);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    /**
     * Menampilkan formulir untuk mengedit pengguna.
     */
    public function edit(User $user) // Nama metode diubah dari usersEdit
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Memperbarui data pengguna di database.
     */
    public function update(Request $request, User $user) // Nama metode diubah dari usersUpdate
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,so',
            'subkon_nama' => 'nullable|string|max:255|required_if:role,so',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'nullable|string|min:8|confirmed';
        }

        $validatedData = $request->validate($rules);
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->role = $validatedData['role'];
        $user->subkon_nama = ($validatedData['role'] === 'so') ? $validatedData['subkon_nama'] : null;

        if ($request->filled('password')) {
            $user->password = $validatedData['password'];
        }
        
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Data pengguna berhasil diperbarui!');
    }

    /**
     * Menghapus pengguna dari database.
     */
    public function destroy(User $user) // Nama metode diubah dari usersDestroy
    {
        if (Auth::id() === $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak bisa menghapus akun Anda sendiri!');
        }
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus!');
    }

    /**
     * Mengekspor laporan inspeksi ke file Excel.
     */
    public function exportInspeksi()
    {
        $fileName = 'Laporan-Inspeksi-' . now()->format('Y-m-d_His') . '.xlsx';
        return Excel::download(new InspeksiExport, $fileName);
    }
}