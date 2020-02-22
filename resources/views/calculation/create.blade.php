@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Mortgage Calculator') }}</div>

                <div class="card-body">
                    <!-- @error('home_value')
                        <div class="alert alert-danger">{{ $message }}ll</div>
                    @enderror

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif -->
                    <form method="POST" action="{{ route('calculation.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="home-value" class="col-md-4 col-form-label text-md-right">{{ __('Type of Loan') }}</label>

                            <div class="col-md-6">
                                <input type="radio" name="loan_type" id="fixed" checked="checked" value="Fixed" />
                                <label for = "fixed">Fixed</label>

                                <input type="radio" name="loan_type" id="variable" value="Variable" />
                                <label for = "variable">Variable</label>

                                <!-- <input id="loan-type" type="text" class="form-control @error('loan_type') is-invalid @enderror" name="loan_type" value="{{ old('loan_type') }}" required autocomplete="name" autofocus> -->

                                @error('home_value')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="loan-value" class="col-md-4 col-form-label text-md-right">{{ __('Loan Value') }}</label>

                            <div class="col-md-6">
                                <input id="loan-value" type="text" class="form-control @error('loan_value') is-invalid @enderror" name="loan_value" value="{{ old('loan_value') }}" required autocomplete="name" autofocus>

                                @error('loan_value')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="years" class="col-md-4 col-form-label text-md-right">{{ __('Years') }}</label>

                            <div class="col-md-6">
                                <input id="years" type="text" class="form-control @error('years') is-invalid @enderror" name="years" value="{{ old('years') }}" required autocomplete="years" autofocus>

                                @error('home_value')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="interest_rate" class="col-md-4 col-form-label text-md-right">{{ __('Interest Rate') }}</label>

                            <div class="col-md-6">
                                <input id="interest_rate" type="text" class="form-control @error('interest_rate') is-invalid @enderror" name="interest_rate" value="{{ old('interest_rate') }}" required autocomplete="interest_rate" autofocus>

                                @error('interest_rate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Calculate') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
