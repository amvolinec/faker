@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Table: <strong>{{ $name }}</strong></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @include('tables.table', ['columns' => $columns, 'items' => $items])

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



