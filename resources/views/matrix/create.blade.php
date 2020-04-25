@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add record to: <strong>{{ $name ?? '' }}</strong></div>

                    <div class="card-body overflow-auto">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(isset($data))
                            <form action="{{ route( $name.'.update', $data->id) }}" method="post">
                                @method('put')
                        @else
                            <form action="{{ route( $name.'.store') }}" method="post">
                                @method('post')
                        @endif
                                @csrf

                                @foreach($columns as $name=>$type)

                                    @if($name == 'id')

                                    @elseif(isset($belongs) && array_key_exists($name, $belongs))

                                        @include('matrix._select' , ['name' => $name, 'type' => $type, 'belongs' => $belongs[$name]])

                                    @elseif($type == 'datetime')

                                        @include('matrix._datetime' , ['name' => $name, 'type' => $type])

                                    @elseif($type == 'integer')

                                        @include('matrix._integer' , ['name' => $name, 'type' => $type])

                                    @else
                                        @include('matrix._string' , ['name' => $name, 'type' => $type])
                                    @endif

                                @endforeach

                                <div class="row">
                                    <div class="col-md-4">&nbsp;</div>
                                    <div class="col-md-8">
                                        <button class="btn btn-success">{{ isset($data) ? 'Update' : 'Create' }}</button>
                                    </div>
                                </div>
                            </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection