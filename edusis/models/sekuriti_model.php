<?php
class Sekuriti_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function insertgroup($data) 
    {	
        if($this->db->insert('sc_group',$data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function updategroup($kd, $data)
    {	        
        $this->db->where('kd_group',$kd);
        return $this->db->update('sc_group',$data);
    }
    
    function deletegroup($kd)
    {
        $this->db->where('kd_group',$kd);
        return $this->db->delete('sc_group');
    }
    function detlistUsergroup($kd='')
    {
        $sql        = " select * from sc_group";
        if($kd!='')
        {
            $sql    .= " where kd_group = '$kd'";
        }
        $hasil      = $this->db->query($sql);
        return $hasil;
    }

    function listUser()
    {
        $sql        = " SELECT nama_login, kode_group, ms_user.nama_lengkap, password, nm_group
                        from ms_user
                        left outer join sc_group
                        on ms_user.kode_group = sc_group.kd_group
                        order by nama_login";
        return $this->db->query($sql);
    }
    
    function insertuser($data) 
    {	
        if($this->db->insert('ms_user',$data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function updateuser($kd, $data)
    {	        
        $this->db->where('nama_login',$kd);
        return $this->db->update('ms_user',$data);
    }
    
    function deleteuser($kd)
    {
        $this->db->where('nama_login',$kd);
        return $this->db->delete('ms_user');
    }

    
    function detlistUser($kd='')
    {
        $sql        = " select * from ms_user";
        if($kd!='')
        {
            $sql    .= " where nama_login = '$kd'";
        }
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    
    function listUsergroup()
    {
        $this->db->select('*');
        $this->db->from('sc_group');
        $this->db->order_by('nm_group');
        return $this->db->get();
    }
    function updateUsergroup($groupkd, $fields)
    {	$sql = "update scusergroup set group_nama = '" . $fields['group_nama'] . "' where group_kd = ?";
            $this->db->query($sql,$groupkd);
            return TRUE;
    }

    function deleteUsergroup($groupkd)
    {	$sql = "update scusergroup set group_status = 1 where group_kd = ?";
            $this->db->query($sql,$groupkd);
            return TRUE;
    }
    function updateuser1($kd, $data)
    {	        
        $this->db->where('nama_login',$kd);
        return $this->db->update('ms_user',$data);
    }
    function updatepassword($kd,$data)
    {
        $this->db->where('nama_login',$kd);
        return $this->db->update('ms_user',$data);
    }
    function get_mp_belum($kd_sekolah,$kd_group,$kelas)
    {
        $this->db->select('*');
        $this->db->from('ms_mp');
        $this->db->where("kd_mp NOT IN (select kd_mp from sc_group_data where kd_group ='".$kd_group."' and kelas ='".$kelas."') and kd_sekolah='".$kd_sekolah."' order by urutan" )  ;
        
        return $this->db->get();
    }
    function get_mp_sudah($kd_sekolah,$kd_group,$kelas)
    {
        $sql = " SELECT *, nm_mp FROM sc_group_data a";
        $sql .= " INNER JOIN ms_mp b";
        $sql .= " ON a.kd_mp = b.kd_mp";
        $sql .= " WHERE kd_group = '$kd_group'";
        $sql .= " AND kelas = '$kelas' ORDER BY urutan";
        $query      = $this->db->query($sql);
        return $query;
    }
    function simpan_otorisasi($data)
    {
        return $this->db->insert('sc_group_data',$data);
    }
    function hapus_otorisasi($data)
    {
        $this->db->where('kd_group',$data['kd_group']);
        $this->db->where('kelas',$data['kelas']);
        $this->db->where('kd_mp',$data['kd_mp']);
        return $this->db->delete('sc_group_data');
    }
    function getkd_group($user_id)
    {
        $sql        = " select kd_group from ms_user
                        where nama_login= '$user_id'";
        $query      = $this->db->query($sql);
        return $query;
    }
    
}
?>