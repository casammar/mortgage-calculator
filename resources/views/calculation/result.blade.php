@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Your Calculation Result') }}</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <ul>
                    @foreach($calculation as $key => $value)
                        <li>{{ $key }}: {{ $value }}</li>
                    @endforeach 
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
