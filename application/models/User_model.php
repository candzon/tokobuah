<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function getDataByJoin()
    {
        $this->db->select('*');
        $this->db->from('tb_user'); //ini sama dengan : SELECT * FROM tb_user
        $this->db->join('tb_role', 'tb_role.id_role = tb_user.id_role'); // ini sama dengan : SELECT * FROM tb_user JOIN tb_role ON tb_role.id_role = tb_user.id_role
        $this->db->join('tb_departement', 'tb_departement.id_dept = tb_user.id_dept'); // ini sama dengan : SELECT * FROM tb_user JOIN tb_dept ON tb_dept.id_dept = tb_user.id_dept
        $this->db->join('tb_jabatan', 'tb_jabatan.id_jabatan = tb_user.id_jabatan'); // ini sama dengan : SELECT * FROM tb_user JOIN tb_jabatan ON tb_jabatan.id_jabatan = tb_user.id_jabatan
        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file ModelName.php */
