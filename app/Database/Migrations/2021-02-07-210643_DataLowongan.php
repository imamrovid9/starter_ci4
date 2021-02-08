<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataLowongan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'data_lowongan_id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'lowongan_id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
			], 'user_id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
			],
			'ket'          => [
				'type'           => "ENUM('lolos','tidak lolos','pending')",
				'default' => 'pending',
			]
		]);
		$this->forge->addKey('data_lowongan_id', true);
		$this->forge->createTable('data_lowongan');
	}

	public function down()
	{
		$this->forge->dropTable('data_lowongan');
	}
}
