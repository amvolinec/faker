@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span>Calls History</span>

                        <form class="ml-3" action="{{ route('calls.fake') }}"
                              method="POST">
                            @csrf
                            @method('post')
                            <div class="d-inline custom-control">
                                <input class="form-control form-control-sm inline" name="caller_id" type="text"
                                       placeholder="caller_id" value="4401">
                                <input class="form-control form-control-sm inline" name="called_id" type="text"
                                       placeholder="called_id">
                            </div>
                            <div class="d-inline custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck1"
                                       name="is_answered">
                                <label class="custom-control-label" for="customCheck1">is_answered</label>
                            </div>
                            <button class="btn btn-sm btn-success d-inline ml-3">{{ __('Add') }}</button>
                        </form>
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
