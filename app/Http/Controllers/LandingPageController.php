<?php

namespace App\Http\Controllers;

use App\Models\Promo; // Import model Promo
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        // Mengambil semua promo dari database
        $promos = Promo::all();

        // Mengirim data promo ke view
        return view('landingPage.layoutLandingPage', compact('promos'));
    }
}
