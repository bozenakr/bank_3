@extends('layouts.app')

@section('content')
@section('title', 'Withdraw')

<div class="container">
    <div>
        <h2 class="main-title">Money withdrawal</h2>
    </div>
    <div class="div-line">
        <div class="text">
            <div> {{$customer->name}} {{$customer->surname}}
                <p>Balance: {{$customer->balance}} EUR</p>
            </div>
        </div>
        <div class="form">
            <form action="{{route('customers-withdraw', $customer)}}" method="post">
                <input class="input" type="text" name="naujaSuma" value="{{old('naujaSuma')}}">
                <button class="btn btn-margin" type="submit">Withdraw</button>
        </div>
        @csrf
        @method('put')
        </form>
    </div>
</div>


@endsection
