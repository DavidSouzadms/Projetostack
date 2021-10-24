<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Noticia extends Model
{
    use HasFactory;
    const STATUS_ATIVO = "A";
    const STATUS_INATIVO = "I";
    const STATUS = [
        Noticia::STATUS_ATIVO => "Ativo",
        Noticia::STATUS_INATIVO => "Inativo" 
    ];
    protected $guarded = ['id','created','update_at'];
    protected $table = 'noticias';
    protected $date = ['create_at', 'update_at', 'update_data_publicacao'];

    
    public function getStatusFormatadoAttribute(){

        return Noticia::STATUS[$this->status];            
    }

    public function setDataPublicacaoAttribute($value)
    {
        $this->attributes['data_publicacao'] = Carbon::createFromFormat("d/m/Y", $value)->format('Y-m-d');
    }

}

//public function getStatusFormatadoAttribute() (melhorou o codigo devido as constantes status inseridas)
    //{
    //    if($this->status == "A"){
    //        return "Ativo";
    //    }else if ($this->status == "I"){
    //        return "Inativo";
    //    }

