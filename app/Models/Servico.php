<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Servico extends Model
{
    use HasFactory;

    protected $fillable = [
        'designacao',
        'preco',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
