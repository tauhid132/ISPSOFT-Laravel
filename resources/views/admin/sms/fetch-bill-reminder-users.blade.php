<div class="card mt-0">
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">Selected Users</h4>
        <div class="flex-shrink-0">
            <div class="form-check">
                <label for="custom-switches-showcode" class="form-label text-muted">Select All</label>
                <input class="form-check-input check_all" type="checkbox" id="inlineCheckbox6">
            </div>
        </div>
    </div>
    <div class="table-responsive ps-4">
        <table class="table align-middle table-nowrap mb-0">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Mobile Number</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $u )
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <th scope="row"><input class="form-check-input link_checkbox" type="checkbox" name="link_checkbox[]" value="{{ $u->user->id }}"></th>
                    <td>{{ $u->user->username }}</td>
                    <td>{{ $u->user->customer_name }}</td>
                    <td>{{ $u->user->mobile_no }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- <div class="card-body table-responsive mt-xl-0">
        <div class="hstack gap-2 flex-wrap">
            @foreach ($users as $u )
            <div class="form-check form-check-inline">
                <input class="form-check-input link_checkbox" type="checkbox" name="link_checkbox[]" value="{{ $u->user->id }}">
                <label class="form-check-label" for="inlineCheckbox6">{{ $u->user->username }}</label>
            </div>
            @endforeach
        </div>
    </div> --}}
    <div class="card-footer">
        <button class="btn btn-primary float-end send_sms"><i class="fa fa-paper-plane me-1"></i>Send SMS</button>
    </div>
</div>