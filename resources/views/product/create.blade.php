@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ url('product/save') }}@if(isset($product))/{{$product->id}}@endif" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        
                        <div class="form-group mt-3">
                            <span> Categoria do Produto </span>
                            <select class="form-control" name="categoryId">
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if(isset($product) && $product->id == $category->id) selected @endif> {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <span> Nome do Produto </span>
                            <input type="text" class="form-control" name="productName" value="@if(isset($product)){{ $product->name }}@endif"></input>
                        </div>

                        <div class="form-group mt-3">
                            <span> Descrição do Produto </span>
                            <textarea type="text" class="form-control" name="productDescription">@if(isset($product)){{ $product->description }}@endif</textarea>
                        </div>

                        <div class="form-group">
                            <span> Preço do Produto </span>
                            <input type="number" class="form-control" name="productPrice" value="@if(isset($product)){{ $product->price }}@endif"></input>
                        </div>

                        <div class="form-group">
                            <span> Imagem do Produto </span>
                            <input type="file" class="form-control" name="productImage"></input>
                        </div>

                    </div>

                    <div class="card-footer">
                        <input type="submit" class="btn btn-success" value="@if(isset($product))Atualizar @else Cadastrar @endif produto"></input>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection