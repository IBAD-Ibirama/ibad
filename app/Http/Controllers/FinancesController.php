<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Athlete;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FinancesController extends Controller {

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $finances = DB::table('moves')
            ->where('user_id', Auth::user()->id)
            ->get();
        return view('financeiro.index', compact('finances'));
    }
}
