<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;
    protected $guarded = ['id','created','update_at'];
    protected $table = 'noticias';
    protected $date = ['create_at', 'update_at', 'update_data_publicacao'];

    public function getStatusFormatadoAttribute()
    {
        if($this->status == "A"){
            return "Ativo";
        }else if ($this->status == "I"){
            return "Inativo";
        }

    }

}

