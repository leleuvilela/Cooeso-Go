<?php

namespace App\Transformers;

use App\Entities\Client;
use League\Fractal\TransformerAbstract;

class ClientTransformer extends TransformerAbstract
{
    public function transform(Client $client)
    {
        return [
            'id' => (int) $client->id
        ];
    }
}
