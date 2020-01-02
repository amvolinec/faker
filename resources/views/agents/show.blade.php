@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Agent {{ $agent->name }}</h3>
                    </div>
                    <div class="card-body overflow-auto">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @foreach($agent->queues as $queue)

                            <div>
                                {{ $queue->name }}
                            </div>

                        @endforeach

                        Status updated: {{ $agent->status->date_updated }} is
                        logged: {{  $agent->status->is_logged_in }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection