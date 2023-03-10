@extends('layouts.app')

@section('content')
@section('title', 'Client list')

<div class="container-alerts">
    <div class="row justify-content-center">
        <div class="col-md-6">

            {{-- Form --}}
            <form action="{{route('customers-index')}}" method="get">

                <div class="flex">


                    {{-- Sort --}}
                    <div class="col-3">
                        <div class="mb-3">
                            <label class="form-label">Sort by</label>
                            <select class="form-select" name="sort">
                                <option>default</option>
                                @foreach($sortSelect as $value => $name)
                                <option value="{{$value}}" @if($sortShow==$value) selected @endif>{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    {{-- Filter --}}
                    <div class="col-3">
                        <div class="mb-3">
                            <label class="form-label">Filter</label>
                            <select class="form-select" name="filter">
                                <option>all</option>
                                @foreach($filterSelect as $value => $name)
                                <option value="{{$value}}" @if($filterShow==$value) selected @endif>{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    {{-- Paginator --}}
                    <div class="col-3">
                        <div class="mb-3">
                            <label class="form-label">Per page</label>
                            <select class="form-select" name="per_page">
                                {{-- <option>default</option> --}}
                                @foreach($perPageSelect as $value)
                                <option value="{{$value}}" @if($perPageShow==$value) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div class="col-3">
                        <div class="buttons" style="margin-top: 12px">
                            <button type="submit" class="btn btn-light" style="margin-right: 5px">Show</button>
                            <a href="{{route('customers-index')}}" class="btn">Reset</a>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>


<div class="container-alerts">
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
@if($perPageShow != 'all')
<div class="container-alerts">
    <div class="m-2">{{$customers->links()}}</div>
</div>
@endif

</div>
</div>

@endsection
