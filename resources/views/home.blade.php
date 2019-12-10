@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard: Tables</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @forelse($tables as $table)
                            @foreach($table as $key=>$value)
                                <div>{{ $value }}</div>
                            @endforeach
                        @empty
                            {{ 'no tables' }}
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
