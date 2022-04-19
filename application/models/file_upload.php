<?php 

class file_upload extends CI_Model {
    
    protected $table = 'file_upload';


    public function insert ($data)
    {
        $this->db->insert($this->table, $data);
    }

}
?>