@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Table: <strong>{{ __('Error') }}</strong></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a href="{{ route('home') }}">{{ __('Home') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
