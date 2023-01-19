<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\User;
use App\Models\Funcionario;
use App\Models\Cliente;
use App\Models\Servico;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Servico::class)
            ->references('id')->on('servicos');
            $table->string('data');
            $table->string('hora_inicial');
            $table->string('hora_final');
            $table->foreignIdFor(Cliente::class)
            ->references('id')->on('clientes');
            $table->string('status')->default('Pendente');
            $table->foreignIdFor(Funcionario::class)
            ->references('id')->on('funcionarios');
            $table->foreignIdFor(User::class)
            ->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agendas');
    }
};
