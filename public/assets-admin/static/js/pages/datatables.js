let jquery_datatable_berita = $("#berita").DataTable({
    responsive: true,
    paging: false, // Nonaktifkan pagination
    info: false, // Nonaktifkan pesan "Showing 1 to 10 of 10 entries"
});

let jquery_datatable = $("#table1").DataTable({
    responsive: true,
});

let jquery_datatable_tabel_kecamatan = $("#tabel_kecamatan").DataTable({
    responsive: true,
});

let jquery_datatable_tabel_desa = $("#tabel_desa").DataTable({
    responsive: true,
});

let customized_datatable = $("#table2").DataTable({
    responsive: true,
    pagingType: "simple",
    dom:
        "<'row'<'col-3'l><'col-9'f>>" +
        "<'row dt-row'<'col-sm-12'tr>>" +
        "<'row'<'col-4'i><'col-8'p>>",
    language: {
        info: "Page _PAGE_ of _PAGES_",
        lengthMenu: "_MENU_ ",
        search: "",
        searchPlaceholder: "Search..",
    },
});

const setTableColor = () => {
    document
        .querySelectorAll(".dataTables_paginate .pagination")
        .forEach((dt) => {
            dt.classList.add("pagination-primary");
        });
};
setTableColor();
jquery_datatable.on("draw", setTableColor);
jquery_datatable_berita.on("draw", setTableColor);
