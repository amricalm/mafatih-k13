<?php
class Exel extends CI_Controller{
    
    function __Construct()
    {
        parent::__Construct();
        $this->load->model('task_model');
        $this->load->model('kelas_model');
        $this->load->model('mp_model');
        $this->load->model('app_model');
        $this->load->library('to_pdf');
        
        $this->global['kd_sekolah']     = $this->session->userdata('kd_sekolah');
        $this->global['th_ajar']        = $this->session->userdata('th_ajar');
        if (!$this->app_model->is_login("")) {redirect('login/loggedout');}
    }
    function coba_baca_excel()
    {
        //if(!$this->app_model->is_login('Import','MenuBawah','y'))
        //{
        //    redirect('home');
        //}
        //$data                       = $this->app_model->general();
        //$data['halaman']            = 'import';
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Impor Nilai Dari Exel';
        $data['menu']               = $this->app_model->tampil_menu('Import');
        $data['kdmp']               = $this->mp_model->get_mpotorisasi($this->global['kd_sekolah']);
        $data['kelass']             = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
        $data['kdjenis_nilai']      = $this->mp_model->jn();
        $this->load->view('layout/index',$data);
    }
    function baca_excel()
    {
        //if(!$this->app_model->is_login('Proses','Import'))
        //{
        //    redirect('home');
        //}
        //$filename                   = basename($_FILES['file']['name']);
		$filename					= date('ymdHis').'-'.$this->session->userdata('user_id').'.xls';
        $separator                  = explode('/',$this->config->item('base_url'));
        $config['upload_path']      = $_SERVER['DOCUMENT_ROOT'].'\edusis_data'."";
        $target_path                = $config['upload_path'];
        $ourFileName                = $target_path.'\\'.$filename;
        if(file_exists($ourFileName))
        {
            unlink($ourFileName);
        }
        if(move_uploaded_file($_FILES['file']['tmp_name'],$ourFileName)) 
        {
            $ourFileHandle          = fopen($ourFileName, 'r') or die("can't open file");
            $dataFile               = file_get_contents($ourFileName, FILE_USE_INCLUDE_PATH);
        }
        include_once(APPPATH.'helpers/excel_reader2.php');
        $data                       = new Spreadsheet_Excel_Reader($ourFileName);
        $fields                     = array();
        $row                        = array();
        $j = 0;
        $k = 0;
        for($j=2;$j<$data->rowcount($sheet_index=0);$j++)
        {
            if($data->val($j,1)!='')
            {
                $fields[$k][$data->val(1,1)]    = $data->val($j,1);
                $fields[$k][1]['kd_tagihan']    = $data->val(1,2);
                $fields[$k][1]['kgn']    = $data->val($j,2);
                $fields[$k][1]['psk']    = $data->val($j,3);
                $fields[$k][2]['kd_tagihan']    = $data->val(1,4);
                $fields[$k][2]['kgn']    = $data->val($j,4);
                $fields[$k][2]['psk']    = $data->val($j,5);
                $fields[$k][3]['kd_tagihan']    = $data->val(1,6);
                $fields[$k][3]['kgn']    = $data->val($j,6);
                $fields[$k][3]['psk']    = $data->val($j,7);
                $fields[$k][4]['kd_tagihan']    = $data->val(1,8);
                $fields[$k][4]['kgn']    = $data->val($j,8);
                $fields[$k][4]['psk']    = $data->val($j,9);
                $fields[$k][5]['kd_tagihan']    = $data->val(1,10);
                $fields[$k][5]['kgn']    = $data->val($j,10);
                $fields[$k][5]['psk']    = $data->val($j,11);
                $fields[$k][6]['kd_tagihan']    = $data->val(1,12);
                $fields[$k][6]['kgn']    = $data->val($j,12);
                $fields[$k][6]['psk']    = $data->val($j,13);
                $fields[$k][7]['kd_tagihan']    = $data->val(1,14);
                $fields[$k][7]['kgn']    = $data->val($j,14);
                $fields[$k][7]['psk']    = $data->val($j,15);
                $k++;
            }
        }
        $input = array();
        for($i=0;$i<count($fields);$i++)
        {
            for($j=1;$j<count($fields[$i]);$j++)
            {
                $input['kd_sekolah']    = $this->session->userdata('kd_sekolah');
                $input['th_ajar']       = $this->session->userdata('th_ajar');
                $input['p_nl']          = $this->session->userdata('kd_semester');
                $input['kd_mp']         = $this->input->post('kd_mp');
                $input['kelas']         = $this->input->post('kelas');
                $input['nis']           = $fields[$i]['NIS'];
                $input['sub_pnl']       = $this->session->userdata('sub_pnl');
                $input['kd_tagihan']    = $fields[$i][$j]['kd_tagihan'];
                $input['kgn']           = $fields[$i][$j]['kgn'];
                $input['psk']           = $fields[$i][$j]['psk'];
                $input['afk']           = 0;
                $periksa = $this->task_model->periksa_Nilaisemua($input);
                if($periksa->num_rows()>0)
                {
                    $this->task_model->updateexelsemua($input);
                }
                else
                {
                    $this->task_model->simpanexelsemua($input);
                }
            }
        }
        echo '<script type="text/javascript">alert("Import Nilai Berhasil!!!");window.location="'.base_url().'index.php/hasilbelajar/rapor_uts/'.str_replace(' ','+',$this->input->post('kelas')).'/'.$this->input->post('kd_mp').'"</script>';
    }
}
?>