<?php

namespace App\Models\backend;

use CodeIgniter\Model;

class RoomModel extends Model
{


	public function __construct()
	{
		parent::__construct();
		$this->db = \Config\Database::connect();
	}

	/////////////////////////////////////// Save
	public  function saveRoom($save)
	{
		$builder = $this->db->table('rooms');
		if ($builder->insert($save)) {
			return True;
		} else {
			return False;
		}
	}
	public function getRoom()
	{

		$builder = $this->db->table('rooms');
		$builderQry = $builder->select('*')->where(array('status !=' => 'deleted'))->get();
		if ($builderQry->getNumRows() >= 1) {
			return $builderQry->getResultArray();
		}
	}
	    public function getRoomById($id)
{
    $builder = $this->db->table('rooms');
    return $builder->where('id', $id)->get()->getRowArray();
}

////////////////////////////////////////////////// Update
public function updateRoom($id, $data)
{
    $builder = $this->db->table('rooms');
    $builder->where('id', $id);
    return $builder->update($data);
}
public  function deleteRoom($id)
	{

		$deleteArr = array(
			'status' => 'deleted'

		);

		$where = "id=$id";
		$builder = $this->db->table('rooms');

		$builder->where($where);
		if ($builder->update($deleteArr)) {
			return true;
		} else {
			return false;
		}
	}
}