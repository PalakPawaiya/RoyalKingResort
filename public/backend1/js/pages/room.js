$(document).ready(function () {
  reloadRoomTable();

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

  $("#roomForm").validate({
    rules: {
      roomType: {
        required: true,
        minlength: 2,
      },
      image: {
        required: true,
        extension: "jpg|jpeg|png",
        filesize: 2,
      },
    },

    messages: {
      roomType: {
        required: "Please enter city name",
        minlength: "City name must be at least 2 characters",
      },
      image: {
        required: "Please select an image",
        extension: "Only JPG, JPEG & PNG allowed",
      },
    },

    highlight: function (element) {
      $(element).addClass("is-invalid");
    },

    unhighlight: function (element) {
      $(element).removeClass("is-invalid");
    },

    submitHandler: function () {
      let formData = new FormData($("#roomForm")[0]);

      $.ajax({
        url: BASE_URL + "add-room",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
          if (response.status === "success") {
            reloadRoomTable();
            
            var offcanvasEl = document.getElementById("addPropertiesOffcanvas");
            var offcanvasInstance =
              bootstrap.Offcanvas.getInstance(offcanvasEl);
            offcanvasInstance.hide();
            $("#roomType").val("");
            $("#totalRooms").val("");
            $("#maxGuests").val("");
            $("#basePrice").val("");
            $("#description").val("");
            $("#image").val("");
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
      url: BASE_URL + "edit-room/" + id,
      type: "GET",
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          var data = response.user;
          $("#editroomType").val(data.roomType);
          $("#editTotalRooms").val(data.totalRooms);
          $("#editGuests").val(data.maxGuests);
          $("#editPrice").val(data.basePrice);
          $("#editDescription").val(data.description);

          //  Get current image from table (assuming image <img> tag is in td:eq(1))
          var currentImgSrc = row.find("td:eq(1) img").attr("src");

          //  Set preview image
          if (currentImgSrc && currentImgSrc !== "") {
            $("#editPreviewImage").attr("src", currentImgSrc);
          } else {
            $("#editPreviewImage").attr(
              "src",
              BASE_URL + "public/backend/images/city/defaultimage.jpg",
            );
          }

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
                roomType: $("#editroomType").val(),
                totalRooms: $("#editTotalRooms").val(),
                maxGuests: $("#editGuests").val(),
                basePrice: $("#editPrice").val(),
                description: $("#editDescription").val(),
              };

              $.post(
                BASE_URL + "update-room/" + id,
                formData,
                function (res) {
                  if (res.status === "success") {
                    var offcanvasEl = document.getElementById(
                      "editPropertiesOffcanvas",
                    );
                    var offcanvasInstance =
                      bootstrap.Offcanvas.getInstance(offcanvasEl);
                    offcanvasInstance.hide();
                    reloadRoomTable();
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

  //  Live preview for new selected image (place this outside the click handler)
  $(document).on("change", "#editImage", function (event) {
    const file = event.target.files[0];
    console.log(" Change event triggered!");
    console.log("File selected:", file);

    const preview = document.getElementById("editPreviewImage");
    preview.src = URL.createObjectURL(file);
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
          BASE_URL + "delete-room/" + id,
          function (response) {
            if (response.status === "success") {
              roomTable.row(row).remove().draw(false);
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
          reloadCityTable(); // Refresh the table
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
  var roomTable;
  // reload function to  reloadTabledata
  function reloadRoomTable() {
    let index = 1;
    if ($.fn.DataTable.isDataTable("#roomsTable")) {
      $("#roomsTable").DataTable().clear().destroy(); // destroy old instance
    }
    roomTable = $("#roomsTable").DataTable({
      pageLength: 5,
      columnDefs: [
        { targets: 0, width: "40px" },
        { targets: "_all", width: "auto" },
      ],
    });

    $.get(
      BASE_URL + "get-room",
      function (data) {
        let room = Array.isArray(data) ? data : data.rooms;

        if (Array.isArray(room)) {
          room.forEach(function (rooms) {
            let statusText =
              room.status === "active"
                ? "<span class='badge bg-success'>Active</span>"
                : "<span class='badge bg-secondary'>Inactive</span>";

            let actionBtn =
              room.status === "active"
                ? `<button class='btn btn-warning btn-sm toggleStatusBtn' data-id='${rooms.id}' data-status='inactive'>Inactive</button>`
                : `<button class='btn btn-success btn-sm toggleStatusBtn' data-id='${rooms.id}' data-status='active'>Active</button>`;

            roomTable.row
              .add([
                index++,
                rooms.roomType,
                rooms.totalRooms,
                rooms.maxGuests,

                actionBtn +
                  "<button class='btn btn-primary btn-sm viewBtn' data-id='" +
                  rooms.id +
                  "' data-bs-toggle='modal' data-bs-target='#viewDetailsModal'>View</button>" +
                  "<button class='btn btn-danger btn-sm deleteBtn' data-id='" +
                  rooms.id +
                  "'>Delete</button> " +
                  "<button class='btn btn-warning btn-sm editBtn' data-id='" +
                  rooms.id +
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

$("#roomsTable").DataTable({
  responsive: true,

  dom:
    "<'row mb-3'<'col-sm-6 d-flex align-items-center'l><'col-sm-6 d-flex justify-content-end'f>>" +
    "tr" +
    "<'row mt-3'<'col-sm-5'i><'col-sm-7 d-flex justify-content-end'p>>",
});
