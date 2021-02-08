<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
	protected $db, $user;

	public function __construct()
	{
		$this->db = \Config\Database::connect();
		$this->user = $this->db->table('users');
	}

	// func select all data or by id
	public function select_data($username = FALSE)
	{
		if ($username == FALSE) {
			return $this->user->get()->getResultObject();
		}
		return $this->user->getWhere(['username' => $username])->getRow();
	}

	// func insert data to db
	public function add_data($data)
	{
		$this->user->insert($data);
	}

	// func delete data from db
	public function delete_data($username)
	{
		$this->user->where('username', $username);
		$this->user->delete();
	}

	// func update data from db
	public function update_data($username, $data)
	{
		$this->user->where('username', $username);
		$this->user->update($data);
	}
}
