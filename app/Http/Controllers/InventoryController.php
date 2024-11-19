<?php

namespace App\Http\Controllers;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function showInventoryMasuk(){
        return view ('dashboard.inventory.inventoryMasuk.inventoryMasuk');
    }

    public function showInventoryKeluar()
    {
        return view('dashboard.inventory.inventoryKeluar.inventoryKeluar');
    }
}
