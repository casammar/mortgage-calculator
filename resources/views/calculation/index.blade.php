@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if(session()->get('success'))
                <div class="alert alert-success">
                {{ session()->get('success') }}  
                </div>
            @endif
            <h2 class="display-3">Calculations</h1>    
            <table class="table table-striped">
                <thead>
                    <tr>
                    <td>ID</td>
                    <td>Loan Type</td>
                    <td>Loan Value</td>
                    <td>Years</td>
                    <td>Interest Rate</td>
                    <td colspan = 2>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($calculations as $calculation)
                    <tr>
                        <td>{{$calculation->id}}</td>
                        <td>{{$calculation->loan_type}}</td>
                        <td>{{$calculation->loan_value}}</td>
                        <td>{{$calculation->years}}</td>
                        <td>{{$calculation->interest_rate}}</td>
                        <td>
                            <a href="{{ route('calculation.edit',$calculation->id)}}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('calculation.destroy', $calculation->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        <div>
    </div>
</div>
@endsection