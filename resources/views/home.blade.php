@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Tables</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @forelse($tables as $table)
                            @foreach($table as $key=>$value)
                                <div><a href="{{ route('table.show', $value) }}">{{ $value }}</a></div>
                            @endforeach
                        @empty
                            {{ __('No tables') }}
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
