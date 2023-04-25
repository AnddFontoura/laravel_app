<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $model;
    protected $variablePluralName;

    public function create(int $id = null)
    {   
        $category = null;

        if ($id) {
            $category = $this->model::where('id', $id)->first();
        }

        return view('category.create', compact('category'));
    }
}
