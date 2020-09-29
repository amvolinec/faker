@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Contacts</h3> Total: {{ $items->total()  }}

                        <form class="float-lg-right ml-3" action="{{ route('contact.add') }}"
                              method="POST">
                            @csrf
                            @method('post')
                            <div class="d-inline custom-control">
                                <input class="form-control form-control-sm inline" name="qty" type="number" value="1"
                                       min="1"
                                       max="3000">
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
