<?php 

class tester extends CI_Controller {

    public function index ()
    {
		$checkSubmit  = $this->db->where('DATE_FORMAT(due_date, "%Y-%m-%d") =', date('Y-m-d'))->get('tugas')->result();
		$countSubmit = count($checkSubmit);

        echo json_encode($countSubmit);
        
    }
}

?>