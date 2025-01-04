<?php
namespace App\Http\Controllers;
use App\Models\Promo;
use App\Models\Blog;
use App\Models\FaQ;
use App\Models\Kategori;
use App\Models\Paket;
use App\Models\Produk;
use App\Models\Kegiatan;
use App\Models\BaganOrganisasi;
use App\Models\TentangKami;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(Request $request)
    {
        $paket = Paket::all();
        $kategori = Kategori::all();
        $blogs = Blog::latest()->take(9)->get();
        $promos = Promo::all();

        $produk = Produk::with(['paket', 'kategori'])->get(); // Default produk

        // Filter berdasarkan paket
        if ($request->has('paket') && !empty($request->input('paket')) && empty($request->input('kategori'))) {
            $paketDipilih = $request->input('paket');
            $produk = Produk::where('id_paket', $paketDipilih)
                ->with(['paket', 'kategori'])
                ->get();
        }

        // Filter berdasarkan kategori
        if ($request->has('kategori') && !empty($request->input('kategori'))) {
            $kategoriDipilih = $request->input('kategori');
            $produk = Produk::where('id_kategori', $kategoriDipilih)
                ->with(['paket', 'kategori'])
                ->get();

            $paket = Paket::whereHas('produk', function ($query) use ($kategoriDipilih) {
                $query->where('id_kategori', $kategoriDipilih);
            })->get();
        }

        // Filter berdasarkan paket dan kategori
        if ($request->has('paket') && !empty($request->input('paket')) && !empty($request->input('kategori'))) {
            $paketDipilih = $request->input('paket');
            $kategoriDipilih = $request->input('kategori');
            $produk = Produk::where('id_kategori', $kategoriDipilih)
                ->where('id_paket', $paketDipilih)
                ->with(['paket', 'kategori'])
                ->get();
        }

        // Jika request via AJAX
        if ($request->ajax()) {
            return response()->json([
                'produk' => $produk,
                'paket' => $paket,
            ]);
        }

        return view('landingPage.layoutLandingPage', compact('kategori', 'produk', 'promos', 'paket', 'blogs'));
    }


    public function tampilKontak()
    {

        return view('kontak.layoutKontak');

    }

    public function tampilFaQ()
    {
        // Retrieve all FAQ data from the database
        $faqs = FaQ::all();
        return view('FaQ.layoutFaQ', compact('faqs'));
    }

    public function tampilTentangKami()
    {
        // Ambil semua data dari tabel BaganOrganisasi
        $bagan = BaganOrganisasi::all();

        $kegiatan = Kegiatan::all();

        // Ambil data pertama dari tabel TentangKami
        $tentangKami = TentangKami::first();

        // Format data untuk OrgChart
        $nodes = $bagan->map(function ($item) {
            return [
                'id' => $item->id,
                'pid' => $item->parent_id, // Parent ID (jika ada)
                'name' => $item->name,     // Nama Node
                'title' => $item->title,   // Jabatan Node
                'img' => $item->img_url ? asset('uploads/bagan/' . $item->img_url) : null, // URL gambar
            ];
        });

        // Kirim data ke view
        return view('tentangKami.layoutTentangKami', [
            'kegiatan' => $kegiatan,
            'tentangKami' => $tentangKami,
            'nodes' => $nodes->isEmpty() ? '[]' : $nodes->toJson(), // Konversi ke JSON
            'countNode' => $nodes->count(), // Jumlah node
        ]);
    }
}
