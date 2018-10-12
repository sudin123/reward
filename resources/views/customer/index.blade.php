@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Dashboard
                        <button type="button"  data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" class="btn btn-outline-primary btn-sm pull-right">Add Customer</button>
                        @include('customer.partials._add-customer', ['customerId' => 0, 'customer' => null])
                    </div>

                    <div class="card-body">
                        <form method="GET" action="{{ route('home') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input id="email" type="email" class="form-control" name="email" autofocus placeholder="Email Address">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input id="email" class="form-control" name="phone"  autofocus placeholder="Phone Number">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-outline-primary">Search Customer</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form method="GET" action="{{ route('home') }}">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-outline-danger">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Points</th>
                                <th scope="col">Sale Amount</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customers as $key => $customer)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->phone  }}</td>
                                    <td>{{ $customer->reward }}</td>
                                    <td>{{ $customer->sale_amount }}</td>
                                    <td width="30%">
                                        <a href="{{ route('show-customer', $customer->id) }}" class="btn btn-success btn-sm">Edit</a>
                                        <a href="{{ route('show-points', $customer->id) }}" class="btn btn-success btn-sm">Update Points</a>
                                        <a href="{{ route('delete-customer', $customer->id) }}" class="btn btn-success btn-sm">Delete</a>
                                        @if($customer->reward >= 5)
                                            <a href="{{ route('use-points', $customer->id) }}" class="btn btn-success btn-sm">Use Points</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
