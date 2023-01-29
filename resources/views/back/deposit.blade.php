@extends('layouts.app')

@section('content')
@section('title', 'Deposit')

<div class="container">
    <div>
        <h2 class="main-title">Money deposit</h2>
    </div>
    <div class="div-line">
        <div class="text">
            <div> {{$customer->name}} {{$customer->surname}}
                <p>Account balance: {{$customer->balance}} EUR</p>
            </div>
        </div>
        <div class="form">
            <form action="{{route('customers-deposit', $customer)}}" method="post">
                <input class="input" type="text" name="naujaSuma">
                <button class="btn btn-margin" type="submit">Deposit</button>
                @csrf
                @method('put')
        </div>
        </form>
    </div>
</div>


@endsection
