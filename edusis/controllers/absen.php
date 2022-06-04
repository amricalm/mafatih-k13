<?php
class Absen extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('absen_model');
        $this->load->model('kelas_model');
        $this->load->model('student_model');
        $this->global['th_ajar']    = $this->session->userdata('th_ajar');
        $this->global['kd_sekolah'] = $this->session->userdata('kd_sekolah');
        if (!$this->app_model->is_login("")) {redirect('login/loggedout');}
    }
    function index()
    {
       redirect('absen/daftar'); 
    }
    function daftar($kelas=0,$bulan='0',$tgl='0')
    {
        $data['nama_sekolah']                = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']                       = '| Absen Siswa';
        $data['menu']                        = $this->app_model->tampil_menu('Evaluasi');
        $data['kd_sekolah']                  = $this->session->userdata('kd_sekolah');
        $data['p_nl']                        = $this->session->userdata('kd_semester');
        //$data['kelas']                       = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['kelas']                       = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
        $data['pilihtahun']                  = '';
        $data['p_nl']                        = '';
        $data['pilihbulan']                  = '';
        $data['pilihkelas']                  = '';
        $data['pilihtgl']                    = '';
        $data['siswa']                       = '';
        $data['pilihbulan']                  = date('m');
        $data['pilihtgl']                    = date('d');
        if($this->input->post('filter'))
        {
            $data['pilihtahun']              = $this->session->userdata('th_ajar');
            $data['p_nl']                    = $this->session->userdata('kd_semester');
            $data['pilihkelas']              = str_replace('+',' ',$kelas);
            $data['pilihbulan']              = ($bulan!='' && $bulan!='0') ? $bulan : date('m');
            $data['pilihtgl']                = ($tgl!='' && $tgl!='0') ? $tgl : date('d');
            
            $data['siswa']                   = $this->absen_model->get($data['pilihbulan'],$data['pilihtahun'],$data['kd_sekolah'],$data['pilihkelas'],$data['pilihtgl'],$data['p_nl']);
        //echo $this->db->last_query();
        }
        $this->load->view('absen_view/daftar',$data);
    }
    function simpan()
    {
        $data['kd_sekolah']                  = $this->session->userdata('kd_sekolah');
        $data['th_ajar']                     = $this->session->userdata('th_ajar');
        $data['p_nl']                        = $this->session->userdata('kd_semester');
        $data['bulan']                       = $this->input->post('bulan');
        $data['kode_kelas']                  = $this->input->post('kelas');
        $data['tgl']                         = $this->input->post('tgl');
        $semua                               = $this->input->post('semua');
        for($i=0;$i<count($semua);$i++)
        {
           $data['nis']                      = $semua[$i];
           $data['absen']                    = $this->input->post('absen'.$i);
           $sdata                            = $this->absen_model->dapat($data);              
           if($sdata->num_rows() > 0)
           {
                $this->absen_model->update($data);
           }
           else
           {
                $this->absen_model->simpan($data);
           }
        }
        redirect('absen/daftar');
    }
    function lapabsen($kelas=0,$bulan='0')
    {
        $data['nama_sekolah']                = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']                       = '| Absen Siswa';
        $data['menu']                        = $this->app_model->tampil_menu('Laporan BK');
        //$data['kelas']                       = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['kelas']                       = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
        $data['pilihbulan']                  = ($bulan!='' && $bulan!='0') ? $bulan : date('m');
        $data['th_ajar']                     = '';
        $data['p_nl']                        = '';
        $data['kd_sekolah']                  = '';
        $data['pilihkelas']                  = '';
        if($this->input->post('filter'))
        {
            $data['kd_sekolah']              = $this->session->userdata('kd_sekolah');
            $data['th_ajar']                 = $this->session->userdata('th_ajar');
            $data['p_nl']                    = $this->session->userdata('kd_semester');
            $data['pilihkelas']              = str_replace('+',' ',$kelas);
            $data['siswa']                   = $this->absen_model->getlap($data['kd_sekolah'],$data['th_ajar'],$data['pilihkelas'],$data['p_nl']);
        //echo $this->db->last_query();
        }
        $this->load->view('absen_view/lapabsen',$data);
    }
    
}
