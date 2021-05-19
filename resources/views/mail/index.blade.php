@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h3>Send Email (Test)</h3></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @foreach ($errors->all() as $message)
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @endforeach

                        <form action="{{ route('mail.send') }}" method="post">
                            @method('post')
                            @csrf

                            <row>

                                <div class="form-group col-md-12">
                                    <label class="form-label" for="to">Email address</label>
                                    <select class="form-control"  name="to" id="to">
                                        <option value="aleksandr.volynec@addendum.lt" selected>aleksandr.volynec@addendum.lt</option>
                                        <option value="oscars.rains@gmail.com">oscars.rains@gmail.com</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-12">
                                    <label class="form-label" for="text">Message</label>
                                    <textarea class="form-control" name="text">{{ $text ?? 'Text message' }}</textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <label class="form-label" for="encoding">Encoding</label>
                                    <select class="form-control" name="encoding" id="encoding">
                                        <option value="base64" selected>base64</option>
                                        <option value="base64">quoted-printable</option>
                                        <option value="base64">8bit</option>
                                        <option value="base64">7bit</option>
                                    </select>
                                </div>

                                <div class="form-group form-check m-3">
                                    <input name="image" type="checkbox" class="form-check-input" id="image" checked>
                                    <label class="form-check-label" for="image">attachment</label>
                                </div>

                                <div class="btn-group pl-3">
                                    <button class="btn btn-sm btn-primary" type="submit">Send</button>
                                    <button class="btn btn-sm btn-secondary" type="reset">Cancel</button>
                                </div>

                            </row>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
