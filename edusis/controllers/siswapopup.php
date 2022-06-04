<?php
class Siswapopup extends CI_Controller{
    
    function __Construct()
    {
        parent::__Construct();
        $this->load->model('siswapopup_model');
        $this->load->model('siswa_model');
        $this->load->model('mp_model');
        $this->load->model('nilai_model');
        $this->load->model('kelas_model');
        $this->global['kd_sekolah']     = $this->session->userdata('kd_sekolah');
        $this->global['th_ajar']        = $this->session->userdata('th_ajar');
    }
    function index()
    {
        redirect('konseling/daftar_siswapopup');
    }
    function daftar($kelas='0',$off=0)
    {	

        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $this->load->library('pagination');
        $txtcari                    = ($this->input->post('submit')!='') ? $this->input->post('txtcari') : $this->session->userdata('txtcarisiswa');
        $this->session->set_userdata(array('txtcarisiswa'=>$txtcari));
        $data['txtcarisiswa']       = $this->session->userdata('txtcarisiswa');
        $data['kelas']              = $this->kelas_model->get('',$this->global['kd_sekolah']);
        $data['pilihkelas']         = str_replace('+',' ',$kelas);
        
        $limit                      = 50;
        $jmhsiswa                   = $this->siswa_model->get('',$this->session->userdata('kd_sekolah'),$data['pilihkelas'],'','',$data['txtcarisiswa']);
        $base_url                   = base_url().'index.php/siswa/daftar/'.$data['pilihkelas'];
        $total_row                  = $jmhsiswa->num_rows();
        $per_page                   = $limit;
        $uri_segment                = 3;

        $config                     = $this->app_model->config_pagination($base_url,$total_row,$per_page,$uri_segment);

        $this->pagination->initialize($config);
        
        $data['title']              = ' | Daftar Siswa';
	    $data['jmhsiswa']           = $jmhsiswa->num_rows();
        $data['menu']               = $this->app_model->tampil_menu('FILE');
        $data['siswa']              = $this->siswapopup_model->get('',$this->session->userdata('kd_sekolah'),$data['pilihkelas'],$limit,$off,$data['txtcarisiswa']);
        //echo $this->db->last_query();        
        
        $this->load->view('konseling/daftar_siswapopup',$data);
    }

    function cari($off=0)
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $this->load->library('pagination');
        $txtcari                    = ($this->input->post('submit')!='') ? $this->input->post('cari') : $this->session->userdata('txtcarisiswa');
        $this->session->set_userdata(array('txtcarisiswa'=>$txtcari));
        $data['txtcarisiswa']       = $this->session->userdata('txtcarisiswa');
        $limit = 50;
        $data['cari']               = ($this->input->post('cari')!='') ? $this->input->post('cari') : '';
        $jmhsiswa                   = $this->siswa_model->get('',$this->session->userdata('kd_sekolah'),'','',$data['txtcarisiswa']);
        $base_url                   = base_url().'index.php/siswa/cari';
        $total_row                  = $jmhsiswa->num_rows();
        $per_page                   = $limit;
        $uri_segment                = 3;

        $config                     = $this->app_model->config_pagination($base_url,$total_row,$per_page,$uri_segment);

        $this->pagination->initialize($config);
        
        $data['title']              = ' | Daftar Siswa';
	    $data['jmhsiswa']           = $jmhsiswa->num_rows();
        $data['menu']               = $this->app_model->tampil_menu('Laporan');
        $data['siswa']              = $this->siswapopup_model->get('',$this->session->userdata('kd_sekolah'),$limit,$off,$data['txtcarisiswa']);
        $this->load->view('konseling/daftar_siswapopup',$data);
    }
}

?>