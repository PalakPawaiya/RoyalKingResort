$(document).ready(function () {
  // Handle Send button click
  $("#sendBtn").on("click", function (e) {
    e.preventDefault(); // Stop default form submission

    // Get form values
    let booking_code = $("#name").val().trim();
    let check_in = $("#email").val().trim();
    let check_out = $("#phone").val().trim();
    let total_rooms = $("#bookdate").val().trim();
    let total_guests = $("#booktime").val();
   

    // Basic validation
    if (booking_code === "" || check_in === "" || check_out === "" || total_rooms === "" || total_guests === null) {
      alert("⚠️ Please fill all required fields!");
      return;
    }
    
    // Moment.js formatting
    let formattedDate = moment(bookdate).format('DD MMM, YYYY'); 

    // AJAX request to backend (update the URL according to your route)
    $.ajax({
      url: BASE_URL + "add-booking", // Example route
      type: "POST",
      data: {
        booking_code: booking_code,
        check_in: check_in,
        check_out: check_out,
           total_rooms: total_rooms, 
        total_guests: total_guests,
      
      },
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          alert("✅ Booking added successfully!");
          $("#contactForm")[0].reset(); // Reset form
         bootstrap.Offcanvas.getInstance(document.getElementById('bookingCanvas')).hide();
 // Close modal
        } else {
          alert("❌ Something went wrong!");
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error:", error);
        alert("⚠️ Server error. Check console for details.");
      }
    });
  });
});
$(document).ready(function(){
    // Aaj ka date
    let today = moment().format('YYYY-MM-DD');
    // Input me min attribute set karo
    $('#bookdate').attr('min', today);
});
const openBtn = document.getElementById("openBooking");
const closeBtn = document.getElementById("closeBooking");
const canvas = document.getElementById("bookingCanvas");
const overlay = document.getElementById("canvasOverlay");

openBtn.onclick = () => {
    canvas.classList.add("active");
    overlay.classList.add("active");
};

closeBtn.onclick = overlay.onclick = () => {
    canvas.classList.remove("active");
    overlay.classList.remove("active");
};