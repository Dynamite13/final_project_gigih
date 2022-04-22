<?php

namespace App\Http\Controllers;

use App\Models\Aktifitas;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function home()
    {
        return view('dashboard.index');
    }

    public function aktifitas()
    {
        $aktifitas = Aktifitas::latest()->paginate(10);
        return view('dashboard.aktifitas.index', compact('aktifitas'));
    }
}
