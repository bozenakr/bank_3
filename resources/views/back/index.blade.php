@extends('layouts.app')

@section('content')
@section('title', 'Client list')

<div class="container">
    <div>
        <h2 class="main-title">Client List</h2>
    </div>
    <div class="table">
        @forelse($customers as $customer)
        <div class="table1">
            <div class="content">
                <div class="width"> {{$customer->name}} {{$customer->surname}}</div>
                <div>{{$customer->personal_id}}</div>
                <div> {{$customer->iban}}</div>
                <div>{{$customer->balance}} EUR</div>
            </div>
            <div class="buttons">
                <button type="submit" style="border:none; background:none">
                    <a class="btn" href="{{route('customers-deposit', $customer)}}">Deposit</a>
                </button>
                <button type="submit" style="border:none; background:none">
                    <a class=" btn btn-light" href="{{route('customers-withdraw', $customer)}}">Withdraw</a>
                </button>
                <button type="submit" style="border:none; background:none">
                    <a class=" btn" href="{{route('customers-edit', $customer)}}">Edit</a>
                </button>
                <form action="{{route('customers-delete', $customer)}}" method="post">
                    <button class="btn btn-delete" type="submit">Delete</button>
                    @csrf
                    @method('delete')
                </form>
            </div>
        </div>
        @empty
        <div class="table1">No customers yet</div>
        @endforelse

    </div>
</div>
</div>
</div>


@endsection
