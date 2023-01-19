<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Funcionario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'sexo',
        'data_nascimento',
        'tel',
        'morada',
        'bi',
        'funcao',
        'salario',
        'user_id'
    ];

    protected $with = ['user'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
