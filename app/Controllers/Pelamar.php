<?php

namespace App\Controllers;

use Config\Services;
use App\Models\Lowongan as ModelsLowongan;
use App\Models\User as ModelsUser;

class Pelamar extends BaseController
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
			'title' => 'pelamar',
		];
		return view('pelamar/dashboard/index', $data);
	}



	public function profile($username = '')
	{
		$data = [
			'user' => $this->user->select_data($username),
			'title' => "Profile",
		];
		return view('pelamar/profile/index', $data);
	}

	public function update_profile($username)
	{
		$rules = $this->validate([
			'gender' => 'required',
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
			'gender'       => $this->request->getPost('gender'),
			'city' => $this->request->getPost('city'),
			'image'        =>  $namafoto,
		];
		$this->user->update_data($username, $data);
		session()->setFlashData('success', 'data has been updated from database.');
		return redirect()->back();
	}
	public function lowongantersedia($bulan = '')
	{
		$data = [
			'title' => 'Loker bulan ' . $bulan . '',
			'lowongans' => $this->lowongan->bulan($bulan)
		];
		return view('pelamar/loker/index', $data);
	}
	public function pelamar($lowongan_id = '')
	{
		$data = [
			'title' => 'Loker bulan ' . $bulan . '',
			'lowongans' => $this->lowongan->bulan($bulan)
		];
		return view('pelamar/loker/index', $data);
	}

	public function lamar($lowongan_id)
	{
		$user_id = user()->id;
		$asd = $this->lowongan->ceklamar($lowongan_id, $user_id);
		if ($asd == null) {
			$data = [
				'lowongan_id' => $lowongan_id,
				'user_id' => $user_id,
				'ket' => "pending",
			];
			$this->lowongan->lamar($data);
			session()->setFlashData('success', ', Success Melamar');
			return redirect()->back();
		} else {
			session()->setFlashData('failed', ', Anda Sudah Melamar Diperusahaan ini');
			return redirect()->back();
		}
	}

	public function detail_perusahaan($perusahaan)
	{
		$data = [
			'perusahaan' => $this->user->select_data($perusahaan),
			'title' => "Profile Perusahaan",
		];
		return view('pelamar/profile/perusahaan', $data);
	}
}
