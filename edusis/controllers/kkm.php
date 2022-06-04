<?php
class Kkm extends CI_Controller
{
    private $_kd_sekolah;
    private $_th_ajar;
    private $_p_nl;

    function __construct()
    {
        parent::__construct();
        $this->load->model('kkm_model');
        $this->load->model('app_model');
        $this->load->model('hasilbelajar_model');
        $this->load->model('kelas_model');
        $this->load->model('guru_model');
        $this->load->model('mp_model');
        $this->global['kd_sekolah'] = $this->session->userdata('kd_sekolah');
        $this->global['th_ajar']    = $this->session->userdata('th_ajar');
        if (!$this->app_model->is_login("")) {redirect('login/loggedout');}

        $this->_kd_sekolah  = $this->session->userdata('kd_sekolah');
        $this->_th_ajar     = $this->session->userdata('th_ajar');
        $this->_p_nl        = $this->session->userdata('kd_semester');

    }
    function index()
    {
        redirect('kkm/daftar');
    }
    function daftar()
    {
        $data['nama_sekolah']      = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']             = ' | Daftar KKM';
        $data['menu']              = $this->app_model->tampil_menu('KTSP');
        $data['kd_sekolah']        = $this->session->userdata('kd_sekolah');
        $data['th_ajar']           = $this->session->userdata('th_ajar');
        $data['kelass']            = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['kdmp']              = $this->mp_model->mp();
        $data['guru']              = $this->guru_model->getAll($data);
        $data['kelas']             = str_replace('+',' ',$this->uri->segment(3));
        $data['skelas']            = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');

        $data['kkm']               = $this->kkm_model->get_per_kelas($data['kelas'],  $this->_kd_sekolah,  $this->_th_ajar, $this->_p_nl);
        $this->load->view('kkm/daftar',$data);
    }
    function kkm_form($trx)
    {
        $data['nama_sekolah']      = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['th_ajar']           = $this->session->userdata('th_ajar');
        $data['kd_sekolah']        = $this->session->userdata('kd_sekolah');
        $data['kd_mp']             = $this->uri->segment(5);
        $data['menu']              = $this->app_model->tampil_menu('KTSP');
        $data['kelass']            = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['kdmp']              = $this->mp_model->mp();
        $data['mp']                = $this->mp_model->periksamp($data);
        //echo $this->db->last_query();
        $data['guru']              = $this->guru_model->getAll($data);

        if ($trx=="db_add")
        {
            $data['title']                = ' | Input KKM';
            $this->load->view("kkm/tambah",$data);
        }
        elseif ($trx=="db_edit")
        {
            $data['title']                = ' | Edit KKM';
            $data['data']                 = $this->kkm_model->get_per_kelas_mp(str_replace('+',' ',$this->uri->segment(4)),$data['kd_sekolah'],$data['th_ajar'],$this->session->userdata('kd_semester'),$this->uri->segment(5));

            $this->load->view("kkm/edit",$data);
        }
        elseif ($trx=="db_del")
        {
            $this->kkm_exec('db_del',$this->uri->segment(4),$this->uri->segment(5));
        }
    }
    function kkm_exec($trx)
    {
        $data['kd_sekolah']        = $this->session->userdata('kd_sekolah');
        $data['th_ajar']           = $this->session->userdata('th_ajar');
        $data['semester']          = $this->session->userdata('kd_semester');
        $data['nip']               = $this->input->post('guru');
        $data['kelas']             = $this->input->post('kelas');
        $data['kd_mp']             = $this->input->post('kd_mp');
        $data['skbm']              = $this->input->post('kkm');
        $data['deskripsi']         = $this->input->post('deskripsi');

        if ($trx=="db_add")
        {
            if($this->kkm_model->periksampkelas($data)->num_rows()==0)
            {
                if($this->kkm_model->simpan($data))
                {
                    redirect('kkm/daftar/'.str_replace(' ','+',$data['kelas']));
                }
                else
                {
                    echo '<script type="text/javascript">alert("'."Failed to save!".'");history.go(-1);</script>';
                }
            }
            else
            {
                echo '<script type="text/javascript">alert("'."Gagal simpan, Data Mata Pelajaran sudah terdaftar!".'");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_edit")
        {
            if($this->kkm_model->update($this->input->post('kd_mp'),$data))
            {
                redirect('kkm/daftar/'.str_replace(' ','+',$data['kelas']));
            }
            else
            {
                echo '<script type="text/javascript">alert("Failed to Update!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_del")
        {
            if($this->kkm_model->hapus($this->uri->segment(4),$this->uri->segment(5),$data))
            {

                redirect('kkm/daftar/'.str_replace(' ','+',$data['kelas']));
            }
            else
            {
                echo '<script type="text/javascript">alert("Failed to remove!");history.go(-1);</script>';
            }
        }
    }
}
