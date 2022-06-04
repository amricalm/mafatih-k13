<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class login_init
{

    function login_init()
    {
            $this->obj =& get_instance();
    }

    function is_login($role)
    {
        if ($this->obj->session) {
            //If user has valid session, and such is logged in
            if ($this->obj->session->userdata('logged_in') && $role!="")
            {
                    if ($this->obj->session->userdata('user_role'))
                    {
                        $roles = explode("#",$this->obj->session->userdata('user_role'));
                        foreach ($roles as &$roleset)
                        {
                                if ($roleset==$role) { return true; break;}
                        }
                    }
                    else
                    {
                        return false;
                    }
            }
            elseif ($this->obj->session->userdata('logged_in'))
            {
                return true;
            }
            else            
            {
                return false;
            }

        }
        else
        {
            return false;
        }
    } 

    function login_proses()
    {
            //Initialise the Encryption Library
            $this->obj->load->library('encrypt');

            //Make the input username and password into variables
            $password = $this->obj->input->post('user_pass');
            $username = $this->obj->input->post('user_login');

            //Use the input username and password and check against 'users' table
            $sql = "select nama_login, nama_lengkap, usr.kode_group, grp.sys_admin, password
                    from ms_user usr 
                    inner join sc_group grp 
                        on usr.kode_group = grp.kd_group 
                    where nama_login = ? ";
                    
            $query = $this->obj->db->query($sql,array($username));
            $login_result = false;
            if ($query->num_rows() > 0)
            {
                $row = $query->row();
                if ($row->password == $password)
//                if ($this->obj->encrypt->decode("$row->usr_password") == $password)
                {
                    $login_result   = true;
                    $id             = $row->nama_login;
                    $idname         = $row->nama_lengkap;
                    $group          = $row->kode_group;
                    $sys_admin      = $row->sys_admin;
                    $btu            = "";
                    $query->free_result();

                    //Daftar Autentikasi Role Group
//                    $sql = "select sco.sc_role, scr.role_nm from scobject sco ";
//                    $sql .= "inner join scuser scu on sco.sc_group = scu.usr_group ";
//                    $sql .= "inner join scusergrouprole scr on sco.sc_role = role_kd where scu.usr_kd = ? ";
//                    $query = $this->obj->db->query($sql,array($username));		
//                    $role = "";
//                    if ($query->num_rows() > 0)
//                    {
//                            foreach($query->result() as $row)
//                            {
//                                $role .= $row->role_nm . "#";
//                            }
//                            $role = substr($role,0,strlen($role)-1);
//                    }
//                    $query->free_result();
                    
                    $this->obj->db->select('*');
                    $this->obj->db->from('sys_var');
                    $this->obj->db->where('sys_col','sid');
                    $kd_sekolah     = $this->obj->db->get()->row()->sys_val;
                    
                    $this->obj->db->select('*');
                    $this->obj->db->from('sys_var');
                    $this->obj->db->where('sys_col','sth');
                    $th_ajar        = $this->obj->db->get()->row()->sys_val;
                    
                    $this->obj->db->select('*');
                    $this->obj->db->from('sys_var');
                    $this->obj->db->where('sys_col','smt');
                    $kd_semester    = $this->obj->db->get()->row()->sys_val;
                    
                    $this->obj->db->select('*');
                    $this->obj->db->from('sys_var');
                    $this->obj->db->where('sys_col','sid');
                    $kd_sekolah     = $this->obj->db->get()->row()->sys_val;
                    
                    $this->obj->db->select('*');
                    $this->obj->db->from('sys_var');
                    $this->obj->db->where('sys_col','sub');
                    $sub_pnl        = $this->obj->db->get()->row()->sys_val;
                }
            }
            
            //If username and password match set the logged in flag in 'ci_sessions'
            if ($login_result)
            {
                $credentials = array('user_id' => $id, 'logged_in' => $login_result, 'user_name'=>$idname, 'kode_group'=>$group, 'sys_admin'=>$sys_admin);
                $this->obj->session->set_userdata('user_id',$credentials['user_id']);
                $this->obj->session->set_userdata('logged_in',$credentials['logged_in']);
                $this->obj->session->set_userdata('user_name',$credentials['user_name']);
                $this->obj->session->set_userdata('kode_group',$credentials['kode_group']);
                $this->obj->session->set_userdata('sys_admin',$credentials['sys_admin']);
                
                $this->obj->session->set_userdata('kd_sekolah',$kd_sekolah);
                $this->obj->session->set_userdata('th_ajar',$th_ajar);
                $this->obj->session->set_userdata('kd_semester',$kd_semester);
                $this->obj->session->set_userdata('kd_sekolah',$kd_sekolah);
                $this->obj->session->set_userdata('sub_pnl',$sub_pnl);
                redirect('home');
            }
            else
            {
               redirect('login');
            }
    }

}
?>