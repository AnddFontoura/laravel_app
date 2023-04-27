<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryApiController extends Controller
{
    public function getCategories(Request $request)
    {
        $data = $request->only([
            'limit',
            'offset',
        ]);

        $categories = Category::select('id', 'name', 'description');
        
        if (isset($data['limit']) && isset($data['offset'])) {
            $categories = $categories->take($data['limit']);
            $categories = $categories->skip($data['offset']);
        } else {
            return response()->json(
                [
                    'error' => 'Você não enviou limit e offset'
                ], 
                Response::HTTP_BAD_REQUEST
            );
        }

        $categories = $categories->get();

        return response()->json($categories, Response::HTTP_OK);
    }

    public function saveCategory(Request $request)
    {
        $data = $request->only([
            'name',
            'description'
        ]);

        if (!isset($data['name'])) {
            return response()->json(
                [
                    'error' => 'Nome é obrigatório'
                ], 
                Response::HTTP_BAD_REQUEST
            );
        }

        $category = Category::where('name', $data['name'])->first();

        if ($category) {
            return response()->json(
                [
                    'error' => 'Já existe uma categoria com esse nome'
                ], 
                Response::HTTP_CONFLICT
            );
        }

        $category = Category::create([
            'name' => $data['name'],
            'description' => $data['description'] ?? ''
        ]);

        unset($category['updated_at']);
        unset($category['created_at']);

        return response()->json($category);

    }

    public function deleteCategory(Request $request, int $id)
    {
        $category = Category::where('id', $id)->first();

        if(!$category) {
            return response()->json(
                [
                    'error' => 'Esse dado já foi deletado'
                ], 
                Response::HTTP_CONFLICT
            );
        }
        
        Category::where('id', $id)->delete();

        return response()->json(['message' => 'Dado deletado com sucesso']);
    }
}
