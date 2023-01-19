<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Servico;
use App\Models\User;
use App\Models\FormaPagamento;
use App\Models\Cliente;

class Pagamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'servi_id',
        'forma_pagamento_id',
        'user_id',
        'cliente_id'
    ];

    public function servico() {
        return $this->belongsTo(Servico::class);
    }

    public function formaPagamento() {
        return $this->belongsTo(FormaPagamento::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
