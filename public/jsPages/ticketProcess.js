$(document).ready(function (e) {
    loadTicketDetails();

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $("#reply-form").submit(function (e) {
        e.preventDefault();

        $("#loader").show();

        //Saved
        var formData = new FormData(this);
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "store-reply",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $("#loader").hide();

                Swal.fire(
                    "Saved success!",
                    "Reply has been successfully sent, Ref Number : " +
                        data.ref_no,
                    "success"
                );

                reset_field();
            },
            error: function (data) {
                $("#loader").hide();

                if (
                    data.responseJSON.errors.reply ==
                    "The reply field is required."
                ) {
                    printErrorMsg4("The reply field is required.");
                }
            },
        });
    });
});

function printErrorMsg4(msg) {
    $(".print-error-msg4").find("span").html("");
    $(".print-error-msg4").css("display", "block");
    $(".print-error-msg4").find("span").append(msg);
}

function reset_field() {
    $("#reply").val("");
    $(".print-error-msg4").css("display", "none");
}

function loadTicketDetails() {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: "ticketList",
        cache: false,
        contentType: false,
        processData: false,
        success: (data) => {
            console.log("Response:", data);
            var html = "";
            var htmlMobile = "";
            $(data.ticket_details.data).each(function (key, val) {
                var ref_number = val.ref_no;
                var name = val.customer_name;
                var status = val.status;
                var isView = val.isView;

                html += "<tr>";
                html += "<td>" + ref_number + "</td>";
                html += "<td>" + name + "</td>";
                html += "<td>";
                if (isView == 0) {
                    html += '<span class="badge text-bg-info">New</span>';
                }
                html += "</td>";
                html += "<td>" + status + "</td>";
                html += "<td>";
                html +=
                    "<a class='btn btn-success btn-sm' href='/view/" +
                    val.id +
                    "'>View</a> ";
                html +=
                    "<a class='btn btn-danger btn-sm' href='javascript:void(0);' data-id='" +
                    val.id +
                    "'>Delete</a>";
                html += "</td>";
                html += "</tr>";

                htmlMobile += "<div class='card text-center my-2'>";
                htmlMobile +=
                    "<div class='card-header'>" + val.ref_no + "</div>";
                htmlMobile += "<div class='card-body'>";
                htmlMobile +=
                    "<h5 class='card-title'>" + val.customer_name + "</h5>";

                if (val.isView == 0) {
                    htmlMobile += "<span class='badge text-bg-info'>New</span>";
                }

                htmlMobile += "<p class='card-text'>" + val.status + "</p>";
                htmlMobile +=
                    "<a href='/ticket/view/" +
                    val.id +
                    "' class='btn btn-sm btn-success'>View</a>";
                htmlMobile +=
                    "<a class='btn btn-danger btn-sm ms-2' href='javascript:void(0);' data-id='" +
                    val.id +
                    "'>Delete</a>";
                htmlMobile += "</div>";
                htmlMobile += "</div>";
            });

            $("#ticketBody").html(html);
            $("#ticketBodyMobile").html(htmlMobile);

            var last_page = data.ticket_details.last_page;
            var current_page = data.ticket_details.current_page;
            var last_page_url = data.ticket_details.last_page_url;
            var Previous = 1;
            if (current_page > 1) {
                Previous = current_page - 1;
            }
            var Next = current_page + 1;
            if (last_page_url == current_page) {
                Next = current_page;
            }

            var pagination = "";
            pagination += '<nav aria-label="Page navigation example">';
            pagination += '<ul class="pagination">';
            pagination +=
                '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="loadTableData(' +
                Previous +
                ')">Previous</a></li>';
            for (var i = 1; i <= last_page; i++) {
                if (current_page == i) {
                    pagination +=
                        '<li class="page-item active"><a class="page-link" href="javascript:void(0);" onclick="loadTableData(' +
                        i +
                        ')">' +
                        i +
                        "</a></li>";
                } else {
                    pagination +=
                        '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="loadTableData(' +
                        i +
                        ')">' +
                        i +
                        "</a></li>";
                }
            }
            pagination +=
                '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="loadTableData(' +
                Next +
                ')" >Next</a></li>';
            pagination += "</ul>";
            pagination += "</nav>";

            $("#pagination").html(pagination);
        },
        error: function (data) {
            // console.log(data);
        },
    });
}

function loadTableData(url) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: "ticketList?page=" + url,
        cache: false,
        contentType: false,
        processData: false,
        success: (data) => {
            console.log("Response:", data);
            var html = "";
            var htmlMobile = "";
            $(data.ticket_details.data).each(function (key, val) {
                var ref_number = val.ref_no;
                var name = val.customer_name;
                var status = val.status;
                var isView = val.isView;

                html += "<tr>";
                html += "<td>" + ref_number + "</td>";
                html += "<td>" + name + "</td>";
                html += "<td>";
                if (isView == 0) {
                    html += '<span class="badge text-bg-info">New</span>';
                }
                html += "</td>";
                html += "<td>" + status + "</td>";
                html += "<td>";
                html +=
                    "<a class='btn btn-success btn-sm' href='/view/" +
                    val.id +
                    "'>View</a> ";
                html +=
                    "<a class='btn btn-danger btn-sm' href='javascript:void(0);' data-id='" +
                    val.id +
                    "'>Delete</a>";
                html += "</td>";
                html += "</tr>";

                htmlMobile += "<div class='card text-center my-2'>";
                htmlMobile +=
                    "<div class='card-header'>" + val.ref_no + "</div>";
                htmlMobile += "<div class='card-body'>";
                htmlMobile +=
                    "<h5 class='card-title'>" + val.customer_name + "</h5>";

                if (val.isView == 0) {
                    htmlMobile += "<span class='badge text-bg-info'>New</span>";
                }

                htmlMobile += "<p class='card-text'>" + val.status + "</p>";
                htmlMobile +=
                    "<a href='/ticket/view/" +
                    val.id +
                    "' class='btn btn-sm btn-success'>View</a>";
                htmlMobile +=
                    "<a class='btn btn-danger btn-sm ms-2' href='javascript:void(0);' data-id='" +
                    val.id +
                    "'>Delete</a>";
                htmlMobile += "</div>";
                htmlMobile += "</div>";
            });

            $("#ticketBody").html(html);
            $("#ticketBodyMobile").html(htmlMobile);

            var last_page = data.ticket_details.last_page;
            var current_page = data.ticket_details.current_page;
            var last_page_url = data.ticket_details.last_page_url;
            var Previous = 1;
            if (current_page > 1) {
                Previous = current_page - 1;
            }
            var Next = current_page + 1;
            if (last_page_url == current_page) {
                Next = current_page;
            }

            var pagination = "";
            pagination += '<nav aria-label="Page navigation example">';
            pagination += '<ul class="pagination">';
            pagination +=
                '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="loadTableData(' +
                Previous +
                ')">Previous</a></li>';
            for (var i = 1; i <= last_page; i++) {
                if (current_page == i) {
                    pagination +=
                        '<li class="page-item active"><a class="page-link" href="javascript:void(0);" onclick="loadTableData(' +
                        i +
                        ')">' +
                        i +
                        "</a></li>";
                } else {
                    pagination +=
                        '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="loadTableData(' +
                        i +
                        ')">' +
                        i +
                        "</a></li>";
                }
            }
            pagination +=
                '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="loadTableData(' +
                Next +
                ')" >Next</a></li>';
            pagination += "</ul>";
            pagination += "</nav>";

            $("#pagination").html(pagination);
        },
        error: function (data) {
            // console.log(data);
        },
    });
}

$("#btnSearch").on("click", function () {
    var textCustomerName = $("#textCustomerName").val();

    var formData = new FormData();
    formData.append("textCustomerName", textCustomerName);

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: "ticketSearchByCustomer",
        cache: false,
        data: formData,
        contentType: false,
        processData: false,
        success: (data) => {
            console.log("Response:", data);
            var html = "";
            var htmlMobile = "";
            $(data.ticket_details.data).each(function (key, val) {
                var ref_number = val.ref_no;
                var name = val.customer_name;
                var status = val.status;
                var isView = val.isView;

                html += "<tr>";
                html += "<td>" + ref_number + "</td>";
                html += "<td>" + name + "</td>";
                html += "<td>";
                if (isView == 0) {
                    html += '<span class="badge text-bg-info">New</span>';
                }
                html += "</td>";
                html += "<td>" + status + "</td>";
                html += "<td>";
                html +=
                    "<a class='btn btn-success btn-sm' href='/view/" +
                    val.id +
                    "'>View</a> ";
                html +=
                    "<a class='btn btn-danger btn-sm' href='javascript:void(0);' data-id='" +
                    val.id +
                    "'>Delete</a>";
                html += "</td>";
                html += "</tr>";

                htmlMobile += "<div class='card text-center my-2'>";
                htmlMobile +=
                    "<div class='card-header'>" + val.ref_no + "</div>";
                htmlMobile += "<div class='card-body'>";
                htmlMobile +=
                    "<h5 class='card-title'>" + val.customer_name + "</h5>";

                if (val.isView == 0) {
                    htmlMobile += "<span class='badge text-bg-info'>New</span>";
                }

                htmlMobile += "<p class='card-text'>" + val.status + "</p>";
                htmlMobile +=
                    "<a href='/ticket/view/" +
                    val.id +
                    "' class='btn btn-sm btn-success'>View</a>";
                htmlMobile +=
                    "<a class='btn btn-danger btn-sm ms-2' href='javascript:void(0);' data-id='" +
                    val.id +
                    "'>Delete</a>";
                htmlMobile += "</div>";
                htmlMobile += "</div>";
            });

            $("#ticketBody").html(html);
            $("#ticketBodyMobile").html(htmlMobile);

            var last_page = data.ticket_details.last_page;
            var current_page = data.ticket_details.current_page;
            var last_page_url = data.ticket_details.last_page_url;
            var Previous = 1;
            if (current_page > 1) {
                Previous = current_page - 1;
            }
            var Next = current_page + 1;
            if (last_page_url == current_page) {
                Next = current_page;
            }

            var pagination = "";
            pagination += '<nav aria-label="Page navigation example">';
            pagination += '<ul class="pagination">';
            pagination +=
                '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="loadTableData(' +
                Previous +
                ')">Previous</a></li>';
            for (var i = 1; i <= last_page; i++) {
                if (current_page == i) {
                    pagination +=
                        '<li class="page-item active"><a class="page-link" href="javascript:void(0);" onclick="loadTableData(' +
                        i +
                        ')">' +
                        i +
                        "</a></li>";
                } else {
                    pagination +=
                        '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="loadTableData(' +
                        i +
                        ')">' +
                        i +
                        "</a></li>";
                }
            }
            pagination +=
                '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="loadTableData(' +
                Next +
                ')" >Next</a></li>';
            pagination += "</ul>";
            pagination += "</nav>";

            $("#pagination").html(pagination);
        },
        error: function (data) {
            // console.log(data);
        },
    });
});

$(document).on("click", ".btn-danger", function (e) {
    e.preventDefault();

    var ticketId = $(this).data("id");
    console.log(ticketId);
    Swal.fire({
        title: "Are you sure?",
        text: "Do you want to delete this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "DELETE",
                url: "/ticket/delete/" + ticketId,
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (data) {
                    if (data.status === 200) {
                        Swal.fire("Deleted!", data.message, "success");

                        loadTableData();
                    } else {
                        Swal.fire(
                            "Error!",
                            "There was an issue deleting the ticket.",
                            "error"
                        );
                    }
                },
                error: function (data) {
                    // console.log(data);
                },
            });
        }
    });
});

// $(document).ready(function () {
//     function isMobile() {
//         return window.innerWidth < 768;
//     }

//     $("#tickets-table").DataTable({
//         paging: !isMobile(),
//         searching: !isMobile(),
//         info: !isMobile(),
//         lengthChange: !isMobile(),
//         ordering: true,
//         pageLength: 10,

//         language: {
//             search: "Search by Customer Name:",
//         },
//     });
// });
