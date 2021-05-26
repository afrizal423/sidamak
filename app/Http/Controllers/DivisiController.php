<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DivisiModels;

class DivisiController extends Controller
{
    public function index_view ()
    {
        return view('pages.divisi.divisi-data', [
            'divisis' => DivisiModels::class
        ]);
    }
}
