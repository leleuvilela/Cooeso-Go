<?php
/**
 * Created by PhpStorm.
 * User: leleuvilela
 * Date: 23/03/17
 * Time: 15:23
 */

namespace App\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator
{
    protected $rules = [
        'owner_id' => 'required',
        'client_id' => 'required',
        'name' => 'required|max:255',
        'progress' => 'required',
        'status' => 'required'
    ];
}