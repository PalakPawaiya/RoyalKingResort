<?php

namespace App\Controllers\frontend;

use App\Controllers\BaseController;
use App\Models\frontend\ContactModel;

class ContactController extends BaseController
{

 public function contact()
    {
        $this->contact_messages = new ContactModel;

       
        return view('frontend/pages/contact');
    }

    public function saveContact()
    {
        $this->contact_messages = new ContactModel;
         $this->data = [
           
            'name'      => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
            'message'   => $this->request->getPost('message'),
            
        ];

       
         $this->data['contact_messages'] = $this->contact_messages->saveContact($this->data);

        return redirect()->back()->with('success','Booking successfully done!');
    }
    }
