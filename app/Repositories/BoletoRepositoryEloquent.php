<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BoletoRepository;
use App\Entities\Boleto;
use App\Validators\BoletoValidator;

/**
 * Class BoletoRepositoryEloquent
 * @package namespace App\Repositories;
 */
class BoletoRepositoryEloquent extends BaseRepository implements BoletoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Boleto::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
