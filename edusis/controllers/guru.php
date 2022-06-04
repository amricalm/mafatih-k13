<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of peserta
 *
 * @author andhana
 */
class Guru extends CI_Controller{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('guru_model');
        $this->load->model('mp_model');
        $this->load->model('th_ajar_model');
        $this->load->model('sekolah_model');
        $this->load->model('app_model');
        $this->load->library('to_pdf');
        if (!$this->app_model->is_login("")) {redirect('login/loggedout');}
    }
    function index()
    {
        redirect('guru/daftar');
    }
    function daftar($off=0)
    {	
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Daftar Guru';
        $this->load->library('pagination');
        $limit = '';
        $jmhpegawai                 = $this->guru_model->get();
        $base_url                   = base_url().'index.php/pegawai/daftar';
        $total_row                  = $jmhpegawai->num_rows();
        $per_page                   = $limit;
        $uri_segment                = 3;

        $data['jmhguru']	        = $jmhpegawai->num_rows();
        $data['menu']               = $this->app_model->tampil_menu('File');
        //$data['guru']               = $this->guru_model->get('',$limit,$off);
        $data['guru']               = $this->guru_model->getAll();
		//$this->guru_model->get('00000000001');
		//echo $this->db->last_query();
        $this->load->view('guru/daftar',$data);
    }
    function guru_form($trx)
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Daftar Guru';
        $data['menu']               = $this->app_model->tampil_menu('File');
        $data['golongan']           = $this->app_model->get_golongan_pegawai();
        $data['ruang']              = $this->app_model->get_ruang_pegawai();
        $data['status']             = $this->app_model->get_status_pegawai();
        $data['jabatan']            = $this->app_model->get_jabatan_pegawai();
        $data['status_kawin']       = $this->app_model->get_status_kawin_pegawai();
        $data['ijazah']             = $this->app_model->get_ijazah_pegawai();
        $data['bidang_pend']        = $this->app_model->get_bidang_pend_pegawai();
        //$data['mp']                 = $this->mp_model->get_all($this->session->userdata('kd_sekolah'));
        $data['mp']               = $this->mp_model->mp();
        if ($trx=="db_add")
        {
            $data['title']          = ' | Input Data Guru/Karyawan';
            $this->load->view("guru/guru_form",$data);
        }
        elseif ($trx=="db_edit")
        {   
            
            $data['tgl']            = $this->guru_model->gettgllahir($this->uri->segment(4));
            $data['tglm']           = $this->guru_model->gettglmasuk($this->uri->segment(4));
            $data['tglk']           = $this->guru_model->gettglkeluar($this->uri->segment(4));
            $data['data']           = $this->guru_model->get($this->uri->segment(4));
            $data['title']          = ' | Edit Data Guru/Karyawan';
            $this->load->view("guru/guru_form_edit",$data);
        }
        elseif ($trx=="db_del")
        {
            $this->guru_exec($trx,$this->uri->segment(4));
        }
    }
    function guru_exec($trx)
	{   
		$pjabatan =0;
        $data['nip']                = $this->input->post('nip');
        //$data['kd_gaji']            = $this->input->post('kd_gaji');
        $data['nama_lengkap']       = $this->input->post('nama_lengkap');
        $data['kelamin']            = $this->input->post('kelamin');
        $data['tp_lahir']           = $this->input->post('tp_lahir');
        $data['tgl_lahir']          = adn_ctgl2($this->input->post('tgl_lahir'));
        $data['tk_pdd']             = $this->input->post('tk_pdd');
        $data['pdd_akhir']          = $this->input->post('pdd_akhir');
        $data['alamat']             = $this->input->post('alamat');
        $data['kota']               = $this->input->post('kota');
        $data['kode_pos']           = $this->input->post('kode_pos');
        $data['telp']               = $this->input->post('telp');
        $data['hp']                 = $this->input->post('hp');
        $data['status']       = $this->input->post('status_kawin');
        //$data['jurusan']            = $this->input->post('jurusan');
        $data['ijasah']             = $this->input->post('ijazah');
        //$data['stt_kerja']          = $this->input->post('stt_kerja');
        $data['kepeg_golongan']     = $this->input->post('kepeg_golongan');
        //$data['posisi']             = $this->input->post('posisi');
        $data['mp']                 = $this->input->post('mp');
        //$data['sk']                 = $this->input->post('sk');
        $data['agama']              = $this->input->post('agama');
        $data['jabatan']            = $pjabatan;
        $jabatan                    = $this->input->post('jabatan');
        $pjabatan                   = '';
        if(count($jabatan)!=0)
        {
            for($i=0;$i<count($jabatan);$i++)
            {
                $pjabatan           .= ($i!=0) ? ';' : '';
                $pjabatan           .= $jabatan[$i];
            }
        }
        $data['tgl_masuk']    = adn_ctgl2($this->input->post('tgl_mulai_kerja'));
        $data['tgl_keluar']         = adn_ctgl2($this->input->post('tgl_keluar'));
        //$data['tidak_aktif']        = $this->input->post('tidak_aktif');
        //$data['masa_kerja']         = $this->input->post('masa_kerja');
        //$data['spd']                = $this->input->post('spd');
        //$data['unit_kerja']         = $this->input->post('unit_kerja');
        
        if ($trx=="db_add") 
        {	
            $data['nip']            = $this->input->post('nip');
			$cariguru				= $this->guru_model->get(trim($data['nip']))->row_array();
			if(count($cariguru)<1)
			{
				if($this->guru_model->simpan($data))
				{
					echo '<script type="text/javascript">alert("Successfully Stored!");window.location="'.site_url('guru/guru_form/db_add').'";</script>';
				}
				else
				{
					echo '<script type="text/javascript">alert("Failed to Save!");history.go(-1);</script>';
				}
			}
			else
			{
				echo '<script type="text/javascript">alert("NIP Guru/Karyawan Telah terdaftar!");window.location="'.site_url('guru/guru_form/db_add').'";</script>';
			}
        }
        elseif ($trx=="db_edit")
        {	
            if($this->guru_model->update($this->input->post('nip'),$data))
            {
                echo '<script type="text/javascript">alert("Update Successfully!");window.location="'.site_url('guru/daftar').'";</script>';
            }
            else
            {
                echo '<script type="text/javascript">alert("Failed to Save!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_del")
        {
            if($this->guru_model->hapus($this->uri->segment(4)))
            {
                echo '<script type="text/javascript">alert("Delete Successfully!");window.location="'.site_url('guru/daftar').'";</script>';
            }
        }
    }
    function upload_foto_pegawai()
    {
        $this->load->model('pegawai_model');
        if((!empty($_FileS["photo"])) && ($_FileS['photo']['error'] == 0))
        {
            $filename       = basename($_FileS['photo']['name']);
            $ext            = substr($filename, strrpos($filename, '.') + 1);
            $tgl            = date('YmdHis');
            $target_path    = 'sidupload/photo/';
            $nama_path      = $tgl.'.'.$ext;
            if(move_uploaded_file($_FileS['photo']['tmp_name'], $target_path.$nama_path)) 
            {
                $data['peg_photo']  = $nama_path;
                if($this->pegawai_model->simpanphotopegawai($this->input->post('peg_kd'),$data))
                {
                    echo '<script type="text/javascript">alert('."'Upload file berhasil!'".');window.location="'.base_url().'index.php/pegawai/pegawai_form/db_edit/'.$this->input->post('peg_kd').'";</script>';
                }
                else
                {
                    echo '<script type="text/javascript">alert('."'Upload file gagal! silahkan coba lagi!'".');history.go(-1);</script>';
                }
            } 
            else
            {
                echo '<script type="text/javascript">alert('."'Upload file gagal! silahkan coba lagi!'".');history.go(-1);</script>';
            }
        }
        
    }
    function hapus_foto_pegawai($kd)
    {
        $namafile       = 'sidupload/photo/'.$this->master_model->detlistpegawai($kd)->row()->peg_photo;
        if($this->pegawai_model->hapusfilephoto($namafile))
        {
            if($this->pegawai_model->hapusphotopegawai($kd))
            {
                echo '<script type="text/javascript">window.location="'.base_url().'index.php/pegawai/pegawai_form/db_edit/'.$kd.'";</script>';
            }
            else
            {
                echo '<script type="text/javascript">alert('."'Hapus file gagal!'".');history.go(-1);</script>';
            }
        }
        else
        {
            echo '<script type="text/javascript">alert('."'Hapus file gagal!'".');history.go(-1);</script>';
        }
    }
    function daftarprint_pdf($off=0)
    {	
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Daftar Guru';
        $this->load->library('pagination');
        $limit = '';
        $jmhpegawai                 = $this->guru_model->get();
        $total_row                  = $jmhpegawai->num_rows();
        $per_page                   = $limit;
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'));
        $data['jmhguru']	        = $jmhpegawai->num_rows();
        $data['guru']               = $this->guru_model->get('',$limit,$off);
        //$this->load->view('cetak/guru',$data);
        $datapdf = $this->load->view('cetak/guru',$data,true);
		//echo $datapdf;
        $this->to_pdf->pdf_create($datapdf, 'Daftar Guru',true,'a4','landscape');
    }
}

?>