@extends('layouts.app')

@push('scripts')
    <script>
        function clearInput(){
            document.getElementById("search").value= '';
        }
    </script>
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Themes</h3> Total: {{ $items->total()  }}
                        <form class="float-lg-right ml-3" action="{{ route('theme.add') }}"
                              method="POST">
                            @csrf
                            @method('post')

                            <div class="d-inline custom-control">
                                <input class="form-control form-control-sm inline" name="qty" type="number" value="1"
                                       min="1"
                                       max="1000">
                            </div>
                            <div class="d-inline custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck1"
                                       name="is_old" value="true">
                                <label class="custom-control-label" for="customCheck1">FV2</label>
                            </div>
                            <div class="d-inline custom-control">
                                <button class="btn btn-sm btn-success"
                                        onclick="return confirm('Are you sure?')">{{ __('Add') }}</button>
                            </div>

                        </form>
                    </div>
                    <div class="row">
                        <form class="align-content-center ml-3" action="{{ route('theme.find') }}"
                              method="POST">
                            @csrf
                            @method('post')
                            <div class="input-group mb-3">
                                <input type="text" id="search" name="search" class="form-control" placeholder="Theme name"
                                       aria-label="Theme name" aria-describedby="basic-addon2"
                                       value="{{ $search ?? '' }}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" onclick="clearInput()">{{ __('Clear') }}</button>
                                    <button class="btn btn-outline-success" type="submit">{{ __('Find') }}</button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="card-body overflow-auto">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @include('cast.index', ['columns' => $columns, 'items' => $items])

                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection