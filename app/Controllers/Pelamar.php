<?php

namespace App\Controllers;

class Pelamar extends BaseController
{
	public function index()
	{
		return view('/pelamar/dashboard/index');
	}
}
