@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ url('category/form') }}" class='btn btn-success mb-3'> Criar Categoria </a>
            @if (Session::has('message'))
                <div class='alert alert-success w-100'>
                    {!! session('message') !!}
                </div>
            @endif

            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                   @if (count($categories) == 0) 
                    <div class='alert alert-danger'> Não tem categorias cadastradas </div>
                   @else
                        <table class='table'>
                        @foreach ($categories as $category)
                            <tr>
                                <td> {{ $category->id }} </td>
                                <td> {{ $category->name }} </td>
                                <td> {{ $category->description }} </td>
                                <td> 
                                    <a href="{{ url('category/form/' . $category->id) }}" class="btn btn-sm btn-warning" title="Editar"> E </a>
                                </td>
                            </tr>
                        @endforeach
                        </table>
                   @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection