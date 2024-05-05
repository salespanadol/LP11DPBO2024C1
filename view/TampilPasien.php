<?php


include("KontrakView.php");
include("presenter/ProsesPasien.php");

class TampilPasien implements KontrakView
{
	private $prosespasien; //presenter yang dapat berinteraksi langsung dengan view
	private $tpl;

	function __construct()
	{
		//konstruktor
		$this->prosespasien = new ProsesPasien();
	}

	function tampil()
	{
		$this->prosespasien->prosesDataPasien();
		$data = null;

		//semua terkait tampilan adalah tanggung jawab view
		for ($i = 0; $i < $this->prosespasien->getSize(); $i++) {
			$no = $i + 1;
			$data .= "<tr>
			<td>" . $no . "</td>
			<td>" . $this->prosespasien->getNik($i) . "</td>
			<td>" . $this->prosespasien->getNama($i) . "</td>
			<td>" . $this->prosespasien->getTempat($i) . "</td>
			<td>" . $this->prosespasien->getTl($i) . "</td>
			<td>" . $this->prosespasien->getGender($i) . "</td>
			<td>" . $this->prosespasien->getEmail($i) . "</td>
			<td>" . $this->prosespasien->getTelp($i) . "</td>
			<td>
                <a href='index.php?id_edit=" . $id .  "' class='btn btn-warning''>Edit</a>
                <a href='index.php?id_hapus=" . $id . "' class='btn btn-danger' onclick='return confirmDelete()'>Hapus</a>
            </td>";
		}
		// Membaca template skin.html
		$this->tpl = new Template("templates/skin.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_TABEL", $data);

		// Menampilkan ke layar
		$this->tpl->write();
	}
	
    function tambahPasien($nik, $nama, $tempat, $tl, $gender, $email, $telp)
    {
        // Memanggil metode tambahPasien pada presenter
        $this->prosespasien->tambahPasien($nik, $nama, $tempat, $tl, $gender, $email, $telp);
        // Menampilkan kembali data pasien setelah penambahan
        $this->tampil();
    }

    function updatePasien($id, $nik, $nama, $tempat, $tl, $gender, $email, $telp)
    {
        // Memanggil metode updatePasien pada presenter
        $this->prosespasien->updatePasien($id, $nik, $nama, $tempat, $tl, $gender, $email, $telp);
        // Menampilkan kembali data pasien setelah pembaruan
        $this->tampil();
    }

    function hapusPasien($id)
    {
        // Memanggil metode hapusPasien pada presenter
        $this->prosespasien->hapusPasien($id);
        // Menampilkan kembali data pasien setelah penghapusan
        $this->tampil();
    }
}

