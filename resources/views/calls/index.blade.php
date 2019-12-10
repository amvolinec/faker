@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span>Dashboard : {{ $header }}</span>
                        <form action="{{ route('calls.flash') }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger"
                                    onclick="return confirm('Are you sure?')">{{ __('Delete all') }}</button>
                        </form>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{--                        @includeWhen(!empty($items), 'tables.table', [])--}}
                        @includeWhen(!empty($items),'tables.table', ['columns' => $columns, 'items' => $items])
                        @empty($items)
                            No data in table {{ $header }}
                        @endempty
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
