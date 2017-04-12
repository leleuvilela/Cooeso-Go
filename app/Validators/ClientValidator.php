<?php
/**
 * Created by PhpStorm.
 * User: leleuvilela
 * Date: 23/03/17
 * Time: 14:41
 */

namespace App\Validators;


use Prettus\Validator\LaravelValidator;

class ClientValidator extends LaravelValidator
{
    protected $rules = [
        'nome' => 'required|max:255',
        'nome_cracha' => 'required|max:255',
        'email' => 'required|email',
        'telefone' => 'required',
        'endereco' => 'required',
        'cpf' => 'required',
        'bairro' => 'required'
    ];
}