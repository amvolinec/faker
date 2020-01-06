@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span>Dashboard : {{ $header }} Total:  {{ $items->total() }}</span>

                        <form class="float-lg-right ml-3" action="{{ route('calls.flash') }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger"
                                    onclick="return confirm('Are you sure?')">{{ __('Delete all') }}</button>
                        </form>
                        <form class="float-lg-right ml-3" action="{{ route('calls.add') }}"
                              method="POST">
                            @csrf
                            @method('post')
                            <input class="form-control inline" name="qty" type="number" value="10000" min="1"
                                   max="10000000">
                            <button class="btn btn-success"
                                    onclick="return confirm('Are you sure?')">{{ __('Add') }}</button>
                        </form>
                        <jobs-count></jobs-count>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

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
