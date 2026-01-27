<?php

namespace App\Models\frontend;

use CodeIgniter\Model;

class ContactModel extends Model
{


	public function __construct()
	{
		parent::__construct();
		$this->db = \Config\Database::connect();
	}

	/////////////////////////////////////// Save
	public  function saveContact($save)
	{
		$builder = $this->db->table('contact_messages');
		if ($builder->insert($save)) {
			return True;
		} else {
			return False;
		}
	}
}