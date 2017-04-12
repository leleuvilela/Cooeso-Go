<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Presentable;
use Prettus\Repository\Traits\PresentableTrait;


class Client extends Model implements Presentable
{
    use PresentableTrait;

    protected $fillable = [
        'nome',
        'nome_cracha',
        'cpf',
        'rg',
        'num_conselho',
        'uf_conselho',
        'prescritor',
        'email',
        'endereco',
        'bairro',
        'cep',
        'cidade',
        'uf',
        'telefone',
        'celular'
    ];
}
