<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_servico extends Model
{
    use HasFactory;

    protected $table = "tipo_servico";
    protected $fillable = ["tipo", "valor_servico", "valor_comissao"];

    public $timestamps = false;
}
