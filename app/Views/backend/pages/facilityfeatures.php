<?= $this->extend('backend/layouts/defaultlayout') ?>


<?= $this->section('content') ?>


<br><br><br>




<button class="btn btn-warning" type="button" data-bs-toggle="offcanvas" data-bs-target="#addPropertiesOffcanvas">
    + Add Faciltiy Features
</button>
<br><br><br>

<!-- Add Properties Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="addPropertiesOffcanvas" aria-labelledby="addPropertiesOffcanvasLabel" style="width: 900px;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="addPropertiesOffcanvasLabel">Add Properties</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <form id="facilityFeatureForm" enctype="multipart/form-data">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Facility Type </label>
                        <select id="facility_id" name="facility_id" class="form-control">
                            <option value="">Select Facility Type</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Feature Title</label>
                        <input type="text" name="feature_title" id="feature_title" class="form-control" placeholder="Enter build year">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Description</label>
                        <input type="text" name="description" id="description" class="form-control" placeholder="Enter Property Description">
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
        <form id="editFacilityFeatureForm" enctype="multipart/form-data">
            <div class="container-fluid">
                <div class="row">


                     <div class="col-md-6 mb-3">
                        <label class="form-label">Facility Type </label>
                        <select id="editFacilityTypeDropdown" name="facility_id" class="form-control">
                            <option value="">Select Facility Type</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Feature Title</label>
                        <input type="text" name="editfeature_title" id="feature_title" class="form-control" placeholder="Enter build year">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Description</label>
                        <input type="text" name="editdescription" id="description" class="form-control" placeholder="Enter Property Description">
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
        <table id="facilityFeaturesTable" class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-light">
                <tr>

                    <th>S.No</th>
                    <th> Facility Type Id</th>


                    <th> Facility Title</th>



                    <th>Description</th>
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