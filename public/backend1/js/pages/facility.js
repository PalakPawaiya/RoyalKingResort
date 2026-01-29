$(document).ready(function () {
  ReloadFacilityTable();

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

  $("#facilityForm").validate({
    rules: {
      name: {
        required: true,
        minlength: 2,
      },
     
    },

    messages: {
      name: {
        required: "Please enter city name",
        minlength: "City name must be at least 2 characters",
      },
    
    },

    highlight: function (element) {
      $(element).addClass("is-invalid");
    },

    unhighlight: function (element) {
      $(element).removeClass("is-invalid");
    },

    submitHandler: function () {
      let formData = new FormData($("#facilityForm")[0]);

      $.ajax({
        url: BASE_URL + "add-facility",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
          if (response.status === "success") {
            ReloadFacilityTable();

            var offcanvasEl = document.getElementById("addPropertiesOffcanvas");
            var offcanvasInstance =
              bootstrap.Offcanvas.getInstance(offcanvasEl);
            offcanvasInstance.hide();
            $("#name").val("");
            $("#slug").val("");
           
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
      url: BASE_URL + "edit-facility/" + id,
      type: "GET",
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
              var data = response.user; 
          $("#editName").val(data.name);
          $("#editSlug").val(data.slug);
         

         

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
                name: $("#editName").val(),
                slug: $("#editSlug").val(),
               
              };

              $.post(
                BASE_URL + "update-facility/" + id,
                formData,
                function (res) {
                  if (res.status === "success") {
                    var offcanvasEl = document.getElementById(
                      "editPropertiesOffcanvas",
                    );
                    var offcanvasInstance =
                      bootstrap.Offcanvas.getInstance(offcanvasEl);
                    offcanvasInstance.hide();
                    ReloadFacilityTable();
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
          BASE_URL + "delete-facility/" + id,
          function (response) {
            if (response.status === "success") {
              facilityTable.row(row).remove().draw(false);
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
  var facilityTable;
  // reload function to  reloadTabledata
  function ReloadFacilityTable() {
    let index = 1;
    if ($.fn.DataTable.isDataTable("#facilitiesTable")) {
      $("#facilitiesTable").DataTable().clear().destroy(); // destroy old instance
    }
    facilityTable = $("#facilitiesTable").DataTable({
      pageLength: 5,
      columnDefs: [
        { targets: 0, width: "40px" },
        { targets: "_all", width: "auto" },
      ],
    });

    $.get(
      BASE_URL + "get-facility",
      function (data) {
        let facility = Array.isArray(data) ? data : data.facilities;

        if (Array.isArray(facility)) {
          facility.forEach(function (facilities) {
            let statusText =
              facility.status === "active"
                ? "<span class='badge bg-success'>Active</span>"
                : "<span class='badge bg-secondary'>Inactive</span>";

            let actionBtn =
              facility.status === "active"
                ? `<button class='btn btn-warning btn-sm toggleStatusBtn' data-id='${facilities.id}' data-status='inactive'>Inactive</button>`
                : `<button class='btn btn-success btn-sm toggleStatusBtn' data-id='${facilities.id}' data-status='active'>Active</button>`;

            facilityTable.row
              .add([
                index++,
                facilities.name,
                facilities.slug,
               

                actionBtn +
                  "<button class='btn btn-primary btn-sm viewBtn' data-id='" +
                  facilities.id +
                  "' data-bs-toggle='modal' data-bs-target='#viewDetailsModal'>View</button>" +
                  "<button class='btn btn-danger btn-sm deleteBtn' data-id='" +
                  facilities.id +
                  "'>Delete</button> " +
                  "<button class='btn btn-warning btn-sm editBtn' data-id='" +
                  facilities.id +
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

$("#facilitiesTable").DataTable({
  responsive: true,

  dom:
    "<'row mb-3'<'col-sm-6 d-flex align-items-center'l><'col-sm-6 d-flex justify-content-end'f>>" +
    "tr" +
    "<'row mt-3'<'col-sm-5'i><'col-sm-7 d-flex justify-content-end'p>>",
});
