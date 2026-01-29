<?php

namespace App\Models\backend;

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
	public function getBooking()
	{

		$builder = $this->db->table('bookings');
		$builderQry = $builder->select('*')->where(array('status !=' => 'deleted'))->get();
		if ($builderQry->getNumRows() >= 1) {
			return $builderQry->getResultArray();
		}
	}
	    public function getBookingById($id)
{
    $builder = $this->db->table('bookings');
    return $builder->where('id', $id)->get()->getRowArray();
}

////////////////////////////////////////////////// Update
public function updateBooking($id, $data)
{
    $builder = $this->db->table('bookings');
    $builder->where('id', $id);
    return $builder->update($data);
}
public  function deleteBooking($id)
	{

		$deleteArr = array(
			'status' => 'deleted'

		);

		$where = "id=$id";
		$builder = $this->db->table('bookings');

		$builder->where($where);
		if ($builder->update($deleteArr)) {
			return true;
		} else {
			return false;
		}
	}
}