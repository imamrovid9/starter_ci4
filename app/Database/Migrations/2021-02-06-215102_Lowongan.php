<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Lowongan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'lowongan_id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'perusahaan_id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
			],
			'name'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
			],
			'deskripsi'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'kategori'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
			],
			'kuota'       => [
				'type'       => 'INT',
				'constraint' => 255,
			],
			'applier'       => [
				'type'       => 'INT',
				'constraint' => 255,
			],
			'status'       => [
				'type'       => 'ENUM',
				'constraint' => "'tersedia','tutup'",
			],
			'tanggal' => [
				'type' => 'Date',
			],
			'created_at' => [
				'type'           => 'DATETIME',
				'null'           => true,
			],
			'updated_at' => [
				'type'           => 'DATETIME',
				'null'           => true,
			]
		]);
		$this->forge->addKey('lowongan_id', true);
		$this->forge->createTable('lowongan');
	}

	public function down()
	{
		$this->forge->dropTable('lowongan');
	}
}
