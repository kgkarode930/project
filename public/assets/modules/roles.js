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
            ],
            columnDefs: [
                {
                    orderable: false,
                    targets: [0, 1],
                },
                {
                    searchable: false,
                    targets: [],
                },
            ],
            order: [],
        });
    }
    mainDataTable();
});
