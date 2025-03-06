<?php

namespace App\Repositories\Products;

use App\Models\Product;
use App\Repositories\Base\BaseRepository;

class ProductsRepository extends BaseRepository implements ProductsInterface

{
    /**
     * @var Payment
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Payment   $model
     */
    public function __construct(Product $model)
    {
        $this->model = $model;
    }
}

