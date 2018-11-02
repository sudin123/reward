@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Use Reward Amount
                        <span class="badge badge-pill badge-primary">${{ $customer->reward_amount }}</span>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('save-used-points', $customer->id) }}">
                            <div class="modal-body">
                                @csrf
                                <input type="hidden" name="customer_id" value="{{ $customer->id }}">

                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Use Reward Amount</label>
                                    <input type="number" class="form-control"  name="reward_amount"  required>
                                </div>


                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Sale Details</label>
                                    <textarea type="text"  name="details" value="{{ $customer->sale_details ?? null }}" class="form-control"></textarea>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Use</button>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-header">
                        Points History
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Used Reward Amount</th>
                                <th scope="col">Details</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($histories as $key => $history)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>{{ $history->reward_amount }}</td>
                                    <td>{{ $history->details }}</td>
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
