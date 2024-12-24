<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Tambahkan ini untuk hash password

class DataUser extends Controller
{
    public function index(Request $request)
    {
        // Simpan URL terakhir ke session sebelum mengunjungi halaman index
        session(['previous_url' => url()->full()]);

        // Ambil query pencarian
        $search = $request->input('search');
        $role = $request->input('role');

        // Query dasar untuk mengambil semua admin dan urutkan berdasarkan status Online, lalu updated_at
        $query = Admin::orderByRaw("CASE WHEN status = 'Online' THEN 1 ELSE 2 END")
            ->orderBy('updated_at', 'desc');

        // Filter berdasarkan pencarian di semua kolom
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('email_admin', 'like', '%' . $search . '%')
                    ->orWhere('nama_admin', 'like', '%' . $search . '%')
                    ->orWhere('posisi', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%');
            });
        }

        // Filter berdasarkan role (posisi admin)
        if (!empty($role)) {
            $query->where('posisi', '=', $role);
        }

        // Ambil posisi unik untuk dropdown
        $roles = Admin::distinct()->pluck('posisi')->filter()->toArray(); // Ambil posisi unik dan hilangkan null
        
        // Lakukan paginasi dengan limit 7
        $admins = $query->paginate(7);

        // Hitung jumlah total, online, dan offline
        $adminCount = Admin::count(); // Hitung total admin di database
        $onlineCount = Admin::where('status', 'Online')->count(); // Jumlah admin yang online
        $offlineCount = Admin::where('status', 'Offline')->count(); // Jumlah admin yang offline

        // Kirim data ke view
        return view('dashboard.dataUser.datauser', compact('admins', 'adminCount', 'onlineCount', 'offlineCount', 'search', 'role', 'roles'));
    }
    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
            return redirect()->back()->with('error', 'Admin tidak ditemukan.');
        }

        // Validasi input untuk update admin (kecuali password)
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email_admin,' . $id, // Unik kecuali ID yang sedang diupdate
            'posisi' => 'required|string|max:50',
            'foto_admin' => 'nullable|mimes:jpg,jpeg,png|max:10000',
            'status' => 'required|in:Online,Offline',
        ]);

        $admin->nama_admin = $request->input('nama');
        $admin->email_admin = $request->input('email');
        $admin->posisi = $request->input('posisi');
        $admin->status = $request->input('status');

        // Jika ada file foto diupload, simpan file baru
        if ($request->hasFile('foto_admin')) {
            if ($admin->foto_admin && file_exists(public_path('uploads/admins/' . $admin->foto_admin))) {
                unlink(public_path('uploads/admins/' . $admin->foto_admin));
            }
            $file = $request->file('foto_admin');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/admins'), $filename);
            $admin->foto_admin = $filename;
        }

        $admin->save();

        return redirect()->back()->with('success', 'Admin berhasil diupdate.');
    }

    public function destroy($id)
    {
        // Temukan admin berdasarkan ID
        $admin = Admin::find($id);

        // Cek apakah admin ditemukan
        if (!$admin) {
            return redirect()->back()->with('error', 'Admin not found.');
        }

        // Hapus file foto jika ada
        if ($admin->foto_admin && file_exists(public_path('uploads/admins/' . $admin->foto_admin))) {
            unlink(public_path('uploads/admins/' . $admin->foto_admin));
        }

        // Hapus admin
        $admin->delete();

        // Redirect kembali ke halaman dengan pesan sukses
        return redirect()->route('dashboard.dataUser.datauser')->with('success', 'Admin deleted successfully.');
    }
     // Tambahkan ini di atas

    public function store(Request $request)
    {
        // Validasi input dengan pengecekan unique untuk email_admin
        $request->validate([
            'nama' => 'required|string|max:255',
            'email_admin' => 'required|email|unique:admins,email_admin',
            'posisi' => 'required|string|max:50',
            'password' => 'required|string|min:6',
            'foto_admin' => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ], [
            // Pesan error kustom untuk validasi email unique
            'email_admin.unique' => 'Email yang Anda masukkan sudah terdaftar, silakan gunakan email lain.',
        ]);

        // Persiapan data admin baru
        $adminData = [
            'nama_admin' => $request->input('nama'),
            'email_admin' => $request->input('email_admin'), // Gunakan 'email_admin'
            'posisi' => $request->input('posisi'),
            'status' => 'Offline', // Status default
            'password' => Hash::make($request->input('password')), // Gunakan Hash::make untuk hashing password
        ];

        // Jika ada file foto diupload, simpan file
        if ($request->hasFile('foto_admin')) {
            $file = $request->file('foto_admin');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Memastikan direktori tujuan ada
            $destinationPath = public_path('uploads/admins');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Simpan file foto ke direktori
            $file->move($destinationPath, $filename);
            $adminData['foto_admin'] = $filename; // Menyimpan nama file foto
        }

        // Simpan data admin ke database
        Admin::create($adminData);

        // Flash message sukses
        return redirect()->route('dashboard.dataUser.datauser')->with('success', 'Admin berhasil ditambahkan');
    }


    public function updateProfile(Request $request, $id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
            return redirect()->back()->with('error', 'Admin tidak ditemukan.');
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email_admin,' . $admin->id, // Unik kecuali ID yang sedang diupdate
            'posisi' => 'required|string|max:50',
            'foto_admin' => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ], [
            // Pesan error kustom untuk validasi email unique
            'email.unique' => 'Email yang Anda masukkan sudah terdaftar, silakan gunakan email lain.',
        ]);

        // Update informasi admin
        $admin->nama_admin = $request->input('nama');
        $admin->email_admin = $request->input('email');
        $admin->posisi = $request->input('posisi');

        // Jika ada file foto diupload, simpan file baru
        if ($request->hasFile('foto_admin')) {
            if ($admin->foto_admin && file_exists(public_path('uploads/admins/' . $admin->foto_admin))) {
                unlink(public_path('uploads/admins/' . $admin->foto_admin));
            }
            $file = $request->file('foto_admin');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/admins'), $filename);
            $admin->foto_admin = $filename;
        }

        // Simpan perubahan
        $admin->save();

        // Tentukan URL redirect berdasarkan input atau session
        $redirectUrl = $request->input('redirect_url') ?? session('previous_url') ?? route('dashboard.dataUser.datauser');
        return redirect($redirectUrl)->with('success', 'Profile berhasil diupdate.');
    }


}
