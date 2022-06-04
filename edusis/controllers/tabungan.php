<?php
/**
 *
 */
class Tabungan extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('tabungan_model');
  }
  function index()
  {
    redirect('tabungan/ipt_tabungan');
  }
  function ipt_tabungan()
  {
    $data['nama_sekolah'] = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
    $data['menu'] = $this->app_model->tampil_menu('Tabungan');
    $data['dropdown'] = $this->tabungan_model->jns_tabungan();

    $this->load->view('tabungan/memasukan_tabungan', $data);
  }
  function shw_tabungan()
  {
    echo "<h1>ini halaman untuk menampilkan hasil Tabungan</h1>";
  }
  function cariSiswa()
  {
    $data['nama_sekolah'] = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
    $data['menu'] = $this->app_model->tampil_menu('Tabungan');
    $data['dropdown'] = $this->tabungan_model->jns_tabungan();
    $isiData['keyword'] = $this->input->post('siswaTabungan');
    $dataSiswa = $this->tabungan_model->cariSiswaModel($isiData['keyword']);
    foreach ($dataSiswa as $brs) {
      $data['nama_siswa'] = $brs['nama_lengkap'];
    }

    $newData = array(
      'nama_lengkap_siswa' => '$data["nama_siswa"]'
    );

    $this->session->set_userdata($newData);

    $data['cekSiswa'] = $this->session->userdata('nama_lengkap_siswa');
    $this->load->view('tabungan/memasukan_tabungan', $data);
  }
}

 ?>
