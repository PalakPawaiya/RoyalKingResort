<?php

namespace App\Controllers\backend;

use App\Controllers\BaseController;
use App\Models\backend\RoomModel;

class RoomController extends BaseController
{
    public function room()
    {
         $this->rooms = new RoomModel;

        $this->data['page_js_files'] = array(
            'room' => 'public/backend1/js/pages/room.js'
        );
        return view('backend/pages/room', $this->data);
    }
    public function getRoom()
    {
         $this->rooms = new RoomModel;
        $this->data['rooms'] = $this->rooms->getRoom();
        return $this->response->setJSON($this->data);
    }

    
    public function addRoom()
    {
        $this->rooms = new RoomModel;
     $roomType = $this->request->getPost('roomType');

      $totalRooms = $this->request->getPost('totalRooms');

       $maxGuests = $this->request->getPost('maxGuests');
        $basePrice = $this->request->getPost('basePrice');

        $description = $this->request->getPost('description');


        $image = $this->request->getFile('image');
        $imageName = 'defaultimage.jpg';
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = time() . '_' . $image->getClientName();
            $image->move(ROOTPATH . 'public/backend/images/city', $imageName);
            $save['image'] = $imageName;
        }

        $save = [
            'roomType' => $roomType,
            'totalRooms' => $totalRooms,
            'maxGuests' => $maxGuests,
            'description' => $description,
            'basePrice' => $basePrice,
            'image' => $imageName,
            'status' => 'active' // status default rakhna zaruri hai
        ];

        $this->data['rooms'] = $this->rooms->saveRoom($save);

        return $this->response->setJSON([
            'status' => 'success',
            'roomType' => $roomType,
            'totalRooms' => $totalRooms,
            'maxGuests' => $maxGuests,
            'description' => $description,
             'basePrice' => $basePrice,
            'image' => $imageName,

        ]);
    }
        //////////////////////////////////////// Edit
    public function editRoom($id = null)
    {
        if (!$id) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'ID missing']);
        }

        $this->rooms = new RoomModel;
        $rooms = $this->rooms->getRoomById($id);

        if ($rooms) {
            return $this->response->setJSON(['status' => 'success', 'user' => $rooms]);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User not found']);
        }
    }

    ///////////////////////////////////////////// Update
    public function updateRoom($id = null)
    {
        if (!$id) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'ID missing'
            ]);
        }

        $this->rooms = new RoomModel;

        // Get existing category to preserve old image
        $rooms = $this->rooms->getRoomById($id);
        if (!$rooms) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'City not found'
            ]);
        }

        // Get posted data
       $roomType = $this->request->getPost('roomType');

      $totalRooms = $this->request->getPost('totalRooms');

       $maxGuests = $this->request->getPost('maxGuests');
        $basePrice = $this->request->getPost('basePrice');

        $description = $this->request->getPost('description');


        // Handle image upload
        $image = $this->request->getFile('image');
        $imageName = $rooms['image']; // default: keep old image

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = time() . '_' . $image->getClientName();
            $image->move(ROOTPATH . 'public/backend/images/city', $imageName);

            // Optional: delete old image from server if not default
            if ($rooms['image'] && $rooms['image'] != 'defaultimage.jpg' && file_exists(ROOTPATH . 'public/be/images/' . $rooms['image'])) {
                unlink(ROOTPATH . 'public/be/images/' . $rooms['image']);
            }
        }

        // Prepare update data
        $updateData = [
            'roomType' => $roomType,
            'totalRooms' => $totalRooms,
            'maxGuests' => $maxGuests,
            'description' => $description,
             'basePrice' => $basePrice,
            'image' => $imageName,
            'status' => 'active'
        ];

        // Update category
        $this->rooms->updateRoom($id, $updateData);

        return $this->response->setJSON([
            'status' => 'success',
           'roomType' => $roomType,
            'totalRooms' => $totalRooms,
            'maxGuests' => $maxGuests,
            'description' => $description,
             'basePrice' => $basePrice,
            'image' => $updateData['image'],
            'message' => 'Room updated successfully'
        ]);
    }
     public function deleteRoom($id = null)
    {
        if ($id) {
            $this->rooms = new RoomModel;
            $this->rooms->deleteRoom($id);
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'ID missing']);
        }
    }

}