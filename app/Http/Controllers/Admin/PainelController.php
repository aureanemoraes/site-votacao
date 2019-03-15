<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
/**Models**/
use App\Tema;

class PainelController extends Controller
{
    public function index()
    {
        $temas7dias = Tema::whereBetween('created_at',[Carbon::now()->subDay(7),Carbon::now()])->count('id');
        $qtdeAberto = Tema::where('duracao','>=',Carbon::now())->count('id');
        $qtdeEncerrado = Tema::where('duracao','<',Carbon::now())->count('id');
        return view('admin.painel')
        ->with('temas7dias', $temas7dias)
        ->with('qtdeAberto', $qtdeAberto)
        ->with('qtdeEncerrado', $qtdeEncerrado);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
