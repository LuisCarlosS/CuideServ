<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class funcionario extends Model
{
    use HasFactory;

    protected $table = "funcionarios";
    protected $fillable = ["nome", "cpf", "celular", "whatsapp", "status"];

    public $timestamps = false;
}
