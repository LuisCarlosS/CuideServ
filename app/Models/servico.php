<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class servico extends Model
{
    use HasFactory;

    protected $table = "servicos";
    protected $fillable = ["tipo_servico_id", "cliente_id", "funcionario_id", "dt_inicio", "dt_fim", "valor_total", "valor_comissao", "desconto", "status", "status_pagamento"];

    public $timestamps = false;

    public function tipo_servico(): BelongsTo
    {
        return $this->belongsTo(tipo_servico::class,'tipo_servico_id');
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(cliente::class, 'cliente_id');
    }

    public function funcionario(): BelongsTo
    {
        return $this->belongsTo(funcionario::class, 'funcionario_id');
    }
    
    public function getDtInicioView(){
        if($this->dt_inicio == null || $this->dt_inicio == "") return "";

        try{
            $dtFormat = \Carbon\Carbon::createFromFormat("Y-m-d", $this->dt_inicio);
            return $dtFormat->format("d/m/Y");
        }catch(\Exception $e){
            \Log::error("Format dt inicio to view", [ $e->getMessage() ]);
        }
    }

    public function getDtFimView(){
        if($this->dt_fim == null || $this->dt_fim == "") return "";

        try{
            $dtFormat = \Carbon\Carbon::createFromFormat("Y-m-d", $this->dt_fim);
            return $dtFormat->format("d/m/Y");
        }catch(\Exception $e){
            \Log::error("Format dt fim to view", [ $e->getMessage() ]);
        }
    }
}
