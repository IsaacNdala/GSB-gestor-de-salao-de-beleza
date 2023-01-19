<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Servico;
use App\Models\Cliente;
use App\Models\User;
use App\Models\Funcionario;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cliente_id',
        'data',
        'hora_inicial',
        'hora_final',
        'funcionario_id',
        'servico_id',
        'status'
    ];

    public function servico() {
        return $this->belongsTo(Servico::class);
    }

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }

    public function funcionario() {
        return $this->belongsTo(Funcionario::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
