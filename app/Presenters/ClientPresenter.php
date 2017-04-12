<?php
/**
 * Created by PhpStorm.
 * User: Notebook
 * Date: 27/03/2017
 * Time: 09:55
 */

namespace App\Presenters;

use App\Transformers\ClientTransformer;
use Prettus\Repository\Presenter\FractalPresenter;


class ClientPresenter extends FractalPresenter
{
    public function getTransformer()
    {
        return new ClientTransformer();
    }
}