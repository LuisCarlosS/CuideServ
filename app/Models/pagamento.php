<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class pagamento extends Model
{
    use HasFactory;

    protected $table = "pagamentos";
    protected $fillable = ["valor", "dt_pagamento", "servico_id"];

    public $timestamps = false;

    public function servico(): BelongsTo
    {
        return $this->belongsTo(tipo_servico::class,'servico_id');
    }
    public function getDtPagamentoView(){
        if($this->dt_pagamento == null || $this->dt_pagamento == "") return "";

        try{
            $dtFormat = \Carbon\Carbon::createFromFormat("Y-m-d", $this->dt_pagamento);
            return $dtFormat->format("d/m/Y");
        }catch(\Exception $e){
            \Log::error("Format dt pagamento to view", [ $e->getMessage() ]);
        }
    }
}
