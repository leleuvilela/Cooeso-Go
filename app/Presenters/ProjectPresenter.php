<?php
/**
 * Created by PhpStorm.
 * User: Notebook
 * Date: 27/03/2017
 * Time: 09:55
 */

namespace App\Presenters;

use App\Transformers\ProjectTransformer;
use Prettus\Repository\Presenter\FractalPresenter;


class ProjectPresenter extends FractalPresenter
{
    public function getTransformer()
    {
        return new ProjectTransformer();
    }
}