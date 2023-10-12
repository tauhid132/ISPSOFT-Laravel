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
    <div class="card-body table-responsive mt-xl-0">
        <div class="hstack gap-2 flex-wrap">
            @foreach ($users as $u )
            <div class="form-check form-check-inline">
                <input class="form-check-input link_checkbox" type="checkbox" name="link_checkbox[]" value="{{ $u->user->id }}">
                <label class="form-check-label" for="inlineCheckbox6">{{ $u->user->username }}</label>
            </div>
            @endforeach
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-primary float-end send_sms"><i class="fa fa-paper-plane me-1"></i>Send SMS</button>
    </div>
</div>