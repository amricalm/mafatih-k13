<?php
class Lapkonseling extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('lapkonseling_model');
        $this->load->model('app_model');
        $this->load->model('siswa_model');
        $this->load->model('kelas_model');
        $this->load->model('hasilbelajar_model');
        $this->global['kd_sekolah']     = $this->session->userdata('kd_sekolah');
        $this->global['th_ajar']        = $this->session->userdata('th_ajar');
    }
    function index()
    {
        redirect('konseling/daftar');
    }
    function daftar($tgl_dari='',$tgl_sampai='')
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Laporan konseling';
        $data['menu']               = $this->app_model->tampil_menu('Laporan BK');
        $data['tgldari']            = ($tgl_dari!='') ? $tgl_dari : '';
        $data['tglsampai']          = ($tgl_sampai!='') ? $tgl_sampai : '';
        $data['konseling']          = $this->lapkonseling_model->get($data['tgldari'],$data['tglsampai'],'');
        
        $this->load->view('konseling/lap_konseling',$data);

    }
    function daftar_persiswa($nama_lengkap='')
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Laporan konseling';
        $data['menu']               = $this->app_model->tampil_menu('Laporan BK');
        $data['nis']                = $this->uri->segment(4);
        $data['pilihkelas']         = $this->input->post('skelas');
        $data['nama']               = $this->siswa_model->nama($data['pilihkelas']);
        $data['skelas']             = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['konseling']          = $this->lapkonseling_model->get_persiswa($data['nis']);
        //echo $this->db->last_query();
        $this->load->view('konseling/lapkonseling_persiswa',$data);

    }
}