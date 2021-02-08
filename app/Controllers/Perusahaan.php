<?php

namespace App\Controllers;

use Config\Services;
use App\Models\Lowongan as ModelsLowongan;
use App\Models\User as ModelsUser;
use CodeIgniter\HTTP\Request;
use CodeIgniter\I18n\Time;
use Myth\Auth\Collectors\Auth;

class Perusahaan extends BaseController
{

	//
	protected $lowongan;

	public function __construct()
	{
		$this->lowongan = new ModelsLowongan();
		$this->user = new ModelsUser();
		$this->validation = Services::validation();
		$this->session = session();

		helper('form');
	}

	public function index()
	{

		$data = [
			'title' => 'Lowongan Perusahaan',
			'data_lowongans' => $this->lowongan->select_data(),
		];

		return view('perusahaan/dashboard/index', $data);
	}



	public function profile($username = '')
	{
		$data = [
			'user' => $this->user->select_data($username),
			'title' => "Profile",
		];
		return view('perusahaan/profile/index', $data);
	}

	public function update_profile($username)
	{
		// dd($this->request->getVar());

		$rules = $this->validate([
			'description_perusahaan' => 'required',
			'city' => 'required',
			'image' => 'is_image[image]',
		]);
		if (!$rules) {
			session()->setFlashData('failed', \Config\Services::validation()->getErrors());
			return redirect()->back();
		}
		$filefoto = $this->request->getFile('image');
		if ($filefoto->getError() !== 4) {
			$filefoto = $this->request->getFile('image');
			$namafoto = $filefoto->getRandomName();
			$filefoto->move('img', $namafoto);
		} else {
			$namafoto = $this->request->getPost('oldfoto');
		}
		$data = [
			'description'       => $this->request->getPost('description_perusahaan'),
			'city' => $this->request->getPost('city'),
			'image'        =>  $namafoto,
		];
		$this->user->update_data($username, $data);
		session()->setFlashData('success', 'data has been updated from database.');
		return redirect()->back();
	}


	public function tambahlowongan()
	{
		$rules = $this->validate([
			'nama_lowongan' => 'required',
			'deskripsi_lowongan' => 'required',
			'kategori_lowongan' => 'required',
			'kuota_lowongan' => 'required',
			'status_lowongan' => 'required',
			'tanggal_lowongan' => 'required',
		]);
		if (!$rules) {
			session()->setFlashData('failed', \Config\Services::validation()->getErrors());
			return redirect()->back();
		}
		$now = new Time('now');
		$data = [
			'perusahaan_id'       => user()->id,
			'name' => $this->request->getPost('nama_lowongan'),
			'deskripsi' => $this->request->getPost('deskripsi_lowongan'),
			'kategori' => $this->request->getPost('kategori_lowongan'),
			'kuota' => $this->request->getPost('kuota_lowongan'),
			'applier'        =>  0,
			'status' => $this->request->getPost('status_lowongan'),
			'tanggal' => $this->request->getPost('tanggal_lowongan'),
			'created_at' => $now,
			'updated_at' => $now,
		];
		$this->lowongan->add_data($data);
		session()->setFlashData('success', 'data has been created.');
		return redirect()->back();
	}


	public function delete($lowongan_id)
	{
		$this->lowongan->delete_data($lowongan_id);
		session()->setFlashData('success', 'data has been Deleted.');
		return redirect()->back();
	}
	public function update($lowongan_id)
	{
		$now = new Time('now');
		$data = [
			'perusahaan_id'       => user()->id,
			'name' => $this->request->getPost('nama_lowongan'),
			'deskripsi' => $this->request->getPost('deskripsi_lowongan'),
			'kategori' => $this->request->getPost('kategori_lowongan'),
			'kuota' => $this->request->getPost('kuota_lowongan'),
			'status' => $this->request->getPost('status_lowongan'),
			'tanggal' => $this->request->getPost('tanggal_lowongan'),
			'updated_at' => $now,
		];
		$this->lowongan->update_data($lowongan_id, $data);
		session()->setFlashData('success', 'data has been Updated.');
		return redirect()->back();
	}


	public function pelamar($data_lowongan_id)
	{
		$cek = $this->lowongan->pelamar($data_lowongan_id);
		if ($cek == null) {
			session()->setFlashData('success', 'Belum ada pelamar.');
			return redirect()->back();
		} else {
			$data = [
				'data_lowongans' => $this->lowongan->pelamar($data_lowongan_id),
				'title' => "Data Lowongan",
			];
			return view('perusahaan/lamaran/index', $data);
		}
	}

	public function ubahdatalamaran($data_lowongan_id)
	{
		$data = [
			'ket'       => $this->request->getPost('status'),
		];
		$this->lowongan->ubahlamaran($data_lowongan_id, $data);
		session()->setFlashData('success', 'data has been Updated.');
		return redirect()->back();
	}
	public function detail_perusahaan($perusahaan)
	{
		$data = [
			'perusahaan' => $this->user->select_data($perusahaan),
			'title' => "Profile Perusahaan",
		];
		return view('perusahaan/profile/pelamar', $data);
	}
}
