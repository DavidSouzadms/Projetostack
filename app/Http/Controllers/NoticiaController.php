<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;
use Carbon\Carbon;
use App\Http\Requests\NoticiaRequest; 

class NoticiaController extends Controller
{
    public function index(){

        return view('noticias.index',[
            'noticias' => Noticia::where('status', Noticia::STATUS_ATIVO)->paginate(2)
        ]);
    }

    public function create(){
        return view('noticias.create');
    }

    public function store(NoticiaRequest $request){
       $dados = $request->all();
        
        $dados['imagem']->storeAs('public', $dados['imagem']->getClientOriginalName());
        $dados['imagem'] = '/storage/' . $dados['imagem']->getClientOriginalName();
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
        
        if($request->imagem){
            $request->imagem->storeAs('public', $request->imagem->getClientOriginalName());
            $dados['imagem'] = '/storage/' . $request->imagem->getClientOriginalName();
        }
        $noticia->update($dados);
        
        return redirect()->back()->with('mensagem', 'Registro atualizado com sucesso!');
    }







}
