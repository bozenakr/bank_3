@extends('layouts.app')

@section('content')
@section('title', 'Edit account')


<div class="container">
    <div>
        <h2 class="main-title">Update Client Information</h2>
    </div>
    <div class="new">
        <form action="{{route('customers-update', $customer)}}" method="post">
            <div class="flex div-line">
                <label class="label-new">Name</label>
                <input class="input" type="text" name="name" value="{{$customer->name}}" required>
            </div>
            <div class="flex">
                <label>Surname</label>
                <input class="input" type="text" name="surname" value="{{$customer->surname}}" required>
            </div>
            <div class="flex">
                <label>Personal ID</label>
                <input class="input" type="text" name="personal_id" value="{{$customer->personal_id}}" required>
            </div>
            {{-- <div class="flex">
                <label>Iban</label>
                <input class="input" type="text" name="personal_id" style="background:lightgrey" readonly value="{{$customer->iban}}">
    </div> --}}


    <div class="flex-center">
        <button type="submit" class="btn">Save changes</button>
    </div>
    @csrf
    @method('put')
    </form>
</div>
</div>
</div>

@endsection
