@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Add Transaction
                    </div>

                    <div class="card-body">
                        <form  method="POST" action="{{ route('save-transaction') }}">
                            <div class="modal-body">
                                @csrf
                                <input type="hidden" name="customer_id" value="{{ $customerId ?? $transaction->customer_id }}">
                                <input type="hidden" name="transaction_id" value="{{ $transaction->id ?? null }}">

                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Sale Amount</label>
                                    <input type="text" name="sale_amount" value="{{$transaction->sale_amount ?? null}}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Reward</label>
                                    <select name="reward" class="custom-select" id="inputGroupSelect02" value="{{ $transaction->reward ?? 0 }}" required>
                                        <option value="0">0</option>
                                        <option value="1">1%</option>
                                        <option value="2">2%</option>
                                        <option value="3">3%</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Sale Details</label>
                                    <textarea type="text"  name="sale_details"  class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
