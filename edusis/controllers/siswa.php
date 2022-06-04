<?php
class Siswa extends CI_Controller
{
    function __Construct()
    {
        parent::__Construct();
        $this->load->model('siswa_model');
        $this->load->model('mp_model');
        $this->load->model('sekolah_model');
        $this->load->model('th_ajar_model');
        $this->load->model('nilai_model');
        $this->load->model('kelas_model');
        $this->load->model('app_model');
        $this->load->library('to_pdf');
        
        $this->global['kd_sekolah']     = $this->session->userdata('kd_sekolah');
        $this->global['th_ajar']        = $this->session->userdata('th_ajar');
        if (!$this->app_model->is_login("")) {redirect('login/loggedout');}
    }
    function index()
    {
        redirect('siswa/daftar');
    }
    function daftar($kelas='0',$off=0)
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $this->load->library('pagination');
        $txtcari                    = ($this->input->post('submit')!='') ? $this->input->post('txtcari') : $this->session->userdata('txtcarisiswa');
        $this->session->set_userdata(array('txtcarisiswa'=>$txtcari));
        $data['txtcarisiswa']       = $this->session->userdata('txtcarisiswa');
        $data['kelas']              = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['pilihkelas']         = str_replace('+',' ',$kelas);
        $data['pilihkls']           = str_replace(' ','+',$kelas);
        $limit                      = 40;
        $jmhsiswa                   = $this->siswa_model->get('',$this->session->userdata('kd_sekolah'),$data['pilihkelas'],'','',$data['txtcarisiswa']);
        
        $base_url                   = base_url().'index.php/siswa/daftar/'.$data['pilihkls'];
        $total_row                  = $jmhsiswa->num_rows();
        $per_page                   = $limit;
        $uri_segment                = 4;

        $config                     = $this->app_model->config_pagination($base_url,$total_row,$per_page,$uri_segment);

        $this->pagination->initialize($config);
        $data['title']              = ' | Daftar Siswa';
	    $data['jmhsiswa']           = $jmhsiswa->num_rows();
        $data['menu']               = $this->app_model->tampil_menu('File');
        $data['siswa']              = $this->siswa_model->get('',$this->session->userdata('kd_sekolah'),$data['pilihkelas'],$limit,$off,$data['txtcarisiswa']);
        //echo $this->db->last_query();
        $this->load->view('siswa/daftar',$data);
    }
    function siswa_form($trx)
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['menu']               = $this->app_model->tampil_menu('File');
        if ($trx=="db_add")
        {
            $data['title']              = ' | Input Data Siswa';
            $this->load->view("siswa/siswa_form_2",$data);
        }
        elseif ($trx=="db_edit")
        {
            $data['title']              = ' | Edit Data Siswa';
            $data['tgl']                = $this->siswa_model->gettgllahir($this->uri->segment(4));
            $data['tglmasuk']           = $this->siswa_model->getmasuktgl($this->uri->segment(4));
            $data['data']               = $this->siswa_model->getall($this->uri->segment(4));
            $this->load->view("siswa/siswa_form_edit_2",$data);
        }
        elseif ($trx=="dbdaftar")
        {   
            $data['title']              = ' | Daftar Data Siswa';
            $data['data']               = $this->siswa_model->getall($this->uri->segment(4));
            $this->load->view("cetak/siswa",$data);
        }
        elseif ($trx=="db_del")
        {
            $this->siswa_exec('db_del',$this->uri->segment(4));
        }
    }
    function siswa_exec($trx)
    {
        $data['kd_sekolah']             = $this->session->userdata('kd_sekolah');
        $data['nama_lengkap']           = $this->input->post('nama_lengkap');
        $data['nama_panggilan']         = $this->input->post('nama_panggilan');
        $data['kelamin']                = $this->input->post('kelamin');
        $data['tp_lahir']               = $this->input->post('tp_lahir');
        $data['tgl_lahir']              = adn_ctgl2($this->input->post('tgl_lahir'));
        $data['agama']                  = $this->input->post('agama');
        $data['wn']                     = $this->input->post('wn');
        $data['anak_ke']                = $this->input->post('anak_ke');
        $data['jmh_sdr_kandung']        = $this->input->post('jmh_sdr_kandung');
        $data['jmh_sdr_tiri']           = $this->input->post('jmh_sdr_tiri');
        $data['jmh_sdr_angkat']         = $this->input->post('jmh_sdr_angkat');
        //$data['alamat_ortu']            = $this->input->post('alamat_ortu');
        //$data['status_diri']            = $this->input->post('status_diri');
        $data['bahasa']                 = $this->input->post('bahasa');
        $data['alamat']                 = $this->input->post('alamat');
        $data['kelurahan']              = $this->input->post('kelurahan');
        $data['kode_pos']               = $this->input->post('kode_pos');
        $data['kecamatan']              = $this->input->post('kecamatan');
        $data['kota']                   = $this->input->post('kota');   
        $data['telp']                   = $this->input->post('telp');
        $data['tinggal_dg']             = $this->input->post('tinggal_dg');
        $data['jarak']                  = $this->input->post('jarak');  
        //$data['transportasi']           = $this->input->post('transportasi');
        $data['gol_darah']              = $this->input->post('gol_darah');   
        $data['penyakit']               = $this->input->post('penyakit');
        //$data['kelainan']               = $this->input->post('kelainan');
        $data['tinggi_badan']           = $this->input->post('tinggi_badan');
        $data['berat_badan']            = $this->input->post('berat_badan');
        $data['asal_sekolah']           = $this->input->post('asal_sekolah');
        //$data['sttb_tgl_pra']           = $this->input->post('sttb_tgl_pra');
        //$data['sttb_no_pra']            = $this->input->post('sttb_no_pra');
        //$data['lama_belajar_pra']       = $this->input->post('lama_belajar_pra');
        //$data['pindahan_skl']           = $this->input->post('pindahan_skl');
        //$data['pindahan_alasan']        = $this->input->post('pindahan_alasan');
        //$data['diterima_kelas']         = $this->input->post('diterima_kls');
        //$data['diterima_klp']           = $this->input->post('diterima_klp');
        //$data['diterima_jurusan']       = $this->input->post('diterima_jurusan');
        $data['diterima_tgl']           = adn_ctgl2($this->input->post('diterima_tgl'));
        $data['ayah_nama']              = $this->input->post('ayah_nama');
        //$data['ayah_tp_lahir']          = $this->input->post('ayah_tp_lahir');
        //$data['ayah_tgl_lahir']         = $this->input->post('ayah_tgl_lahir');
        //$data['ayah_agama']             = $this->input->post('ayah_agama');
        //$data['ayah_wn']                = $this->input->post('ayah_wn');
        $data['ayah_pdd']               = $this->input->post('ayah_pdd');
        $data['ayah_pekerjaan']         = $this->input->post('ayah_pekerjaan');
        //$data['ayah_penghasilan']       = $this->input->post('ayah_penghasilan');
        //$data['ayah_alamat']            = $this->input->post('ayah_alamat');
        //$data['ayah_kelurahan']         = $this->input->post('ayah_kelurahan');
        //$data['ayah_kode_pos']          = $this->input->post('ayah_kode_pos');
        //$data['ayah_kecamatan']         = $this->input->post('ayah_kecamatan');
        //$data['ayah_kota']              = $this->input->post('ayah_kota');
        //$data['ayah_telp']              = $this->input->post('ayah_telp');
        //$data['ayah_status']            = $this->input->post('ayah_status');
        //$data['ayah_meninggal_th']      = $this->input->post('ayah_meninggal_th');  
        $data['ibu_nama']               = $this->input->post('ibu_nama');
        //$data['ibu_tp_lahir']           = $this->input->post('ibu_tp_lahir');
        //$data['ibu_tgl_lahir']          = $this->input->post('ibu_tgl_lahir');
        //$data['ibu_agama']              = $this->input->post('ibu_agama');
        //$data['ibu_wn']                 = $this->input->post('ibu_wn');
        $data['ibu_pdd']                = $this->input->post('ibu_pdd');
        $data['ibu_pekerjaan']          = $this->input->post('ibu_pekerjaan');
        //$data['ibu_penghasilan']        = $this->input->post('ibu_penghasilan');
        $data['ibu_alamat']             = $this->input->post('ibu_alamat');
        $data['ibu_kelurahan']          = $this->input->post('ibu_kelurahan');
        $data['ibu_kode_pos']           = $this->input->post('ibu_kode_pos');
        $data['ibu_kecamatan']          = $this->input->post('ibu_kecamatan');
        $data['ibu_kota']               = $this->input->post('ibu_kota');
        $data['ibu_telp']               = $this->input->post('ibu_telp');
        //$data['ibu_status']             = $this->input->post('ibu_status');
        //$data['ibu_meninggal_th']       = $this->input->post('ibu_meninggal_th'); 
        $data['wali_nama']              = $this->input->post('wali_nama');
        $data['wali_hubungan']          = $this->input->post('wali_hubungan');
        //$data['wali_tp_lahir']          = $this->input->post('wali_tp_lahir');
        //$data['wali_tgl_lahir']         = $this->input->post('wali_tgl_lahir');
        //$data['wali_agama']             = $this->input->post('wali_agama');
        //$data['wali_wn']                = $this->input->post('wali_wn');
        $data['wali_pdd']               = $this->input->post('wali_pdd');
        $data['wali_pekerjaan']         = $this->input->post('wali_pekerjaan');
        //$data['wali_penghasilan']       = $this->input->post('wali_penghasilan');
        $data['wali_alamat']            = $this->input->post('wali_alamat');
        //$data['wali_kelurahan']         = $this->input->post('wali_kelurahan');
        //$data['wali_kode_pos']          = $this->input->post('wali_kode_pos');
        //$data['wali_kecamatan']         = $this->input->post('wali_kecamatan');
        //$data['wali_kota']              = $this->input->post('wali_kota');
        $data['wali_telp']              = $this->input->post('wali_telp'); 
        //$data['kesenian']               = $this->input->post('kesenian');
        //$data['olah_raga']              = $this->input->post('olah_raga');
        //$data['organisasi']             = $this->input->post('organisasi');
        //$data['lain_lain']              = $this->input->post('lain_lain');
        //$data['bea_siswa_th']           = $this->input->post('bea_siswa_th');
        //$data['bea_tk']                 = $this->input->post('bea_tk');
        //$data['bea_dari']               = $this->input->post('bea_dari');
        //$data['tgl_keluar_skl']         = $this->input->post('tgl_keluar_skl');
        //$data['alasan_keluar']          = $this->input->post('alasan_keluar');
        //$data['tamat_belajar']          = $this->input->post('tamat_belajar');
        //$data['sttb_no_pdd']            = $this->input->post('sttb_no_pdd');
        //$data['lanjut_di']              = $this->input->post('lanjut_di');
        //$data['bekerja_tgl']            = $this->input->post('bekerja_tgl');
        //$data['nama_ps']                = $this->input->post('nama_ps');
        //$data['penghasilan']            = $this->input->post('penghasilan');
        //$data['program']                = $this->input->post('program');
        $data['status']                 = 'Aktif';
        //$data['ortu']                   = $this->input->post('ortu');
        //$data['th_sttb_pra']            = $this->input->post('th_sttb_pra');
        //$data['tgl_keluar']             = $this->input->post('tgl_keluar');
        //$data['kelas']                  = $this->input->post('kelas');
        $data['nisn']                   = $this->input->post('nisn');
        //$data['asal_sekolah_alamat']    = $this->input->post('asal_sekolah_alamat');
        //$data['nmsaudara1']             = $this->input->post('nmsaudara1');
        //$data['nmsaudara2']             = $this->input->post('nmsaudara2');
        //$data['nmsaudara3']             = $this->input->post('nmsaudara3');
        //$data['nmsaudara4']             = $this->input->post('nmsaudara4');
        //$data['nmsaudara5']             = $this->input->post('nmsaudara5');
        //$data['nmsaudara6']             = $this->input->post('nmsaudara6');
        //$data['nmsaudara7']             = $this->input->post('nmsaudara7');
        //$data['tgllahirsaudara1']       = $this->input->post('tgllahirsaudara1');
        //$data['tgllahirsaudara2']       = $this->input->post('tgllahirsaudara2');                        
        //$data['tgllahirsaudara3']       = $this->input->post('tgllahirsaudara3');
        //$data['tgllahirsaudara4']       = $this->input->post('tgllahirsaudara4');
        //$data['tgllahirsaudara5']       = $this->input->post('tgllahirsaudara5');
        //$data['tgllahirsaudara6']       = $this->input->post('tgllahirsaudara6');
        //$data['tgllahirsaudara7']       = $this->input->post('tgllahirsaudara7');
        //$data['kegiatansaudara1']       = $this->input->post('kegiatansaudara1');
        //$data['kegiatansaudara2']       = $this->input->post('kegiatansaudara2');
        //$data['kegiatansaudara3']       = $this->input->post('kegiatansaudara4');
        //$data['kegiatansaudara4']       = $this->input->post('kegiatansaudara5');
        //$data['kegiatansaudara5']       = $this->input->post('kegiatansaudara6');
        //$data['kegiatansaudara6']       = $this->input->post('kegiatansaudara7');
        
        if ($trx=="db_add")
        {
            $data['nis']                  = $this->input->post('nis');
            if($this->siswa_model->getall($data['nis'])->num_rows()==0)
            {
                if($this->siswa_model->simpan($data))
                {
                    redirect('siswa/daftar');
                }
                else
                {
                    echo '<script type="text/javascript">alert("'."Gagal menyimpan data!".'");history.go(-1);</script>';
                }
            }
            else
            {
                echo '<script type="text/javascript">alert("'."Mohon periksa ulang, NIS sudah ada!".'");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_edit")
        {   
            if($this->siswa_model->update($this->input->post('nis'),$data))
            {
                redirect('siswa/daftar');
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal update!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_del")
        {
            if($this->siswa_model->hapus($this->uri->segment(4)))
            {
                redirect('siswa/daftar/');
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal hapus!");history.go(-1);</script>';
            }
        }
    }
    function cari($off=0)
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $this->load->library('pagination');
        $txtcari                    = ($this->input->post('submit')!='') ? $this->input->post('cari') : $this->session->userdata('txtcarisiswa');
        $this->session->set_userdata(array('txtcarisiswa'=>$txtcari));
        $data['txtcarisiswa']       = $this->session->userdata('txtcarisiswa');
        $limit                      = 40;
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
        $data['menu']               = $this->app_model->tampil_menu('File');
        $data['siswa']              = $this->siswa_model->get('',$this->session->userdata('kd_sekolah'),$limit,$off,$data['txtcarisiswa']);
        $this->load->view('siswa/pencarian',$data);
    }
    function export_to_pdf($kelas='0',$off=0)//membuat file pdf
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $this->load->library('pagination');
        $txtcari                    = ($this->input->post('submit')!='') ? $this->input->post('txtcari') : $this->session->userdata('txtcarisiswa');
        $this->session->set_userdata(array('txtcarisiswa'=>$txtcari));
        $data['txtcarisiswa']       = $this->session->userdata('txtcarisiswa');
        $data['kelas']              = $this->kelas_model->get('',$this->global['kd_sekolah']);
        $data['pilihkelas']         = str_replace('+',' ',$kelas);
        
        $limit                      = 40;
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
        $data['siswa']              = $this->siswa_model->get('',$this->session->userdata('kd_sekolah'),$data['pilihkelas'],$limit,$off,$data['txtcarisiswa']);
        $datapdf = $this->load->view('siswa/daftar',$data,true);
        
        $this->to_pdf->pdf_create($datapdf, 'memorial',true,'a4','potrait');
    }
    function daftarprint()
    {	
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'));
        $data['kelas']              = str_replace('+',' ',$this->uri->segment(3));
        $data['walikelas']          = $this->kelas_model->getwali($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'),$data['kelas']);
        //echo $this->db->last_query();
        $data['siswa']              = $this->siswa_model->getprintbykelas($data);
        $this->load->view('siswa/daftarprint',$data);        
    }
    function daftarprint_pdf()
    {	
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'));
        $data['kelas']              = str_replace('+',' ',$this->uri->segment(3));
        $data['walikelas']          = $this->kelas_model->getwali($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'),$data['kelas']);
        $data['siswa']              = $this->siswa_model->getprintbykelas($data);
        $datapdf = $this->load->view('siswa/daftarprint',$data,true);
        $this->to_pdf->pdf_create($datapdf, 'Siswa_perkelas',true,'a4','landscape');
    }
    function profile()
    {
        $data['nis']                = $this->uri->segment(3);
        $data['tgl']                = $this->siswa_model->gettgllahir($data['nis']);
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'));
        $data['data']               = $this->siswa_model->getall($data['nis']);
        $this->load->view('cetak/siswa_lengkap',$data);
    }
    function profile_pdf()
    {
        $data['nis']                = $this->uri->segment(3);
        $data['tgl']                = $this->siswa_model->gettgllahir($data['nis']);
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'));
        $data['data']               = $this->siswa_model->getall($data['nis']);
        $data['tgl_lhb']            = $this->app_model->get_tgl_lhb();
		
        foreach($data['data']->result() as $row)
        {
         $data['nm_lngkp'] = $row->nama_lengkap;
        }

        $html = $this->load->view('cetak/siswa',$data,true);
        $this->to_pdf->pdf_create($html,'Profile '.$data['nm_lngkp'],true,'a4','potrait');
    }
    function profilelengkap_pdf()
    {
        $data['nis']                = $this->uri->segment(3);
        $data['tgl']                = $this->siswa_model->gettgllahir($data['nis']);
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'));
        $data['data']               = $this->siswa_model->getall($data['nis']);
        
        $html = $this->load->view('cetak/siswa_lengkap',$data,true);
        $this->to_pdf->pdf_create($html,'profile_siswa',true,'a4','potrait');
    }

}

?>