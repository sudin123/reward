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
                                    <label for="recipient-name" class="col-form-label">Customer Name</label>
                                    <input type="text" value="{{ $customer->name ?? null }}" name="name" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Customer Email</label>
                                    <input type="email"  name="email" value="{{ $customer->email ?? null }}" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Phone Number</label>
                                    <input type="number"  name="phone" value="{{ $customer->phone ?? null }}" class="form-control" required>
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
