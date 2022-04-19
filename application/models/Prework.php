<?php 

class Prework extends CI_Model {

    private $table = 'prework';

    public function insert_id($data)
    {
        $this->db->insert($this->table, $data);

        return $this->db->insert_id();
    }

    public function submitTugas($data)
    {   
       

        $this->db->insert('tugas', $data);

        return $this->db->insert_id();
    }
}


?>