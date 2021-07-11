<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;

class CariAlamatController extends Controller
{
    function index() {
        $warga = Warga::all();
        return view('admin-dashboard.warga.cari-alamat', [
            'warga' => $warga
        ]);
    }
}
