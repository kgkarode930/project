<form role="form" method="POST" class="ajaxFormSubmit" action="{{ isset($action) ? $action : '' }}"
    enctype="multipart/form-data" data-redirect="ajaxModalCommon" autocomplete="off">
    @csrf
    @if (isset($method) && $method == 'PUT')
        @method('PUT')
    @endif
    <div class="box-body">
        <div class="row">
            <div class="form-group col-md-4">
                <label>Property Owner Name</label>
                <input name="name" type="text" class="form-control" required
                    value="{{ isset($data['name']) ? $data['name'] : '' }}" placeholder="Please enter">
            </div>
            <div class="form-group col-md-4">
                <label>Property Owner Contact</label>
                <input name="contact" type="text" class="form-control" required
                    value="{{ isset($data['contact']) ? $data['contact'] : '' }}" placeholder="Please enter">
            </div>
            <div class="form-group col-md-4">
                <label>Address</label>
                <input name="address" type="text" class="form-control" required
                    value="{{ isset($data['address']) ? $data['address'] : '' }}" placeholder="Please Enter ">
            </div>
            <div class="form-group col-md-4">
                <label>City</label>
                <input name="city" type="text" class="form-control" required
                    value="{{ isset($data['city']) ? $data['city'] : '' }}" placeholder="Please Enter">
            </div>
            <div class="form-group col-md-4">
                <label>Zip Code</label>
                <input name="zip_code" type="number" class="form-control" required
                    value="{{ isset($data['zip_code']) ? $data['zip_code'] : '' }}" placeholder="Please Enter">
            </div>
            <div class="form-group col-md-4">
                <label>Kind Of Property</label>
                <input name="kind_of_property" type="text" class="form-control" required
                    value="{{ isset($data['kind_of_property']) ? $data['kind_of_property'] : '' }}" placeholder="Please Enter">
            </div>
            <div class="form-group col-md-4">
                <label>Area</label>
                <input name="area" type="text" class="form-control" required
                    value="{{ isset($data['area']) ? $data['area'] : '' }}" placeholder="Please Enter">
            </div>
            <div class="form-group col-md-4">
                <label>Total Valuation</label>
                <input name="total_valuation" type="number" class="form-control" required
                    value="{{ isset($data['total_valuation']) ? $data['total_valuation'] : '' }}" placeholder="Please Enter">
            </div>
            <div class="form-group col-md-12">
                <label>Status : </label>
                <select class="form-control" name="property_status" required>
                    <option value="1"
                        {{ isset($data['property_status']) && $data['property_status'] == '1' ? 'selected="selected"' : '' }}>
                        Active
                    </option>
                    <option value="0"
                        {{ isset($data['property_status']) && $data['property_status'] == '0' ? 'selected="selected"' : '' }}>
                        In
                        Active
                    </option>
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
