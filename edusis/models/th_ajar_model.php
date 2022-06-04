<?php 
class Th_ajar_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function getall($kd='')
    {
        $sql        = " select * from th_ajar ";
        if($kd!='')
        {
            $sql    .= " where th_ajar = '$kd'";
        }
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function get($kd='',$limit='',$off='')
    {
        $this->db->select('*');
        $this->db->from('th_ajar');
        $this->db->join('ms_karyawan','th_ajar.nip=ms_karyawan.nip','left outer');
        if($kd!='')
        {
            $this->db->where('th_ajar',$kd);
        }
        $this->db->order_by('th_ajar');
        $this->db->limit($limit,$off);
        
        return $this->db->get();
//        $sql        = " SELECT * FROM th_ajar " ;
//        $sql        .= " LEFT OUTER JOIN ms_karyawan ON th_ajar.nip = ms_karywan.nip " ;
//        $sql        .= "  ";
    }
    function getkepsek($th_ajar)
    {   
        //$CI     = &get_instance();
        //$th_ajar= $CI->session->userdata('th_ajar');
        $sql    = " select * 
                    from th_ajar ta
                    left outer join ms_karyawan mk
                    on ta.nip = mk.nip
                    where th_ajar = '$th_ajar' ";
                    //echo $sql; die();
        $hasil  = $this->db->query($sql);
        return $hasil;
    }
    function simpan($data)
    {
        if($this->db->insert('th_ajar',$data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    function update($kd,$data)
    {
        $this->db->where('th_ajar',$kd);
        return $this->db->update('th_ajar',$data);
    }
    function hapus($kd)
    {
        $this->db->where('th_ajar',$kd);
        return $this->db->delete('th_ajar');
    }
    function get_th_aktif()
    {
        $this->db->from('sys_var');
        $this->db->where('sys_col','sth');
        return $this->db->get();
    }
    function set_th_aktif($th)
    {
        $array          = array('sys_val'=>$th);
        $this->db->where('sys_col','sth');
        return $this->db->update('sys_var',$array);
    }
    function set_smt_aktif($smt)
    {
        $array          = array('sys_val'=>$smt);
        $this->db->where('sys_col','smt');
        return $this->db->update('sys_var',$array);
    }
    function set_sid_aktif($sid)
    {
        $array          = array('sys_val'=>$sid);
        $this->db->where('sys_col','sid');
        return $this->db->update('sys_var',$array);
    }
    function set_sub_aktif($sub)
    {
        $array          = array('sys_val'=>$sub);
        $this->db->where('sys_col','sub');
        return $this->db->update('sys_var',$array);
    }
}

?>