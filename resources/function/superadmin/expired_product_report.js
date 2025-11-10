$(document).ready(function () {
    const table = $("#expiredProductReport").DataTable({
        processing: true,
        serverSide: true,
        paginationType: "simple_numbers",
        responsive: true,
        layout: {
            topEnd: {
                search: {
                    placeholder: "Search here",
                },
            },
        },
        aLengthMenu: [
            [5, 10, 30, 50, -1],
            [5, 10, 30, 50, "All"],
        ],
        iDisplayLength: 10,
        language: {
            search: "Search",
        },
        fixedHeader: { header: true },
        scrollCollapse: true,
        scrollX: true,
        scrollY: 600,
        ajax: "/expired-product-report",
        autoWidth: false,
        columns: [
            { data: "sku", name: "sku", width: "10%" },
            { data: "name", name: "name", width: "25%" },
            {
                data: "price",
                name: "price",
                width: "10%",
                render: function (data) {
                    return "₱ " + parseFloat(data).toLocaleString("en-PH", {
                        minimumFractionDigits: 2,
                    });
                },
            },
            {
                data: "expiry_date",
                name: "expiry_date",
                width: "15%",
                render: function (data) {
                    if (!data) return "-";
                    const d = new Date(data);
                    return d.toLocaleDateString();
                },
            },
            {
                data: "total_expired",
                name: "total_expired",
                width: "10%",
                render: function (data) {
                    return data ?? 0;
                },
            },
        ],
        order: [[2, "desc"]], // sort by expiry_date (optional)
        drawCallback: function () {
            if (typeof lucide !== "undefined") {
                lucide.createIcons();
            }
        },
    });
});
