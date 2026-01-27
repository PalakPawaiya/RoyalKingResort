<?php

namespace App\Models\frontend;

use CodeIgniter\Model;

class BookingModel extends Model
{


	public function __construct()
	{
		parent::__construct();
		$this->db = \Config\Database::connect();
	}

	/////////////////////////////////////// Save
	public  function saveBooking($save)
	{
		$builder = $this->db->table('bookings');
		if ($builder->insert($save)) {
			return True;
		} else {
			return False;
		}
	}
}