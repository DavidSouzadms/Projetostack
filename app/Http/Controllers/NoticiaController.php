<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;
use Carbon\Carbon;

class NoticiaController extends Controller
{
    public function index(){

        $noticias = Noticia::all();
        return view('noticias.index', [
            'noticias' => $noticias
        ]);
    }

    public function create(){
        return view('noticias.create');
    }

    public function store(Request $request){
       
        $dados = $request->all();
        $dados['data_publicacao'] = Carbon::createFromFormat('d/m/Y',$dados['data_publicacao'])->format('Y-m-d');

        $request->imagem->storeAs('public', $request->imagem->getClientOriginalName());
        $dados['imagem'] = '/storage/' . $request->imagem->getClientOriginalName();
        Noticia::create($dados);
        
        return redirect()->back()->with('mensagem', 'Registro criado com sucesso!');
    }

    public function edit($noticia){

        $noticia = Noticia::findOrFail($noticia);
        return view('noticias.edit', ['noticia' => $noticia]);

    }

    public function update($noticia, Request $request)
    {
        $noticia = Noticia::findOrFail($noticia);
        $dados = $request->all();
        $dados['data_publicacao'] = Carbon::createFromFormat("d/m/Y", $dados['data_publicacao'])->format("Y-m-d");
        if($request->imagem){
            $request->imagem->storeAs('public', $request->imagem->getClientOriginalName());
            $dados['imagem'] = '/storage/' . $request->imagem->getClientOriginalName();
        }
        $noticia->update($dados);
        
        return redirect()->back()->with('mensagem', 'Registro atualizado com sucesso!');
    }







}
