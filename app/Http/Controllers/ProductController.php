<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    function __construct() {
        $this->model = Product::class;

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(20);

        return view('product.index', compact('products')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(int $id = null)
    {
        $product = null;
        $categories = $this->categoryModel::orderBy('name', 'asc')
            ->get();
       
        if ($id) {
            $product = $this->model::where('id', $id)->first();
        }

        return view('product.create', compact('product','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'categoryId' => 'required|int|min:1',
            'productName' => 'required|string|min:1|max:254',
            'productDescription' => 'nullable|string|min:1|max:1000',
            'productPrice' => 'nullable|int|min:1|max:1000',
            'productFile' => 'nullable|files:jpg,bmp,png,gif|min:1|max:1000',
        ]);

        $data = $request->only([
            'categoryId',
            'productName',
            'productDescription',
            'productPrice',
            'productFile',
        ]);

        $product = Product::create([
            'category_id' => $data['categoryId'],
            'name' => $data['productName'],
            'description' => $data['productDescription'] ?? null,
            'price' => $data['productPrice'] ?? null,
        ]);

        if ($request->file('productImage')) {
            $product->main_image = Storage::disk('public')->put('products', $request->file('productImage'));
            $product->save();
        }

        return redirect('product')->with('message', 'Dado criado com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
