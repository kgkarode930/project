<form role="form" method="POST" class="ajaxFormSubmit" action="{{ isset($action) ? $action : '' }}"
    enctype="multipart/form-data" data-redirect="ajaxModalCommon">
    @csrf
    @if (isset($method) && $method == 'PUT')
        @method('PUT')
    @endif
    <div class="box-body">
        <div class="form-group">
            <label>Country Name</label>
            <input name="country_name" type="text" class="form-control"
                value="{{ isset($data['country_name']) ? $data['country_name'] : '' }}"
                placeholder="Please enter country name..">
        </div>
        <div class="form-group">
            <label>Country Code</label>
            <input name="country_code" type="text" class="form-control"
                value="{{ isset($data['country_code']) ? $data['country_code'] : '' }}"
                placeholder="Please enter country code..">
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <input name="country_id" type="hidden" value="1">
        <button type="submit" class="btn btn-primary" id="ajaxFormSubmit">
            @if (isset($method) && $method == 'PUT')
                UPDATE
            @else
                SAVE
            @endif
        </button>
    </div>
</form>
