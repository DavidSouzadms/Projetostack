<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NoticiaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'titulo' => 'required',
            'conteudo' => 'required',
            'status' => ['required',
            Rule::in(['A','I'])
        ],
        'data_publicacao' => 'date_format:d/m/Y',
        'imagem' => 'nullable|image'
        ];
    }

    public function messages(){
    return[
        'titulo.required' => 'O campo titulo é obrigatorio',
        'conteudo.required' => 'O campo conteudo é obrigatorio',
        'status.required' => 'O campo status é obrigatorio',
        'data_publicacao.required' => 'o campo data de publigacao é obrigatorio',
        'imagem.image' => 'O campo imagem é obrigatorio',
        'status.in' => 'O campo só pode ser Ativo ou Inativo'

        ];

    }




}
