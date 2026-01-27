<?php

namespace App\Controllers\frontend;

use App\Controllers\BaseController;

class IndexController extends BaseController
{
    public function index(): string
    {
        return view('frontend/pages/index');
    }
      public function about(): string
    {
        return view('frontend/pages/about');
    }
      public function contact(): string
    {
        return view('frontend/pages/contact');
    }
      public function rooms(): string
    {
        return view('frontend/pages/rooms');
    }
     public function roomDetails(): string
    {
        return view('frontend/pages/room-details');
    }
     public function blog(): string
    {
        return view('frontend/pages/blog');
    }
     public function blogDetails(): string
    {
        return view('frontend/pages/blog-details');
    }
}
