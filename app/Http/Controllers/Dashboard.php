<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
  public function index()
  {
    return view('dashboard.dashboard.dashboard');
  }

}
