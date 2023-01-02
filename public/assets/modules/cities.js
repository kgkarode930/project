$(document).ready(function () {
    function mainDataTable() {
        const tableObj = $("#ajaxDataTable").DataTable({
            processing: false,
            serverSide: true,
            cache: true,
            type: "GET",
            ajax: {
                url: $("#ajaxDataTable").data("url"),
                method: "GET",
                beforeSend: function () {
                    loaderShow();
                },
                complete: function () {
                    loaderHide();
                },
            },
            searchDelay: 350,
            columns: [
                {
                    data: "id",
                    name: "id",
                },
                {
                    data: "state.state_name",
                    name: "state.state_name",
                },
                {
                    data: "state.country.country_name",
                    name: "state.country.country_name",
                },
                {
                    data: "city_name",
                    name: "city_name",
                },
                {
                    data: "city_code",
                    name: "city_code",
                },
                {
                    data: "action",
                    name: "action",
                },
            ],
            columnDefs: [
                {
                    orderable: false,
                    targets: [-1],
                },
                {
                    searchable: false,
                    targets: [],
                },
            ],
            order: [[0, "asc"]],
        });
    }
    mainDataTable();
});


$(document).on("click", ".addAjaxElement", function (e) {
    e.preventDefault();
    let container_el = $(this).data("container_el");
    let randCode = Math.floor(Math.random() * 100000) + 5;
    let html = '<div class="row">'
    +'    <div class="form-group col-md-4">'
    +'        <label>Color Name</label>'
    +'        <input name="cities['+ randCode +'][city_name]" type="text" class="form-control" value=""'
    +'            placeholder="Color name..">'
    +'    </div>'
    +'    <div class="form-group col-md-3">'
    +'        <label>Color Code</label>'
    +'        <input name="cities['+ randCode +'][city_code]" type="text" class="form-control" value=""'
    +'            placeholder="Color Code..">'
    +'    </div>'
    +'    <div class="form-group col-md-1">'
    +'        <a href="#" class="btn btn-md btn-danger removeMoreInFormGroup removeAjaxElement"'
    +'            data-container_el="#city_container"><i class="fa fa-trash-o" aria-hidden="true"></i></a>'
    +'    </div>'
    +'</div>';
    $(container_el).append(html);
});


$(document).on("click", ".removeAjaxElement", function (e) {
    e.preventDefault();
    $(this).parents(".row").remove();
});
