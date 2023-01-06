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
                    data: "name",
                    name: "name",
                },
                {
                    data: "address",
                    name: "address",
                },
                {
                    data: "contact",
                    name: "contact",
                },
                {
                    data: "city",
                    name: "city",
                },
                {
                    data: "zip_code",
                    name: "zip_code",
                },
                {
                    data: "kind_of_property",
                    name: "kind_of_property",
                },
                {
                    data: "property_status",
                    name: "property_status",
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
