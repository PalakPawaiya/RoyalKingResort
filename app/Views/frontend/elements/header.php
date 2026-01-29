   <!-- Page Preloder -->
   <div id="preloder">
       <div class="loader"></div>
   </div>
   <!-- Offcanvas Menu Section Begin -->
   <div class="offcanvas-menu-overlay"></div>
   <div class="canvas-open">
       <i class="icon_menu"></i>
   </div>
   <div class="offcanvas-menu-wrapper">
       <div class="canvas-close">
           <i class="icon_close"></i>
       </div>
       <div class="search-icon  search-switch">
           <i class="icon_search"></i>
       </div>
       <div class="header-configure-area">
           <div class="language-option">
               <img src="img/flag.jpg" alt="">
               <span>EN <i class="fa fa-angle-down"></i></span>
               <div class="flag-dropdown">
                   <ul>
                       <li><a href="#">Zi</a></li>
                       <li><a href="#">Fr</a></li>
                   </ul>
               </div>
           </div>
           <a href="#" class="bk-btn">Booking Now</a>
       </div>
       <nav class="mainmenu mobile-menu">
           <ul>
               <li class="active"><a href="<?php echo base_url('/index') ?>">Home</a></li>
               <li><a href="<?php echo base_url('/index') ?>">Rooms</a></li>
               <li><a href="<?php echo base_url('/index') ?>">About Us</a></li>
               <li><a href="<?php echo base_url('/index') ?>">Pages</a>
                   <ul class="dropdown">
                       <li><a href="<?php echo base_url('/index') ?>">Room Details</a></li>
                       <li><a href="#">Deluxe Room</a></li>
                       <li><a href="#">Family Room</a></li>
                       <li><a href="#">Premium Room</a></li>
                   </ul>
               </li>
               <li><a href="./blog.html">News</a></li>
               <li><a href="./contact.html">Contact</a></li>
           </ul>
       </nav>
       <div id="mobile-menu-wrap"></div>
       <div class="top-social">
           <a href="#"><i class="fa fa-facebook"></i></a>
           <a href="#"><i class="fa fa-twitter"></i></a>
           <a href="#"><i class="fa fa-tripadvisor"></i></a>
           <a href="#"><i class="fa fa-instagram"></i></a>
       </div>
       <ul class="top-widget">
           <li><i class="fa fa-phone"></i> (12) 345 67890</li>
           <li><i class="fa fa-envelope"></i> info.colorlib@gmail.com</li>
       </ul>
   </div>
   <!-- Offcanvas Menu Section End -->

   <!-- Header Section Begin -->
   <header class="header-section">
       <div class="top-nav">
           <div class="container">
               <div class="row">
                   <div class="col-lg-6">
                       <ul class="tn-left">
                           <li><i class="fa fa-phone"></i> (12) 345 67890</li>
                           <li><i class="fa fa-envelope"></i> info.colorlib@gmail.com</li>
                       </ul>
                   </div>
                   <div class="col-lg-6">
                       <div class="tn-right">
                           <div class="top-social">
                               <a href="#"><i class="fa fa-facebook"></i></a>
                               <a href="#"><i class="fa fa-twitter"></i></a>
                               <a href="#"><i class="fa fa-tripadvisor"></i></a>
                               <a href="#"><i class="fa fa-instagram"></i></a>
                           </div>
                           <a href="javascript:void(0)" class="bk-btn bookingBtn">Booking Now</a>
                           <div class="language-option">
                               <img src="img/flag.jpg" alt="">
                               <span>EN <i class="fa fa-angle-down"></i></span>
                               <div class="flag-dropdown">
                                   <ul>
                                       <li><a href="#">Zi</a></li>
                                       <li><a href="#">Fr</a></li>
                                   </ul>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <div class="menu-item">
           <div class="container">
               <div class="row">
                   <div class="col-lg-2">
                       <div class="logo">
                           <a href="./index.html">
                               <img src="<?= base_url('public/fe/img/royalking.png') ?>" alt="">
                           </a>
                       </div>
                   </div>
                   <div class="col-lg-10">
                       <div class="nav-menu">
                           <nav class="mainmenu">
                               <ul>
                                   <li class="active"><a href="<?php echo base_url('/index') ?>">Home</a></li>
                                   <li><a href="<?php echo base_url('/rooms') ?>">Rooms</a></li>
                                   <li><a href="<?php echo base_url('/about') ?>">About Us</a></li>
                                   <li><a href="./pages.html">Pages</a>
                                       <ul class="dropdown">
                                           <li><a href="<?php echo base_url('/room-details') ?>">Room Details</a></li>
                                           <li><a href="<?php echo base_url('/blog-details') ?>">Blog Details</a></li>
                                           <li><a href="#">Family Room</a></li>
                                           <li><a href="#">Premium Room</a></li>
                                       </ul>
                                   </li>
                                   <li><a href="<?php echo base_url('/blog') ?>">News</a></li>
                                   <li><a href="<?php echo base_url('/contact') ?>">Contact</a></li>
                               </ul>
                           </nav>
                           <div class="nav-right search-switch">
                               <i class="icon_search"></i>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </header>
   <!-- Header End -->
   <!-- Booking Offcanvas -->
   <div id="bookingCanvas" class="booking-canvas">
       <div class="booking-header">
           <h3>Booking Your Hotel</h3>
           <span id="closeBooking">&times;</span>
       </div>

       <form method="post" action="<?= base_url('booking/save') ?>" class="booking-form">

           <label>Check In</label>
           <input type="date" name="check_in" required>

           <label>Check Out</label>
           <input type="date" name="check_out" required>

           <div class="booking-row">
               <div class="form-group">
                   <label>Guests</label>
                   <select name="total_guests">
                       <option value="1">1 Adult</option>
                       <option value="2" selected>2 Adults</option>
                       <option value="3">3 Adults</option>
                   </select>
               </div>
               <div class="form-group">
                   <label>Rooms</label>
                   <select name="total_rooms">
                       <option value="1" selected>1 Room</option>
                       <option value="2">2 Rooms</option>
                   </select>
               </div>
           </div>

           <button type="submit" class="primary-btn">Book Now</button>
       </form>
   </div>

   <div id="canvasOverlay"></div>