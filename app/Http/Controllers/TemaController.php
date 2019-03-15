<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tema;
use App\Opcao;


class TemaController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id, $slug)
    {
    $tema = Tema::find($id);
      $opcoes = Opcao::where('tema_id','=',$id)->orderBy('id','asc')->get();
      $total = Opcao::where('tema_id','=',$id)->sum('quantidade');
      return view('tema.show')
      ->with('tema', $tema)
      ->with('opcoes', $opcoes)
      ->with('total', $total);
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

    public function adicionar_voto(Request $request)
    {
      if(is_null($request->input('opcao'))){}
        else{
          $opcao = Opcao::find($request->input('opcao'));
          $opcao->quantidade++;
          $opcao->save();
        }
        return back();
    }
}
