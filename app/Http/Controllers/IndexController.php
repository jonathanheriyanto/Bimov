<?php

namespace App\Http\Controllers;

use App\Models\Petisi;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function welcome(){
        $petisi = Petisi::all();

        $terkini = $petisi->sortByDesc('created_at')->take(4);
        $terpopuler = $petisi->sortByDesc('counter')->take(4);
        return view('welcome', ['terkini' => $terkini, 'terpopuler' => $terpopuler]);
    }

    public function viewmasuk(){
        return view('login');
    }

    public function viewdaftar(){
        return view('register');
    }
}
