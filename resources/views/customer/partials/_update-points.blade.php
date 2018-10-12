@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Update {{ $customer->email  }} Points
                        <span class="badge badge-pill badge-primary">Reward Points: {{ $customer->reward }}</span>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('update-points') }}">
                            <div class="modal-body">
                                @csrf
                                <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Reward</label>
                                    <select name="reward" class="custom-select" id="inputGroupSelect02" required>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
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
