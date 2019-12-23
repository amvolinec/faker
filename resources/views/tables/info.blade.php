@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h1>{{ $table }}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @each('tables.column', $columns, 'column')

            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection
