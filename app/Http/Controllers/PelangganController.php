<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        // Simpan URL terakhir ke session sebelum mengunjungi halaman index
        session(['previous_url' => $request->fullUrl()]);

        // Ambil query pencarian
        $search = $request->input('search');
        $status = $request->input('status');

        // Query dasar untuk mengambil semua customer dan produk terkait
        $query = Customer::with('produk'); // Asumsikan 'produk' adalah nama relasi

        // Filter berdasarkan pencarian di semua kolom
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('nik', 'like', '%' . $search . '%')
                    ->orWhere('nama_customer', 'like', '%' . $search . '%')
                    ->orWhere('alamat_customer', 'like', '%' . $search . '%')
                    ->orWhere('nomor_hp_customer', 'like', '%' . $search . '%')
                    ->orWhere('email_customer', 'like', '%' . $search . '%')
                    ->orWhere('status_customer', 'like', '%' . $search . '%')
                    ->orWhere('jenis_kelamin', 'like', '%' . $search . '%')
                    ->orWhere('provinsi', 'like', '%' . $search . '%')
                    ->orWhere('kota', 'like', '%' . $search . '%')
                    ->orWhere('kelurahan', 'like', '%' . $search . '%')
                    ->orWhere('kecamatan', 'like', '%' . $search . '%')
                    ->orWhere('kode_pos', 'like', '%' . $search . '%');
            });
        }

        // Filter berdasarkan status_customer
        if (!empty($status)) {
            $query->where('status_customer', '=', $status);
        }

        // Ambil status unik untuk dropdown
        $statusCustomer = Customer::distinct()->pluck('status_customer')->filter()->toArray(); // Ambil status unik dan hilangkan null

        // Lakukan paginasi dengan limit 5
        $customers = $query->paginate(5);  // Anda dapat menyesuaikan jumlah di sini

        // Get the total number of customers (if needed)
        $customerCount = Customer::count();

        // Menghitung customer dengan status 'Belum dihubungi'
        $belumDihubungiCount = Customer::where('status_customer', 'Belum dihubungi')->count();

        // Menghitung customer dengan status 'Sudah dihubungi'
        $sudahDihubungiCount = Customer::where('status_customer', 'Sudah dihubungi')->count();


        // Kirim data ke view
        return view('dashboard.dataPelanggan.dataPelanggan', compact('customers', 'search', 'statusCustomer', 'status','customerCount', 'belumDihubungiCount', 'sudahDihubungiCount'));
    }


    // CustomerController.php
    public function updateStatus(Request $request, $id_customer)
    {
        // Validasi input
        $request->validate([
            'status_customer' => 'required|string',
        ]);

        // Temukan customer berdasarkan id
        $customer = Customer::findOrFail($id_customer);

        // Update status_customer
        $customer->status_customer = $request->input('status_customer');
        $customer->save();

        // Kembalikan response dengan pesan sukses
        return response()->json([
            'success' => true,
            'message' => 'Status customer berhasil diperbarui'
        ]);
    }

    public function delete($id_customer)
    {
        // Temukan customer berdasarkan ID
        $customer = Customer::findOrFail($id_customer);

        // Hapus data berlangganan yang terkait dengan customer
        $customer->berlangganan()->delete();

        // Hapus customer
        $customer->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('dashboard.dataPelanggan.dataPelanggan')->with('success', 'Pelanggan berhasil dihapus');
    }


}
