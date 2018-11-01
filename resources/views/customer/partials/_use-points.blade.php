@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Use Points
                        <span class="badge badge-pill badge-primary">Reward Points: {{ $customer->reward }}</span>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('save-used-points', $customer->id) }}">
                            <div class="modal-body">
                                @csrf
                                <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Use Points</label>
                                    <input type="number" class="form-control"  name="point_used"  required>
                                </div>


                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Sale Details</label>
                                    <textarea type="text"  name="details" value="{{ $customer->sale_details ?? null }}" class="form-control"></textarea>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Use Points</button>
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
                                <th scope="col">Point Used</th>
                                <th scope="col">Details</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($histories as $key => $history)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>{{ $history->point_used }}</td>
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
