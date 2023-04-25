@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ url('product/form') }}" class='btn btn-success mb-3'> Criar Produto </a>

            <form action="{{ route('product.index') }}" method='GET'>
                <div class="card bg-info mb-3">
                    <div class="card-header">
                        Filtro
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <span> ID do Produto </span>
                                    <input type='number' class='form-control' name='filterId' value="{{ Request::get('filterId') ?? old('filterId') }}">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <span> Nome do Produto </span>
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
                    @if (count($products) == 0)
                    <div class='alert alert-danger'> Não tem produtos cadastrados </div>
                    @else
                    <table class='table'>
                        @foreach ($products as $product)
                        <tr>
                            <td> {{ $product->id }} </td>
                            <td> {{ $product->name }} </td>
                            <td> {{ $product->description }} </td>
                            <td>
                                <a href="{{ url('product/form/' . $product->id) }}" class="btn btn-sm btn-warning" title="Editar"> E </a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    @endif
                </div>

                <div class="card-footer">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection