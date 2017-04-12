<?php
/**
 * Created by PhpStorm.
 * User: leleuvilela
 * Date: 24/03/17
 * Time: 11:07
 */

namespace App\OAuth;

use Illuminate\Support\Facades\Auth;

class Verifier
{
    public function verify($username, $password)
    {
        $credentials = [
            'email'    => $username,
            'password' => $password,
        ];

        if (Auth::once($credentials)) {
            return Auth::user()->id;
        }

        return false;
    }
}