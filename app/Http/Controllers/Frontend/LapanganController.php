<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;
use Illuminate\Http\Request;

class LapanganController extends Controller
{
    public function index(){
        $lapangans = Lapangan::all();

        return view('lapangans.index', compact('lapangans'));
    }
}
