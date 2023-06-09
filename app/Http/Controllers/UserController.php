<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    function __construct()
    {
        $this->model = User::class;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::select('id', 'name')->get();

        return view('user.index', compact('users'));
    }

    public function create(int $id = null)
    {   
        $category = null;

        if ($id) {
            $category = $this->model::where('id', $id)->first();
        }

        return view('category.create', compact('category'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
