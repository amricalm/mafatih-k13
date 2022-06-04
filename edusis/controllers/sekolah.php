<?php 
class Sekolah extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('sekolah_model');
        $this->load->model('th_ajar_model');
        $this->load->model('app_model');
        $this->load->library('to_pdf');
        
        $this->global['kd_sekolah']     = $this->session->userdata('kd_sekolah');
        $this->global['th_ajar']        = $this->session->userdata('th_ajar');
        if (!$this->app_model->is_login("")) {redirect('login/loggedout');}
        
    }
    function index()
    {
        redirect('sekolah/daftar');
    }
    function profil()
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        //echo $this->db->last_query();
        //echo $data['nama_sekolah'];
        //die();
        $data['title']              = ' | Master Sekolah';
        $data['menu']               = $this->app_model->tampil_menu('Home');
        $data['data']               = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'));
        $data['sekolah']            = $this->sekolah_model->get('');
        $this->load->view('sekolah/profil',$data);
        //$this->load->view('sekolah/ex',$data);
    }
    function sekolah_form($trx)
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['menu']               = $this->app_model->tampil_menu('Home');
        
        if ($trx == "db_add")
        {
            $data['title']          = ' | Input Sekolah';
            $this->load->view('sekolah/tambah',$data);
        }
        elseif ($trx == "db_edit")
        {
            $data['title']          = ' | Edit Sekolah';
            $data['data']           = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
            //$data['data']           = $this->sekolah_model->get($this->uri->segment(4));
            $this->load->view('sekolah/edit',$data);
        }
        elseif ($trx == "db_del")
        {
            $this->sekolah_exec($trx,$this->uri->segment(4));
        }
    }
    
    function sekolah_exec($trx)
    {
        $data['kd_sekolah']         = $this->input->post('kd_sekolah');
        $data['nama_sekolah']       = $this->input->post('nama_sekolah');
        $data['tingkat']            = $this->input->post('tingkat');
        $data['nss']                = $this->input->post('nss');
        $data['alamat_sekolah']     = $this->input->post('alamat_sekolah');
        $data['kelurahan']          = $this->input->post('kelurahan');
        $data['pos']                = $this->input->post('pos');
        $data['kecamatan']          = $this->input->post('kecamatan');
        $data['kabupaten']          = $this->input->post('kabupaten');
        $data['propinsi']           = $this->input->post('propinsi');
        $data['telp']               = $this->input->post('telp');
        $data['fax']                = $this->input->post('fax');
        $data['email']              = $this->input->post('email');
        $data['sms']                = $this->input->post('sms');
        $data['status']             = $this->input->post('status');
        $data['th_diri']            = $this->input->post('th_diri');
        $data['nilai_akreditasi']   = $this->input->post('nilai_akreditasi');
        $data['jml_kelas']          = $this->input->post('jml_kelas');
        $data['luas_tanah']         = $this->input->post('luas_tanah');
        $data['luas_bangunan']      = $this->input->post('luas_bangunan');
        $data['luas_kebun']         = $this->input->post('luas_kebun');
        $data['status_tanah']       = $this->input->post('status_tanah');
        if($trx == "db_add")
        {
            if($this->sekolah_model->simpan($data))
            {
                redirect('sekolah/daftar');
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal menyimpan data!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_edit")
        {   
            if($this->sekolah_model->update($this->input->post('kd_sekolah'),$data))
            {
                redirect('sekolah/daftar');
            }
            else
            {
                echo '<script type="text/javascript">alert("Edit Sekolah Gagal !");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_del")
        {
            if($this->sekolah_model->hapus($this->uri->segment(4)))
            {
                redirect('sekolah/daftar/');
            }
            else
            {
                echo '<script type="text/javascript">alert("Dagal menghapus data!");history.go(-1);</script>';
            }
        }
    }
    function profile()
    {
        $data['kd_sekolah']         = $this->uri->segment(3);
        $data['data']               = $this->sekolah_model->get($data['kd_sekolah']);
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'));
        $datapdf = $this->load->view('cetak/sekolah',$data,true);
        $this->to_pdf->pdf_create($datapdf, 'PROFIL SEKOLAH',true,'a4','portrait');
    }
    
}
?>