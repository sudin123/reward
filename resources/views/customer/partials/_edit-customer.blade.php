@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Edit Customer
                    </div>

                    <div class="card-body">
                        <form id="edit-customer-{{ $customer->id }}"  method="POST" action="{{ route('save-customer') }}">
                            <div class="modal-body">
                                @csrf
                                <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Customer Email</label>
                                    <input type="email"  name="email" value="{{ $customer->email ?? null }}" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Phone Number</label>
                                    <input type="number"  name="phone" value="{{ $customer->phone ?? null }}" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Sale Amount</label>
                                    <input type="text" name="sale_amount"  value="{{ $customer->sale_amount ?? null }}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Reward</label>
                                    <select name="reward" class="custom-select" id="inputGroupSelect02" required>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Sale Details</label>
                                    <textarea type="text"  name="sale_details" value="{{ $customer->sale_details ?? null }}" class="form-control"></textarea>
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
