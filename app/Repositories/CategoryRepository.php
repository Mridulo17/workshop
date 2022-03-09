<?php


namespace App\Repositories;

use App\Models\Category;
use App\Interfaces\CategoryInterface;


class CategoryRepository extends BaseRepository implements CategoryInterface
{
    public function __construct(Category $model)
    {
        $this->model = $model;
    }
}
