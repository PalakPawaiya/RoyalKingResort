<?php

namespace App\Controllers\backend;

use App\Controllers\BaseController;
use App\Models\backend\FacilityModel;

class FacilityController extends BaseController
{
    public function facility()
    {
        $this->facilities = new FacilityModel;

        $this->data['page_js_files'] = array(
            'facility' => 'public/backend1/js/pages/facility.js'
        );
        return view('backend/pages/facility', $this->data);
    }
    public function getFacility()
    {
        $this->facilities = new FacilityModel;
        $this->data['facilities'] = $this->facilities->getFacility();
        return $this->response->setJSON($this->data);
    }


    public function addFacility()
    {
        $this->facilities = new FacilityModel;
        $name = $this->request->getPost('name');
        $slug = $this->request->getPost('slug');

        $save = [
            'name' => $name,
            'slug' => $slug,

            'status' => 'active' // status default rakhna zaruri hai
        ];

        $this->data['facilities'] = $this->facilities->saveFacility($save);

        return $this->response->setJSON([
            'status' => 'success',
            'name' => $name,
            'slug' => $slug,


        ]);
    }
    //////////////////////////////////////// Edit
    public function editFacility($id = null)
    {
        if (!$id) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'ID missing']);
        }

        $this->facilities = new FacilityModel;
        $facility = $this->facilities->getFacilityById($id);

        if ($facility) {
            return $this->response->setJSON(['status' => 'success', 'user' => $facility]);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User not found']);
        }
    }

    ///////////////////////////////////////////// Update
    public function updateFacility($id = null)
    {
        if (!$id) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'ID missing'
            ]);
        }

        $this->Facilities = new FacilityModel;

        // Get existing category to preserve old image
        $facility = $this->facilities->getFacilityById($id);
        if (!$facility) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'City not found'
            ]);
        }

        // Get posted data
        $name = $this->request->getPost('name');

        $slug = $this->request->getPost('slug');




        // Prepare update data
        $updateData = [
            'name' => $name,
            'slug' => $slug,

            'status' => 'active'
        ];

        // Update category
        $this->facilities->updateFacility($id, $updateData);

        return $this->response->setJSON([
            'status' => 'success',
            'name' => $name,
            'slug' => $slug,
            'message' => 'Facility updated successfully'
        ]);
    }
    public function deleteFacility($id = null)
    {
        if ($id) {
            $this->facilities = new FacilityModel;
            $this->facilities->deleteFacility($id);
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'ID missing']);
        }
    }
}
