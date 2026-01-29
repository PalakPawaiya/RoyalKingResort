<?php

namespace App\Models\backend;

use CodeIgniter\Model;

class FacilityFeatureModel extends Model
{


	public function __construct()
	{
		parent::__construct();
		$this->db = \Config\Database::connect();
	}

	/////////////////////////////////////// Save
	public  function savefacilityFeature($save)
	{
		$builder = $this->db->table('facility_features');
		if ($builder->insert($save)) {
			return True;
		} else {
			return False;
		}
	}
	public function getfacilityFeature()
	{
$builder = $this->db->table('facility_features ff');

    $builder->select('
        ff.*,
        f.name AS facility_name
    ');

    $builder->join('facilities f', 'f.id = ff.facility_id', 'left');
    $builder->where('ff.status !=', 'deleted');
    $builderQry = $builder->get();
	if ($builderQry->getNumRows() >= 1) {
			return $builderQry->getResultArray();
		}
	}
	    public function getfacilityFeatureById($id)
{
    $builder = $this->db->table('facilities');
    return $builder->where('id', $id)->get()->getRowArray();
}

////////////////////////////////////////////////// Update
public function updatefacilityFeature($id, $data)
{
    $builder = $this->db->table('facility_features');
    $builder->where('id', $id);
    return $builder->update($data);
}
public  function deletefacilityFeature($id)
	{

		$deleteArr = array(
			'status' => 'deleted'

		);

		$where = "id=$id";
		$builder = $this->db->table('facility_features');

		$builder->where($where);
		if ($builder->update($deleteArr)) {
			return true;
		} else {
			return false;
		}
	}
}