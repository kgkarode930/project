<form role="form" method="POST" class="ajaxFormSubmit" action="{{ isset($action) ? $action : '' }}"
    enctype="multipart/form-data" data-redirect="ajaxModalCommon" autocomplete="off">
    @csrf
    @if (isset($method) && $method == 'PUT')
        @method('PUT')
    @endif
    <div class="box-body">
        <div class="row">
            <div class="form-group col-md-4">
                <label>Broker Name</label>
                <input name="name" type="text" class="form-control" required
                    value="{{ isset($data['name']) ? $data['name'] : '' }}" placeholder="Please enter name..">
            </div>
            <div class="form-group col-md-4">
                <label>Broker Contact</label>
                <input name="contact" type="text" class="form-control" required
                    value="{{ isset($data['contact']) ? $data['contact'] : '' }}" placeholder="test@test.com">
            </div>
            <div class="form-group col-md-4">
                <label>Broker Email Address</label>
                <input name="email" type="email" class="form-control" required
                    value="{{ isset($data['email']) ? $data['email'] : '' }}" placeholder="test@test.com">
            </div>
            <div class="form-group col-md-4">
                <label>Broker Experience</label>
                <input name="experience" type="number" class="form-control" required
                    value="{{ isset($data['experience']) ? $data['experience'] : '' }}" placeholder="Please Enter Experience..">
            </div>
            <div class="form-group col-md-4">
                <label>Broker Commission(%)</label>
                <input name="commission" type="number" class="form-control" required
                    value="{{ isset($data['commission']) ? $data['commission'] : '' }}" placeholder="Please Enter Experience..">
            </div>
            <div class="form-group col-md-4">
                <label>Select Property</label>
                <select name="property_ids[]" required
                    class="form-control" multiple="multiple">
                    @isset($properties)
                        @foreach ($properties as $property)
                            <option
                                {{ isset($data['property_ids']) && in_array($property->id,(array)$data['property_ids']) ? 'selected' : '' }}
                                value="{{ $property->id }}">{{ $property->name }}</option>
                        @endforeach
                    @endisset
                </select>
            </div>

            <div class="form-group col-md-12">
                <label>Status : </label>
                <select class="form-control" name="active_status" required>
                    <option value="1"
                        {{ isset($data['active_status']) && $data['active_status'] == '1' ? 'selected="selected"' : '' }}>
                        Active
                    </option>
                    <option value="0"
                        {{ isset($data['active_status']) && $data['active_status'] == '0' ? 'selected="selected"' : '' }}>
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
