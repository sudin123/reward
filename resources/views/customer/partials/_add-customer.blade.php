<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Customer Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!!  Form::open(['route' => 'save-customer', 'method' => 'POST']) !!}
                <div class="modal-body">
                        @csrf
                        <input type="hidden" name="customer_id" value="{{ $customerId }}">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Customer Email</label>
                            <input type="email" value="{{ $customer->email ?? null }}" name="email" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Phone Number</label>
                            <input type="number" value="{{ $customer->phone ?? null }}" name="phone" class="form-control">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>


