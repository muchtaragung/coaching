<?php 

class PDF extends CI_Controller {


    public function index ()
    
    {
        $this->load->library('pdfgenerator');
        
        $this->data['title_pdf'] = 'Laporan User';
        
        $file_pdf = 'Report User';

        $paper = 'A4';

        $orientation = "portrait";
        
		$html = $this->load->view('report/coachee', $this->data, true);	    
        

        
        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
    }
}

?>