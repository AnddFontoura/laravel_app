<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(int $id = null)
    {   
        $category = null;

        if ($id) {
            $category = Category::where('id', $id)->first();
        }

        return view('category.create', compact('category'));
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
