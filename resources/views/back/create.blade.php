@extends('layouts.app')

@section('content')
@section('title', 'Create account')


<div class="container">
    <div>
        <h2 class="main-title">Create new account</h2>
    </div>
    <div class="new">
        <form action="{{route('customers-store')}}" method="post">
            <div class="flex div-line">
                <label class="label-new">Name</label>
                <input class="input" type="text" name="name" value="{{old('name')}}" required>
            </div>
            <div class="flex">
                <label>Surname</label>
                <input class="input" type="text" name="surname" class="" value="{{old('surname')}}" required>

            </div>
            <div class="flex">
                <label>Personal ID</label>
                <input class="input" type="text" name="personal_id" class="" value="{{old('personal_id')}}" required>
            </div>

            <div class="flex-center">
                <button type="submit" class="btn">Create</button>
            </div>
            @csrf
        </form>
    </div>
</div>
</div>

@endsection
