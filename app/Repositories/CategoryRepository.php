<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Contracts\Container\BindingResolutionException;

class CategoryRepository
{
    protected mixed $model;

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->model = app()->make(Category::class);
    }

    // Tạo category
    public function storeCategory($data): Category
    {
        return $this->model->create($data);
    }

    // Update category
    public function updateCategory($data, $category): bool
    {
        return $category->update($data);
    }

    // Show category
    public function showCategory($category_id): Category
    {
        return $this->model->findOrFail($category_id);
    }

    // Destroy category
    public function destroyCategory($category): bool
    {
        return $this->model->destroy($category);
    }
}
