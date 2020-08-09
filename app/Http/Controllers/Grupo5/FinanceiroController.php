<?php

namespace App\Http\Controllers\Grupo5;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Grupo5\Model\Atletas;

class FinanceiroController extends Controller {

    const NAME_FOLDER = 'Grupo5\financeiro\\';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $pagamento = Atletas::find(1)->relFinanceiro;
        return view(self::NAME_FOLDER . 'index', compact('pagamento'));
    }
}
