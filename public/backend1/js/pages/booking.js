$(document).ready(function () {
  ReloadBookingTable();

  ////////////////////////////////////////////////// Add
  $.validator.addMethod(
    "filesize",
    function (value, element, param) {
      if (this.optional(element)) {
        return true;
      }
      return element.files[0].size <= param * 1024 * 1024;
    },
    "File size must be less than {0} MB",
  );

  $("#bookingForm").validate({
    rules: {
        total_rooms: {
            required: true,
            digits: true,
            min: 1
        }
    },

    messages: {
        total_rooms: {
            required: "Please enter total rooms",
            digits: "Only numbers are allowed",
            min: "At least 1 room is required"
        }
    },

    highlight: function (element) {
      $(element).addClass("is-invalid");
    },

    unhighlight: function (element) {
      $(element).removeClass("is-invalid");
    },

    submitHandler: function () {
      let formData = new FormData($("#bookingForm")[0]);

      $.ajax({
        url: BASE_URL + "add-booking",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
          if (response.status === "success") {
            ReloadBookingTable();

            var offcanvasEl = document.getElementById("addPropertiesOffcanvas");
            var offcanvasInstance =
              bootstrap.Offcanvas.getInstance(offcanvasEl);
            offcanvasInstance.hide();
            $("#booking_code").val("");
            $("#check_in").val("");

            $("#check_out").val("");
            $("#total_rooms").val("");
             $("#total_guests").val("");
              $("#total_amount").val("");
          }
        },
        error: function (xhr, status, error) {
          console.error(error);
          alert("Error!");
        },
      });
    },
  });

  /////////////////////////////////////////// Edit
  $(document).on("click", ".editBtn", function () {
      var row = $(this).closest("tr");
    var id = $(this).data("id");
    $.ajax({
      url: BASE_URL + "edit-booking/" + id,
      type: "GET",
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
              var data = response.user; 
          $("#editbooking_code").val(data.booking_code);
          $("#editcheck_in").val(data.check_in);
          $("#editcheck_out").val(data.check_out);
          $("#edittotal_rooms").val(data.total_rooms);
          $("#edittotal_guests").val(data.total_guests);
          $("#edittotal_amount").val(data.total_amount);
         

         

          //  Open Modal
          let offcanvas = new bootstrap.Offcanvas(
            document.getElementById("editPropertiesOffcanvas"),
          );
          offcanvas.show();
          // Save Changes Button Click
          $("#saveEditBtn")
            .off("click")
            .on("click", function () {
              var formData = {
                booking_code: $("#editbooking_code").val(),
                check_in: $("#editcheck_in").val(),
                 check_out: $("#editcheck_out").val(),
                  total_rooms: $("#edittotal_rooms").val(),
                   total_guests: $("#edittotal_guests").val(),
                    total_amount: $("#edittotal_amount").val(),
               
              };

              $.post(
                BASE_URL + "update-booking/" + id,
                formData,
                function (res) {
                  if (res.status === "success") {
                    var offcanvasEl = document.getElementById(
                      "editPropertiesOffcanvas",
                    );
                    var offcanvasInstance =
                      bootstrap.Offcanvas.getInstance(offcanvasEl);
                    offcanvasInstance.hide();
                    ReloadBookingTable();
                  } else {
                    alert("Update failed!");
                  }
                },
                "json",
              );
            });
        } else {
          alert("Error: " + response.message);
        }
      },
      error: function () {
        alert("AJAX Error while loading property data!");
      },
    });
  });

 

  ////////////////////////////////////////////// Delete
  $(document).on("click", ".deleteBtn", function () {
    var row = $(this).closest("tr");
    var id = $(this).data("id");

    Swal.fire({
      title: "Are you sure?",
      text: "This city will be permanently deleted!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "Cancel",
    }).then((result) => {
      if (result.isConfirmed) {
        $.get(
          BASE_URL + "delete-booking/" + id,
          function (response) {
            if (response.status === "success") {
              bookingTable.row(row).remove().draw(false);
              Swal.fire({
                title: "Deleted!",
                text: "City deleted successfully.",
                icon: "success",
                timer: 2000,
              });
            } else {
              Swal.fire({
                title: "Error!",
                text: "Failed to delete city.",
                icon: "error",
              });
            }
          },
          "json",
        );
      }
    });
  });

  ///////////////////////////////////////////////////// Toggle Status
  $(document).on("click", ".toggleStatusBtn", function () {
    var id = $(this).data("id");
    var newStatus = $(this).data("status");

    $.ajax({
      url: BASE_URL + "toggle-status/" + id,
      method: "POST",
      data: { status: newStatus },
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          ReloadBookingTable(); // Refresh the table
          Swal.fire({
            icon: "success",
            title: "Status updated Successfully!",
            showConfirmButton: false,
            timer: 1500,
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Status Failed!",
            text: "Please try again.",
          });
        }
      },
      error: function () {
        alert("Something went wrong while updating status.");
      },
    });
  });

  ////////////////////////////////////////////////// Get
  var bookingTable;
  // reload function to  reloadTabledata
  function ReloadBookingTable() {
    let index = 1;
    if ($.fn.DataTable.isDataTable("#bookingsTable")) {
      $("#bookingsTable").DataTable().clear().destroy(); // destroy old instance
    }
    bookingTable = $("#bookingsTable").DataTable({
      pageLength: 5,
      columnDefs: [
        { targets: 0, width: "40px" },
        { targets: "_all", width: "auto" },
      ],
    });

    $.get(
      BASE_URL + "get-booking",
      function (data) {
        let booking = Array.isArray(data) ? data : data.bookings;

        if (Array.isArray(booking)) {
          booking.forEach(function (bookings) {
            let statusText =
              booking.status === "active"
                ? "<span class='badge bg-success'>Active</span>"
                : "<span class='badge bg-secondary'>Inactive</span>";

            let actionBtn =
              booking.status === "active"
                ? `<button class='btn btn-warning btn-sm toggleStatusBtn' data-id='${bookings.id}' data-status='inactive'>Inactive</button>`
                : `<button class='btn btn-success btn-sm toggleStatusBtn' data-id='${bookings.id}' data-status='active'>Active</button>`;

            bookingTable.row
              .add([
                index++,
                bookings.booking_code,
                bookings.total_rooms,
                  bookings.total_guests,
                    
               

                actionBtn +
                  "<button class='btn btn-primary btn-sm viewBtn' data-id='" +
                  bookings.id +
                  "' data-bs-toggle='modal' data-bs-target='#viewDetailsModal'>View</button>" +
                  "<button class='btn btn-danger btn-sm deleteBtn' data-id='" +
                  bookings.id +
                  "'>Delete</button> " +
                  "<button class='btn btn-warning btn-sm editBtn' data-id='" +
                  bookings.id +
                  "'>Edit</button>",
              ])
              .draw(false);
          });
        } else {
          console.error("Invalid response format:", data);
        }
      },
      "json",
    );
  }
});

$("#bookingsTable").DataTable({
  responsive: true,

  dom:
    "<'row mb-3'<'col-sm-6 d-flex align-items-center'l><'col-sm-6 d-flex justify-content-end'f>>" +
    "tr" +
    "<'row mt-3'<'col-sm-5'i><'col-sm-7 d-flex justify-content-end'p>>",
});
