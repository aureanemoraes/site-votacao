<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
/**Models**/
use App\Opcao;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $temas = DB::table('opcaos')->select(DB::raw('SUM(quantidade) as "total", temas.*'))
        ->join('temas', 'opcaos.tema_id','=', 'temas.id')
        ->where('duracao','>=', Carbon::now())
        ->groupBy('tema_id')
        ->havingRaw('total > 0')
        ->orderBy('total', 'desc')->get();

        return view('home')->with('temas', $temas);
    }
}
