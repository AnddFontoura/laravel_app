<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function __construct() {
        $this->model = Category::class;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->validate($request, [
            'filterId' => 'nullable|int',
            'filterName' => 'nullable|string|min:1|max:254'
        ]);

        $filter = $request->only([
            'filterId',
            'filterName'
        ]);

        $categories = Category::select();

        if (isset($filter['filterId'])) {
            $categories = $categories->where('id', $filter['filterId']);
        }
        if (isset($filter['filterName'])) {
            $categories = $categories->where('name', 'like',  '%' . $filter['filterName'] . '%');
        }

        $categories = $categories->paginate(10);
        
        return view('category.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'categoryName' => 'required|string|min:1|max:254',
            'categoryDescription' => 'nullable|string|min:1|max:1000'
        ]);

        $data = $request->only([
            'categoryName',
            'categoryDescription'
        ]);

        Category::create([
            'name' => $data['categoryName'],
            'description' => $data['categoryDescription'] ?? null
        ]);

        return redirect('category')->with('message', 'Dado criado com sucesso');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $this->validate($request, [
            'categoryName' => 'required|string|min:1|max:254',
            'categoryDescription' => 'nullable|string|min:1|max:1000'
        ]);

        $data = $request->only([
            'categoryName',
            'categoryDescription'
        ]);

        Category::where('id', $id)
            ->update([
                'name' => $data['categoryName'],
                'description' => $data['categoryDescription'] ?? null
            ]);

        return redirect('category')->with('message', 'Dado atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
