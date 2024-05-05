<?php

include("KontrakPresenter.php");


class ProsesPasien implements KontrakPresenter
{
	private $tabelpasien;
	private $data = [];

	function __construct()
	{
		//konstruktor
		try {
			$db_host = "localhost"; // host 
			$db_user = "root"; // user
			$db_password = ""; // password
			$db_name = "mvp_php"; // nama basis data
			$this->tabelpasien = new TabelPasien($db_host, $db_user, $db_password, $db_name); //instansi TabelPasien
			$this->data = array(); //instansi list untuk data Pasien
			//data = new ArrayList<Pasien>;//instansi list untuk data Pasien
		} catch (Exception $e) {
			echo "wiw error" . $e->getMessage();
		}
	}

	function prosesDataPasien()
	{
		try {
			//mengambil data di tabel pasien
			$this->tabelpasien->open();
			$this->tabelpasien->getPasien();
			while ($row = $this->tabelpasien->getResult()) {
				//ambil hasil query
				$pasien = new Pasien(); //instansiasi objek pasien untuk setiap data pasien
				$pasien->setId($row['id']); //mengisi id
				$pasien->setNik($row['nik']); //mengisi nik
				$pasien->setNama($row['nama']); //mengisi nama
				$pasien->setTempat($row['tempat']); //mengisi tempat
				$pasien->setTl($row['tl']); //mengisi tl
				$pasien->setGender($row['gender']);
				$pasien->setEmail($row['email']);
				$pasien->setTelp($row['telp']); //mengisi gender


				$this->data[] = $row; //tambahkan data pasien ke dalam list
			}
			//tutup koneksi
			$this->tabelpasien->close();
		} catch (Exception $e) {
			//memproses error
			echo "wiw error part 2" . $e->getMessage();
		}
	}
	function getId($i)
	{
		//mengembalikan id Pasien dengan indeks ke i
		return $this->data[$i]['id'];
	}
	function getNik($i)
	{
		//mengembalikan nik Pasien dengan indeks ke i
		return $this->data[$i]['nik'];
	}
	function getNama($i)
	{
		//mengembalikan nama Pasien dengan indeks ke i
		return $this->data[$i]['nama'];
	}
	function getTempat($i)
	{
		//mengembalikan tempat Pasien dengan indeks ke i
		return $this->data[$i]['tempat'];
	}
	function getTl($i)
	{
		//mengembalikan tanggal lahir(TL) Pasien dengan indeks ke i
		return $this->data[$i]['tl'];
	}
	function getGender($i)
	{
		//mengembalikan gender Pasien dengan indeks ke i
		return $this->data[$i]['gender'];
	}
	function getEmail($i)
	{
		//mengembalikan gender Pasien dengan indeks ke i
		return $this->data[$i]['email'];
	}
	function getTelp($i)
	{
		//mengembalikan gender Pasien dengan indeks ke i
		return $this->data[$i]['telp'];
	}
	function getSize()
	{
		return sizeof($this->data);
	}
	function tambahPasien($nik, $nama, $tempat, $tl, $gender, $email, $telp)
	{
		try {
			// Panggil metode untuk menambahkan data pasien ke dalam basis data
			$this->tabelpasien->open();
			$this->tabelpasien->tambahPasien($nik, $nama, $tempat, $tl, $gender, $email, $telp);
			// Setelah menambahkan, proses ulang data pasien
			$this->prosesDataPasien();
			$this->tabelpasien->close();
		} catch (Exception $e) {
			// Tangani error jika terjadi
			echo "Error saat menambahkan pasien: " . $e->getMessage();
		}
	}

	function updatePasien($id, $nik, $nama, $tempat, $tl, $gender, $email, $telp)
	{
		try {
			// Panggil metode untuk memperbarui data pasien berdasarkan ID
			$this->tabelpasien->open();
			$this->tabelpasien->updatePasien($id, $nik, $nama, $tempat, $tl, $gender, $email, $telp);
			// Setelah memperbarui, proses ulang data pasien
			$this->prosesDataPasien();
			$this->tabelpasien->close();
		} catch (Exception $e) {
			// Tangani error jika terjadi
			echo "Error saat memperbarui pasien: " . $e->getMessage();
		}
	}

	function hapusPasien($id)
	{
		try {
			// Panggil metode untuk menghapus data pasien berdasarkan ID
			$this->tabelpasien->open();
			$this->tabelpasien->hapusPasien($id);
			// Setelah menghapus, proses ulang data pasien
			$this->prosesDataPasien();
			$this->tabelpasien->close();
		} catch (Exception $e) {
			// Tangani error jika terjadi
			echo "Error saat menghapus pasien: " . $e->getMessage();
		}
	}

}
