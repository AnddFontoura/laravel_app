@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                   @if (count($users) == 0) 
                    <div class='alert alert-danger'> Não tem usuario </div>
                   @else
                        <table class='table'>
                        @foreach ($users as $user)
                            <tr>
                                <td> {{ $user->id }} </td>
                                <td> {{ $user->name }} </td>
                                <td> {{ $user->email }} </td>
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
