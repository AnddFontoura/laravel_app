@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ url('category/save') }}@if(isset($category))/{{$category->id}}@endif">
            @csrf    
            <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <div class="form-group">
                            <span> Nome da Categoria </span>
                            <input type="text" class="form-control" name="categoryName" value="@if(isset($category)){{ $category->name }}@endif"></input>
                        </div>

                        <div class="form-group mt-3">
                            <span> Descrição da Categoria </span>
                            <textarea type="text" class="form-control" name="categoryDescription">@if(isset($category)){{ $category->description }}@endif</textarea>
                        </div>
                    </div>

                    <div class="card-footer">
                        <input type="submit" class="btn btn-success" value="@if(isset($category))Atualizar @else Cadastrar @endif categoria"></input>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection