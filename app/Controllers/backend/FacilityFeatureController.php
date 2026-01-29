<?php

namespace App\Controllers\backend;

use App\Controllers\BaseController;
use App\Models\backend\FacilityModel;
use App\Models\backend\FacilityFeatureModel;

class FacilityFeatureController extends BaseController
{
    public function facilityFeature()
    {
        $this->facility_features = new FacilityFeatureModel;

        $this->data['page_js_files'] = array(
            'facilityfeature' => 'public/backend1/js/pages/facilityfeature.js'
        );
        return view('backend/pages/facilityfeatures', $this->data);
    }
    public function getFacilityFeature()
    {
        $this->facility_features = new FacilityFeatureModel;
        $this->data['facility_features'] = $this->facility_features->getfacilityFeature();
        return $this->response->setJSON($this->data);
    }


    public function addFacilityFeature()
    {
        $this->facilities = new FacilityModel;
        $this->data['facilities'] = $this->facilities->getFacility();
        $this->facility_features = new FacilityFeatureModel;

        $facility_id = $this->request->getPost('facility_id');
        $feature_title = $this->request->getPost('feature_title');
        $description = $this->request->getPost('description');

        $save = [
            'facility_id' => $facility_id,
            'feature_title' => $feature_title,
            'description' => $description,

            'status' => 'active' // status default rakhna zaruri hai
        ];

        $this->data['facility_features'] = $this->facility_features->savefacilityFeature($save);

        return $this->response->setJSON([
            'status' => 'success',
            'facility_id' => $facility_id,
            'feature_title' => $feature_title,
            'description' => $description,



        ]);
    }
    //////////////////////////////////////// Edit
    public function editFacilityFeature($id = null)
    {
        if (!$id) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'ID missing']);
        }

        $this->facility_features = new FacilityFeatureModel;
        $facilityFeature = $this->facility_features->getFacilityFeatureById($id);

        if ($facilityFeature) {
            return $this->response->setJSON(['status' => 'success', 'user' => $facilityFeature]);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User not found']);
        }
    }

    ///////////////////////////////////////////// Update
    public function updateFacilityFeature($id = null)
    {
        if (!$id) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'ID missing'
            ]);
        }

        $this->facility_features = new FacilityFeatureModel;

        // Get existing category to preserve old image
        $facilityFeature = $this->facility_features->getFacilityFeatureById($id);
        if (!$facilityFeature) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'City not found'
            ]);
        }

        // Get posted data
        $facility_id = $this->request->getPost('facility_id');
        $feature_title = $this->request->getPost('feature_title');
        $description = $this->request->getPost('description');



        // Prepare update data
        $updateData = [
            'facility_id' => $facility_id,
            'feature_title' => $feature_title,
            'description' => $description,


            'status' => 'active'
        ];

        // Update category
        $this->facility_features->updatefacilityFeature($id, $updateData);

        return $this->response->setJSON([
            'status' => 'success',
            'facility_id' => $facility_id,
            'feature_title' => $feature_title,
            'description' => $description,

            'message' => 'Facility updated successfully'
        ]);
    }
    public function deleteFacilityFeature($id = null)
    {
        if ($id) {
            $this->facility_features = new FacilityFeatureModel;
            $this->facility_features->deletefacilityFeature($id);
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'ID missing']);
        }
    }
}
