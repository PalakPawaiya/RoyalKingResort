<?php

namespace App\Controllers\backend;

use App\Controllers\BaseController;
use App\Models\backend\BookingModel;

class BookingController extends BaseController
{
    public function Booking()
    {
        $this->bookings = new BookingModel;

        $this->data['page_js_files'] = array(
            'booking' => 'public/backend1/js/pages/booking.js'
        );
        return view('backend/pages/booking', $this->data);
    }
    public function getBooking()
    {
        $this->bookings = new BookingModel;
        $this->data['bookings'] = $this->bookings->getBooking();
        return $this->response->setJSON($this->data);
    }


    public function addBooking()
    {
        $this->bookings = new BookingModel;
        $booking_code = 'BK-' . rand(1000, 9999);
        $check_in = $this->request->getPost('check_in');
        $check_out = $this->request->getPost('check_out');
        $total_rooms = $this->request->getPost('total_rooms');
        $total_guests = $this->request->getPost('total_guests');
        $total_amount = 5000;

        $save = [
            'booking_code'  =>$booking_code,
            'check_in'      => $check_in,
            'check_out'     => $check_out,
            'total_rooms'   => $total_rooms,
            'total_guests'  => $total_guests,
            'total_amount'  => $total_amount,
            'booking_status' => 'confirmed',
            'status' => 'active' // status default rakhna zaruri hai
        ];

        $this->data['bookings'] = $this->bookings->saveBooking($save);

        return $this->response->setJSON([
            'status' => 'success',
            'booking_code'  =>$booking_code,
            'check_in'      => $check_in,
            'check_out'     => $check_out,
            'total_rooms'   => $total_rooms,
            'total_guests'  => $total_guests,
            'total_amount'  => $total_amount,
            'booking_status' => 'confirmed',


        ]);
    }
    //////////////////////////////////////// Edit
    public function editBooking($id = null)
    {
        if (!$id) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'ID missing']);
        }

        $this->bookings = new BookingModel;
        $Booking = $this->bookings->getBookingById($id);

        if ($Booking) {
            return $this->response->setJSON(['status' => 'success', 'user' => $Booking]);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User not found']);
        }
    }

    ///////////////////////////////////////////// Update
    public function updateBooking($id = null)
    {
        if (!$id) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'ID missing'
            ]);
        }

        $this->bookings = new BookingModel;

        // Get existing category to preserve old image
        $Booking = $this->bookings->getBookingById($id);
        if (!$Booking) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'City not found'
            ]);
        }

        // Get posted data
       $booking_code = 'BK-' . rand(1000, 9999);
        $check_in = $this->request->getPost('check_in');
        $check_out = $this->request->getPost('check_out');
        $total_rooms = $this->request->getPost('total_rooms');
        $total_guests = $this->request->getPost('total_guests');
        $total_amount = 5000;




        // Prepare update data
        $updateData = [
           'booking_code'  =>$booking_code,
            'check_in'      => $check_in,
            'check_out'     => $check_out,
            'total_rooms'   => $total_rooms,
            'total_guests'  => $total_guests,
            'total_amount'  => $total_amount,
            'booking_status' => 'confirmed',

            'status' => 'active'
        ];

        // Update category
        $this->bookings->updateBooking($id, $updateData);

        return $this->response->setJSON([
            'status' => 'success',
            'booking_code'  =>$booking_code,
            'check_in'      => $check_in,
            'check_out'     => $check_out,
            'total_rooms'   => $total_rooms,
            'total_guests'  => $total_guests,
            'total_amount'  => $total_amount,
            'booking_status' => 'confirmed',
            'message' => 'Booking updated successfully'
        ]);
    }
    public function deleteBooking($id = null)
    {
        if ($id) {
            $this->bookings = new BookingModel;
            $this->bookings->deleteBooking($id);
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'ID missing']);
        }
    }
}
