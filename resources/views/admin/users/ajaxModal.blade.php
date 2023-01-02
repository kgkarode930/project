<form role="form" method="POST" class="ajaxFormSubmit" action="{{ isset($action) ? $action : '' }}"
    enctype="multipart/form-data" data-redirect="ajaxModalCommon" autocomplete="off">
    @csrf
    @if (isset($method) && $method == 'PUT')
        @method('PUT')
    @endif
    <div class="box-body">
        <div class="row">
            <div class="form-group col-md-4">
                <label>Full Name</label>
                <input name="name" type="text" class="form-control"
                    value="{{ isset($data['name']) ? $data['name'] : '' }}" placeholder="Please enter name..">
            </div>
            <div class="form-group col-md-4">
                <label>Email Address</label>
                <input name="email" type="text" class="form-control"
                    value="{{ isset($data['email']) ? $data['email'] : '' }}" placeholder="rock@test.com">
            </div>
            <div class="form-group col-md-4">
                <label>Mobile Number</label>
                <input name="mobile" type="text" class="form-control"
                    value="{{ isset($data['mobile']) ? $data['mobile'] : '' }}" placeholder="rock@test.com">
            </div>

            <div class="form-group col-md-4">
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


            <div class="form-group col-md-4">
                <label>State</label>
                <select name="state_id" data-dep_dd_name="city_id"
                    data-url="{{ url('getAjaxDropdown') . '?req=districts' }}" data-dep_dd2_name="branch_city"
                    class="form-control ajaxChangeCDropDown">
                    <option value="">---Select State---</option>
                    @isset($states)
                        @foreach ($states as $state)
                            <option
                                {{ isset($data['state_id']) && $data['state_id'] == $state->id ? 'selected="selected"' : '' }}
                                value="{{ $state->id }}">{{ $state->state_name }}</option>
                        @endforeach
                    @endisset
                </select>
            </div>


            <div class="form-group col-md-4">
                <label>City</label>
                <select name="city_id" class="form-control ajaxChangeCDropDown">
                    <option value="">---Select City---</option>
                    @isset($cities)
                        @foreach ($cities as $city)
                            <option
                                {{ isset($data['city_id']) && $data['city_id'] == $city->id ? 'selected' : '' }}
                                value="{{ $city->id }}">{{ $city->city_name }}</option>
                        @endforeach
                    @endisset
                </select>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <div class="row">
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary" id="ajaxFormSubmit">
                    @if (isset($method) && $method == 'PUT')
                        UPDATE
                    @else
                        SAVE
                    @endif
                </button>
            </div>
        </div>
    </div>
</form>
