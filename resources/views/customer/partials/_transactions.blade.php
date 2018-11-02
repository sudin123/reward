@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Customer Transactions
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Sale Amount</th>
                                <th scope="col">Reward</th>
                                <th scope="col">Reward Amount</th>
                                <th scope="col">Sale Details</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customer->transactions as $key => $transaction)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <th scope="row">${{ $transaction->sale_amount }}</th>
                                    <th scope="row">{{ $transaction->reward }} %</th>
                                    <th scope="row">${{ $transaction->reward_amount }}</th>
                                    <th scope="row">{{ $transaction->sale_details }}</th>
                                    <td width="30%">
                                        <a href="{{ route('add-transaction', [$transaction->customer_id, $transaction->id]) }}" class="btn btn-success btn-sm">Edit</a>
                                        <a href="{{ route('delete-transaction', $transaction->id) }}" class="btn btn-success btn-sm">Delete</a>
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
