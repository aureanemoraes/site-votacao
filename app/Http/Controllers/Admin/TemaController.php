<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;

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
        return view('admin.tema.create');
    }

    public function store(Request $request)
    {
        $tema = new Tema();
        $tema->user_id = Auth::user()->id;
        $tema->titulo = $request->input('titulo');
        $tema->descricao = $request->input('descricao');
        $tema->duracao = Carbon::parse($request->input('duracao'));
        $tema->slug = $this->criar_slug($request->input('titulo'));
        $tema->save();
        $opcoes = explode(",", $request->input('opcoes'));
        foreach ($opcoes as $key => $value) {
          $opcao = new Opcao();
          $opcao->tema_id = $tema->id;
          $opcao->opcao = $value;
          $opcao->save();
        }
        return back();
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


    public function destroy($id) {
        Tema::find($id)->delete();
        return back();
    }

    function criar_slug($titulo) {
        $procurar =   ['ã','â','ê','é','í','õ','ô','ú',' ','?'];
        $substituir = ['a','a','e','e','i','o','o','u','-',''];
        return str_replace($procurar, $substituir, mb_strtolower($titulo));
    }

    public function listar_por_usuario() {
      $temas = Tema::where('user_id','=',Auth::user()->id)->orderBy('created_at','desc')->get();
      return view('admin.tema.index')->with('temas',$temas)->with('titulo','Meus Temas');
    }

    public function listar_temas() {
      $temas = Tema::orderBy('created_at','desc')->get();
      return view('admin.tema.index')->with('temas',$temas)->with('titulo','Listar Temas');
    }

    public function listar_removidos() {
      $temas = Tema::onlyTrashed()->orderBy('deleted_at','desc')->get();
      return view('admin.tema.index')->with('temas',$temas)->with('titulo','Listar Removidos');
    }

    public function ativar($id) {
        Tema::withTrashed()->find($id)->restore();
        return back();
    }
}
