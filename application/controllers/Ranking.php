<?php 

class Ranking extends CI_Controller {
    
    public function index ()
    {
        $companyId = $this->db
            ->where('id', $this->session->userdata('id'))
            ->select('company_id')
            ->get('coachee')
            ->row()
            ->company_id;

        // $data['ranks'] = $this->db
        //     ->order_by('due_date', 'asc')
        //     ->where('coachee.company_id', $companyId)
        //     ->join('coachee', 'tugas.user_id = coachee.id')
        //     ->get('tugas')
        //     ->result();

        $data['ranks'] = $this->db->query("SELECT *, SUM(penilaian.nilai) as total_nilai
            FROM penilaian 
            INNER JOIN coachee ON penilaian.user_id=coachee.id
            WHERE penilaian.company_id = $companyId
            GROUP BY penilaian.user_id
            ORDER BY SUM(penilaian.nilai) DESC")
            ->result();

        $count = $this->db
            ->where('user_id', $this->session->userdata('id'))
            ->get('penilaian')
            ->result();
            
        $data['count'] = count($count);
        $this->load->view('coachee/v_ranking', $data);
    } 

}


?>