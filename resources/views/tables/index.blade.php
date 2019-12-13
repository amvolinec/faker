@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Table:
                        <strong>{{ $name }}</strong>
                        @isset($prefix)
                            <a class="btn btn-success float-right" href="{{ route($prefix.'.create') }}">Create</a>
                        @endisset
                        <a href="{{ route() }}"></a>
                    </div>
                    <div class="card-body overflow-auto">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @include('tables.table', ['columns' => $columns, 'items' => $items])

                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



