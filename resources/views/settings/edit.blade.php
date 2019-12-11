@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Settings</div>

                    <div class="card-body overflow-auto">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="container">
                            <div class="row">
                                <div class="col-md-4"></div>

                                <div class="col-md-4">

                                    <form action="{{ route('settings.set') }}" method="post">
                                        @method('post')
                                        @csrf

                                        @forelse($settings as $key => $value)
                                            @include('settings.field', ['key' => $key, 'value' => $value])
                                        @empty
                                            {{ __('No data') }}
                                        @endforelse

                                        <div class="form-group">
                                            <button class="btn btn-success float-right"
                                                    onclick="return confirm('Are you sure?')">{{ __('Save') }}</button>
                                        </div>
                                    </form>

                                </div>

                                <div class="col-md-4"></div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection