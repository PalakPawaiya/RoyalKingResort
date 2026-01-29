<?= $this->extend('backend/layouts/defaultlayout') ?>
<?= $this->section('content') ?>
<br><br><br>

<button class="btn btn-warning" type="button" data-bs-toggle="offcanvas" data-bs-target="#addPropertiesOffcanvas">
    + Add Room
</button>
<br><br><br>

<!-- Add Properties Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="addPropertiesOffcanvas" aria-labelledby="addPropertiesOffcanvasLabel" style="width: 900px;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="addPropertiesOffcanvasLabel">Add Properties</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <form id="roomForm" enctype="multipart/form-data">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Room Types</label>
                        <input type="text" name="roomType" id="roomType" class="form-control" placeholder="Enter bathrooms">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Total Rooms</label>
                        <input type="text" name="totalRooms" id="totalRooms" class="form-control" placeholder="Enter build year">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Maximum Guests</label>
                        <input type="text" name="maxGuests" id="maxGuests" class="form-control" placeholder="Enter Property Description">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Base Price</label>
                        <input type="text" name="basePrice" id="basePrice" class="form-control" placeholder="Enter property price">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Description</label>
                        <textarea type="text" name="description" id="description" class="form-control" placeholder="Enter garages"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label"> Image</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*"><br>
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
                        <label class="form-label">Room Type</label>
                        <input type="text" id="editroomType" name="roomType" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Total Rooms</label>
                        <input type="text" id="editTotalRooms" name="totalRooms" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Maximum Guests</label>
                        <input type="text" id="editGuests" name="maxGuests" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Base Price</label>
                        <input type="text" id="editPrice" name="basePrice" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Description</label>
                        <input type="text" id="editDescription" name="description" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Current Image</label><br>
                        <!--Preview Image -->
                        <img id="editPreviewImage"
                            src="<?= base_url('public/backend/images/city'); ?>"
                            alt="City Image"
                            style="width:120px; height:120px; border-radius:10px; object-fit:cover; border:1px solid #ddd;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"> Image</label>
                        <input type="file" id="editImage" class="form-control" accept="image/*">
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
        <table id="roomsTable" class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>S.No</th>
                    <th>Room Type</th>
                    <th>Total Rooms</th>
                    <th>Total Guests</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="roomTableBody">
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