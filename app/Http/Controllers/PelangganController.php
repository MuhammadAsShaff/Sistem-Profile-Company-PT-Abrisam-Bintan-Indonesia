<?php

namespace App\Http\Controllers;
use App\Models\Berlangganan;
use App\Models\Customer;
use App\Models\Produk;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        // Save the last URL to the session before visiting the index page
        session(['previous_url' => $request->fullUrl()]);

        // Get search query
        $search = $request->input('search');

        // Base query to retrieve all customers and related products
        $query = Customer::with('produk'); // Assuming 'produk' is the relationship name

        // Filter by search term (e.g., by customer name, email, etc.)
        if (!empty($search)) {
            $query->where('nama_customer', 'like', '%' . $search . '%')
                ->orWhere('email_customer', 'like', '%' . $search . '%')
                ->orWhere('nik', 'like', '%' . $search . '%');  // Example of additional filters
        }

        // Paginate results with a limit of 10 per page
        $customers = $query->paginate(5);  // You can adjust the number here

        // Get the total number of customers (if needed)
        $customerCount = Customer::count();

        // Menghitung customer dengan status 'Belum dihubungi'
        $belumDihubungiCount = Customer::where('status_customer', 'Belum dihubungi')->count();

        // Menghitung customer dengan status 'Sudah dihubungi'
        $sudahDihubungiCount = Customer::where('status_customer', 'Sudah dihubungi')->count();

        // Send data to the view
        return view('dashboard.dataPelanggan.dataPelanggan', compact('customers', 'customerCount', 'search','belumDihubungiCount','sudahDihubungiCount'));
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
