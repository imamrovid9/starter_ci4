<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		if (in_groups('pelamar')) {
			$redirectURL =  site_url('/pelamar');
		} elseif (in_groups('perusahaan')) {
			$redirectURL =  site_url('/perusahaan');
		}
		return redirect()->to($redirectURL);
	}
}
