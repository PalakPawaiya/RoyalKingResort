<?php

namespace App\Controllers\frontend;

use App\Controllers\BaseController;
use App\Models\frontend\BookingModel;


class BookingController extends BaseController
{

 public function booking()
    {
        $this->bookings = new BookingModel;

       
        return view('frontend/pages/index');
    }

    public function saveBooking()
    {
        $this->bookings = new BookingModel;
         $this->data = [
            'booking_code'  => 'BK-' . rand(1000,9999),
            'check_in'      => $this->request->getPost('check_in'),
            'check_out'     => $this->request->getPost('check_out'),
            'total_rooms'   => $this->request->getPost('total_rooms'),
            'total_guests'  => $this->request->getPost('total_guests'),
            'total_amount'  => 5000,
            'booking_status'=> 'confirmed'
        ];

       
         $this->data['bookings'] = $this->bookings->saveBooking($this->data);

        return redirect()->back()->with('success','Booking successfully done!');
    }
    }
