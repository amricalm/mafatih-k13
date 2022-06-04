<?php 

class Nilai_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get($kd='',$limit='',$off='')
    {
        $this->db->select('*');
        $this->db->from('ms_siswa');
        if($kd!='')
        {
            $this->db->where('nis',$kd);
        }
        $this->db->order_by('nis,nama_lengkap');
        $this->db->limit($limit,$off);
        
        return $this->db->get();
    }
    function simpan($data)
    {
        if($this->db->insert('t_nilai',$data))
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
        $this->db->where('nis',$kd);
        return $this->db->update('ms_siswa',$data);
    }
    function hapus($where)
    {
        $this->db->where('semester',$where['semester']);
        $this->db->where('th_ajar',$where['th_ajar']);
        $this->db->where('nis',$where['nis']);
        return $this->db->delete('t_nilai');
    }
    function get_nilai_nis($kd_sekolah,$th_ajar,$nis,$semester,$kd_mp='')
    {
//SELECT a.kd_mp,a.kd_sekolah,nm_mp,nilai
//FROM ms_mp a
//LEFT OUTER JOIN t_nilai b ON b.kd_sekolah=a.kd_sekolah AND b.kd_mp=a.kd_mp AND nis='01'
//WHERE a.kd_sekolah = '02'
        $thajar     = ($th_ajar!='') ? ' AND b.th_ajar ='."'$th_ajar'" : '';
        $this->db->select('a.kd_mp,nm_mp,nilai');
        $this->db->from('ms_mp a',false);
        $this->db->join('t_nilai b','b.kd_sekolah=a.kd_sekolah and b.kd_mp=a.kd_mp and nis='."'$nis' and semester = '$semester'".$thajar,'left outer');
        $this->db->where('a.kd_sekolah',$kd_sekolah);
        if($kd_mp!='')
        {
            $this->db->where('a.kd_mp',$kd_mp);
        }
        $this->db->order_by('nm_mp');
        return $this->db->get();
    }
}

?>