@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ url('category/form') }}" class='btn btn-success mb-3'> Criar Categoria </a>

            <form action="{{ route('category.index') }}" method='GET'>
                <div class="card bg-info mb-3">
                    <div class="card-header">
                        Filtro
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <span> ID da Categoria </span>
                                    <input type='number' class='form-control' name='filterId' value="{{ Request::get('filterId') ?? old('filterId') }}">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <span> Nome da Categoria </span>
                                    <input type='text' class='form-control' name='filterName' placeholder='Parte do nome' value="{{ Request::get('filterName') ?? old('filterName') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <input type='submit' value='Filtrar' class='btn btn-secondary'>
                    </div>
                </div>
            </form>

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

                <div class="card-footer">
                    {{ $categories->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection