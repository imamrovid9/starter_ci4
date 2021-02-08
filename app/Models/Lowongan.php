<?php

namespace App\Models;

use CodeIgniter\Model;

class Lowongan extends Model
{
	protected $db, $lowongan;

	public function __construct()
	{
		$this->db = \Config\Database::connect();
		$this->lowongan = $this->db->table('lowongan');
		$this->data_lowongan = $this->db->table('data_lowongan');
		// $this->gabung = $this->lowongan->join('users', 'users.id = lowongan.perusahaan_id');
	}

	// func select all data or by perusahan_id
	public function select_data($perusahan_id = FALSE)
	{
		if ($perusahan_id == FALSE) {
			return $this->lowongan->get()->getResultObject();
		}
		return $this->lowongan->getWhere(['perusahan_id' => $perusahan_id])->getRow();
	}

	// func insert data to db
	public function add_data($data)
	{
		$this->lowongan->insert($data);
	}

	// func delete data from db
	public function delete_data($lowongan_id)
	{
		$this->lowongan->where('lowongan_id', $lowongan_id);
		$this->lowongan->delete();
	}

	// func update data from db
	public function update_data($lowongan_id, $data)
	{
		$this->lowongan->where('lowongan_id', $lowongan_id);
		$this->lowongan->update($data);
	}


	//get lowongan berdasarkan bulan
	public function bulan($bulan = FALSE)
	{
		if ($bulan == FALSE) {
			return $this->gabung->get()->getResultObject();
		} elseif ($bulan == "januari") {
			$bulan = 1;
			return $this->db->query("SELECT users.username, lowongan.*  FROM lowongan JOIN users ON users.id=lowongan.perusahaan_id WHERE MONTH(tanggal) = $bulan ;")->getResult();
		} elseif ($bulan == "februari") {
			$bulan = 2;
			return $this->db->query("SELECT users.username, lowongan.*  FROM lowongan JOIN users ON users.id=lowongan.perusahaan_id WHERE MONTH(tanggal) = $bulan ;")->getResult();
		} elseif ($bulan == "maret") {
			$bulan = 3;
			return $this->db->query("SELECT users.username, lowongan.*  FROM lowongan JOIN users ON users.id=lowongan.perusahaan_id WHERE MONTH(tanggal) = $bulan ;")->getResult();
		} elseif ($bulan == "april") {
			$bulan = 4;
			return $this->db->query("SELECT users.username, lowongan.*  FROM lowongan JOIN users ON users.id=lowongan.perusahaan_id WHERE MONTH(tanggal) = $bulan ;")->getResult();
		} elseif ($bulan == "mei") {
			$bulan = 5;
			return $this->db->query("SELECT users.username, lowongan.*  FROM lowongan JOIN users ON users.id=lowongan.perusahaan_id WHERE MONTH(tanggal) = $bulan ;")->getResult();
		} elseif ($bulan == "juni") {
			$bulan = 6;
			return $this->db->query("SELECT users.username, lowongan.*  FROM lowongan JOIN users ON users.id=lowongan.perusahaan_id WHERE MONTH(tanggal) = $bulan ;")->getResult();
		} elseif ($bulan == "juli") {
			$bulan = 7;
			return $this->db->query("SELECT users.username, lowongan.*  FROM lowongan JOIN users ON users.id=lowongan.perusahaan_id WHERE MONTH(tanggal) = $bulan ;")->getResult();
		} elseif ($bulan == "agustus") {
			$bulan = 8;
			return $this->db->query("SELECT users.username, lowongan.*  FROM lowongan JOIN users ON users.id=lowongan.perusahaan_id WHERE MONTH(tanggal) = $bulan ;")->getResult();
		} elseif ($bulan == "september") {
			$bulan = 9;
			return $this->db->query("SELECT users.username, lowongan.*  FROM lowongan JOIN users ON users.id=lowongan.perusahaan_id WHERE MONTH(tanggal) = $bulan ;")->getResult();
		} elseif ($bulan == "oktober") {
			$bulan = 10;
			return $this->db->query("SELECT users.username, lowongan.*  FROM lowongan JOIN users ON users.id=lowongan.perusahaan_id WHERE MONTH(tanggal) = $bulan ;")->getResult();
		} elseif ($bulan == "november") {
			$bulan = 11;
			return $this->db->query("SELECT users.username, lowongan.*  FROM lowongan JOIN users ON users.id=lowongan.perusahaan_id WHERE MONTH(tanggal) = $bulan ;")->getResult();
		} elseif ($bulan == "desember") {
			$bulan = 12;
			return $this->db->query("SELECT users.username, lowongan.*  FROM lowongan JOIN users ON users.id=lowongan.perusahaan_id WHERE MONTH(tanggal) = $bulan ;")->getResult();
		}
	}
	public function lamar($data)
	{
		$lowongan_id = $data['lowongan_id'];
		$asd = $this->db->query("SELECT lowongan.applier FROM lowongan where lowongan_id = $lowongan_id");
		foreach ($asd->getResult() as $row) {
		}
		$jumlah = $row->applier + $lowongan_id;
		$asda = [
			'applier' => $jumlah,
		];
		$this->lowongan->where('lowongan_id', $lowongan_id);
		$this->lowongan->update($asda);
		$this->data_lowongan->insert($data);
	}
	public function ceklamar($user_id, $lowongan_id)
	{
		return $this->data_lowongan->where(['lowongan_id' => $lowongan_id, 'user_id' => $user_id])->countAll();
	}


	public function pelamar($lowongan_id)
	{
		return $this->data_lowongan->where(['lowongan_id' => $lowongan_id])->join('users', 'users.id = user_id')->get()->getResultObject();
	}

	public function ubahlamaran($data_lowongan_id, $data)
	{
		$this->data_lowongan->where('data_lowongan_id', $data_lowongan_id);
		$this->data_lowongan->update($data);
	}
}
