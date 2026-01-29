$(document).ready(function () {

  $.ajax({
    url: BASE_URL + "get-facility",
    type: "GET",
    dataType: "json",
    success: function (data) {

      let dropdown = $("#facility_id");
      dropdown.empty();
      dropdown.append('<option value="">Select Facility</option>');

      //  handle object response properly
      let facilities = Array.isArray(data) ? data : data.facilities;

      if (!Array.isArray(facilities)) {
        console.error("Invalid facility response:", data);
        return;
      }

      facilities.forEach(function (facility) {
        dropdown.append(
          `<option value="${facility.id}">${facility.name}</option>`
        );
      });
    },

    error: function (xhr, status, error) {
      console.error("Facility fetch error:", error);
    },
  });

});

$(document).ready(function () {
  ReloadFacilityFeatureTable();

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

  $("#facilityFeatureForm").validate({
    rules: {
  facility_id: {
    required: true,
  },
  feature_title: {
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
  facility_id: {
    required: "Please select facility",
  },
  feature_title: {
    required: "Please enter feature title",
    minlength: "Feature title must be at least 2 characters",
  },
},

    submitHandler: function () {
         console.log("Selected facility_id:", $("#facility_id").val());
      let formData = new FormData($("#facilityFeatureForm")[0]);

      $.ajax({
        url: BASE_URL + "add-facilityFeature",
        
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
          if (response.status === "success") {
            
          
            ReloadFacilityFeatureTable();
            
            var offcanvasEl = document.getElementById("addPropertiesOffcanvas");
            var offcanvasInstance =
              bootstrap.Offcanvas.getInstance(offcanvasEl);
            offcanvasInstance.hide();
            $("#facility_id").val("");
            $("#feature_title").val("");
            $("#description").val("");
            
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
      url: BASE_URL + "edit-facilityFeature/" + id,
      type: "GET",
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
              var data = response.user; 
          $("#editfacilityFeatureType").val(data.facilityFeatureType);
          $("#editTotalfacilityFeatures").val(data.totalfacilityFeatures);
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
                facilityFeatureType: $("#editfacilityFeatureType").val(),
                totalfacilityFeatures: $("#editTotalfacilityFeatures").val(),
                maxGuests: $("#editGuests").val(),
                basePrice: $("#editPrice").val(),
                description: $("#editDescription").val(),
              };

              $.post(
                BASE_URL + "update-facilityFeature/" + id,
                formData,
                function (res) {
                  if (res.status === "success") {
                    var offcanvasEl = document.getElementById(
                      "editPropertiesOffcanvas",
                    );
                    var offcanvasInstance =
                      bootstrap.Offcanvas.getInstance(offcanvasEl);
                    offcanvasInstance.hide();
                    ReloadFacilityFeatureTable();
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
          BASE_URL + "delete-facilityFeature/" + id,
          function (response) {
            if (response.status === "success") {
              facilityFeatureTable.row(row).remove().draw(false);
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
  var facilityFeatureTable;
  // reload function to  reloadTabledata
  function ReloadFacilityFeatureTable() {
    let index = 1;
    if ($.fn.DataTable.isDataTable("#facilityFeaturesTable")) {
      $("#facilityFeaturesTable").DataTable().clear().destroy(); // destroy old instance
    }
    facilityFeatureTable = $("#facilityFeaturesTable").DataTable({
      pageLength: 5,
      columnDefs: [
        { targets: 0, width: "40px" },
        { targets: "_all", width: "auto" },
      ],
    });

    $.get(
      BASE_URL + "get-facilityFeature",
      function (data) {
        let facilityFeature = Array.isArray(data) ? data : data.facility_features;

        if (Array.isArray(facilityFeature)) {
          facilityFeature.forEach(function (item) {
            let statusText =
              item.status === "active"
                ? "<span class='badge bg-success'>Active</span>"
                : "<span class='badge bg-secondary'>Inactive</span>";

            let actionBtn =
              item.status === "active"
                ? `<button class='btn btn-warning btn-sm toggleStatusBtn' data-id='${item.id}' data-status='inactive'>Inactive</button>`
                : `<button class='btn btn-success btn-sm toggleStatusBtn' data-id='${item.id}' data-status='active'>Active</button>`;

            facilityFeatureTable.row
              .add([
                index++,
                item.facility_name,
                item.feature_title,
                item.description,

                actionBtn +
                  "<button class='btn btn-primary btn-sm viewBtn' data-id='" +
                  item.id +
                  "' data-bs-toggle='modal' data-bs-target='#viewDetailsModal'>View</button>" +
                  "<button class='btn btn-danger btn-sm deleteBtn' data-id='" +
                  item.id +
                  "'>Delete</button> " +
                  "<button class='btn btn-warning btn-sm editBtn' data-id='" +
                  item.id +
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

$("#facilityFeaturesTable").DataTable({
  responsive: true,

  dom:
    "<'row mb-3'<'col-sm-6 d-flex align-items-center'l><'col-sm-6 d-flex justify-content-end'f>>" +
    "tr" +
    "<'row mt-3'<'col-sm-5'i><'col-sm-7 d-flex justify-content-end'p>>",
});
