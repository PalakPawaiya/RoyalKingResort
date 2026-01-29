<?php

namespace App\Models\backend;

use CodeIgniter\Model;

class FacilityModel extends Model
{


	public function __construct()
	{
		parent::__construct();
		$this->db = \Config\Database::connect();
	}

	/////////////////////////////////////// Save
	public  function saveFacility($save)
	{
		$builder = $this->db->table('facilities');
		if ($builder->insert($save)) {
			return True;
		} else {
			return False;
		}
	}
	public function getFacility()
	{

		$builder = $this->db->table('facilities');
		$builderQry = $builder->select('*')->where(array('status !=' => 'deleted'))->get();
		if ($builderQry->getNumRows() >= 1) {
			return $builderQry->getResultArray();
		}
	}
	    public function getFacilityById($id)
{
    $builder = $this->db->table('facilities');
    return $builder->where('id', $id)->get()->getRowArray();
}

////////////////////////////////////////////////// Update
public function updateFacility($id, $data)
{
    $builder = $this->db->table('facilities');
    $builder->where('id', $id);
    return $builder->update($data);
}
public  function deleteFacility($id)
	{

		$deleteArr = array(
			'status' => 'deleted'

		);

		$where = "id=$id";
		$builder = $this->db->table('facilities');

		$builder->where($where);
		if ($builder->update($deleteArr)) {
			return true;
		} else {
			return false;
		}
	}
}