<form role="form" method="POST" class="ajaxFormSubmit" action="{{ isset($action) ? $action : '' }}"
    enctype="multipart/form-data" data-redirect="ajaxModalCommon">
    @csrf
    @if (isset($method) && $method == 'PUT')
        @method('PUT')
    @endif
    <div class="box-body">
        <div class="form-group">
            <label>Country</label>
            <select name="country_id" data-dep_dd_name="branch_district"
                data-url="{{ url('getAjaxDropdown') . '?req=districts' }}" data-dep_dd2_name="branch_city"
                class="form-control ajaxChangeCDropDown">
                <option value="">---Select Country---</option>
                @isset($countries)
                    @foreach ($countries as $country)
                        <option
                            {{ isset($data['country_id']) && $data['country_id'] == $country->id ? 'selected="selected"' : '' }}
                            value="{{ $country->id }}">{{ $country->country_name }}</option>
                    @endforeach
                @endisset
            </select>
        </div>

        <div class="form-group">
            <label>State Name</label>
            <input name="state_name" type="text" class="form-control"
                value="{{ isset($data['state_name']) ? $data['state_name'] : '' }}"
                placeholder="Please enter state name..">
        </div>
        <div class="form-group">
            <label>State Code</label>
            <input name="state_code" type="text" class="form-control"
                value="{{ isset($data['state_code']) ? $data['state_code'] : '' }}"
                placeholder="Please enter state code..">
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
