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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Amorization Schedule') }}</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Payment Date</th>
                            <th scope="col">Payment</th>
                            <th scope="col">Principal</th>
                            <th scope="col">Interest</th>
                            <th scope="col">Total Interest</th>
                            <th scope="col">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $remaining_balance = $calculation['loan_value'];
                                $total_interest = 0;
                            @endphp
                            @for($x = 1; $x <= $calculation['total_payments']; $x++)
                            @php
                                // $99,900.45 x 6% interest = $5,994.03 ÷ by 12 months = $499.50 interest due for December.
                                $interest_due = round(($remaining_balance * ($calculation['interest_rate']/100))/12, 2);
                                $total_interest = $total_interest + $interest_due ;
                                $principal_due = $calculation['monthly_payment'] - $interest_due;
                                $remaining_balance = $remaining_balance - $principal_due;
                                //$remaining_balance = number_format($remaining_balance,2);
                            @endphp
                                <tr>
                                    <td>{{ $x }}</td>
                                    <td>Payment Date</td>
                                    <td>${{ number_format($calculation['monthly_payment'], 2) }}</td>
                                    <td>${{ number_format($principal_due, 2) }}</td>
                                    <td>${{ number_format($interest_due, 2) }}</td>
                                    <td>${{ number_format($total_interest, 2) }}</td>
                                    <td>${{ number_format($remaining_balance, 2) }}</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
