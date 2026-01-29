<?= $this->extend('backend/layouts/defaultlayout') ?>


<?= $this->section('content') ?>


<br><br><br>




<button class="btn btn-warning" type="button" data-bs-toggle="offcanvas" data-bs-target="#addPropertiesOffcanvas">
    + Add Booking
</button>
<br><br><br>

<!-- Add Properties Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="addPropertiesOffcanvas" aria-labelledby="addPropertiesOffcanvasLabel" style="width: 900px;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="addPropertiesOffcanvasLabel">Add Properties</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <form id="bookingForm" enctype="multipart/form-data">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Check In</label>
                        <input type="date" name="check_in" id="check_in" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Check Out</label>
                        <input type="date" name="check_out" id="check_out" required>
                    </div>

                    <div class="booking-row">
                        <div class="form-group">
                            <label>Guests</label>
                            <select name="total_guests" id="total_guests" >
                                <option value="1">1 Adult</option>
                                <option value="2" selected>2 Adults</option>
                                <option value="3">3 Adults</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Rooms</label>
                            <select name="total_rooms" id="total_rooms" >
                                <option value="1" selected>1 Room</option>
                                <option value="2">2 Rooms</option>
                            </select>
                        </div>
                    </div>
                    

                    <div class="mt-3">
                        <button type="submit" id="sendBtn" class="btn btn-success w-100">Send</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

<!--------------------------- Edit off-canvas--------------------------------------->
<div class="offcanvas offcanvas-end" tabindex="-1" id="editPropertiesOffcanvas"
    aria-labelledby="editPropertiesOffcanvasLabel" style="width: 900px;">

    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="editPropertiesOffcanvasLabel">Edit Property</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body">
        <form id="editPropertyForm" enctype="multipart/form-data">
            <div class="container-fluid">
                <div class="row">


                    <div class="col-md-6 mb-3">
                        <label>Check In</label>
                        <input type="date" name="editcheck_in" id="check_in" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Check Out</label>
                        <input type="date" name="editcheck_out" id="check_out" required>
                    </div>

                    <div class="booking-row">
                        <div class="form-group">
                            <label>Guests</label>
                            <select name="edittotal_guests" id="total_guests" >
                                <option value="1">1 Adult</option>
                                <option value="2" selected>2 Adults</option>
                                <option value="3">3 Adults</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Rooms</label>
                            <select name="edittotal_rooms" id="total_rooms" >
                                <option value="1" selected>1 Room</option>
                                <option value="2">2 Rooms</option>
                            </select>
                        </div>
                    </div>
                    



                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3">
                Update Property
            </button>

        </form>
    </div>
</div>

<!-- ---------------------------------- table-------------------------------------- -->
<div class="container shadow-sm border-3  " style="background-color: white;">
    <div>
        <br>
        <table id="bookingsTable" class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-light">
                <tr>

                    <th>S.No</th>
                    <th> Booking Code</th>
                    <th>Total Rooms</th>
                    <th>Total Guests</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="facilityTableBody">
            </tbody>
        </table>
    </div>
</div>



<?php
if (isset($page_js_files) && is_array($page_js_files) && count($page_js_files) > 0) {
    foreach ($page_js_files as $key => $js_file) {
        echo "\n" . '<script src="' . base_url($js_file) . '"></script>' . "\n";
    }
}
?>

<script>
    const BASE_URL = "<?= base_url() ?>";
</script>

<?= $this->endSection() ?>