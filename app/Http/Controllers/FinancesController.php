<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Athletes;

class FinancesController extends Controller {

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $pagamento = Athletes::find(1)->relFinances;
        return view('financeiro.index', compact('pagamento'));
    }
}
