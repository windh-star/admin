<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class BerandaController extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model("BerandaModel");
    }

	public function index()
	{
        $data['year_list'] = $this->BerandaModel->fetch_year();
		$data['root_menu'] = 'Master Data';
		$data['menu'] = 'Beranda';
    	$data['halaman'] = 'beranda/index';
        $this->load->view('layout', $data);
	}

	public function getTotalEstimator(){
	    $response = $this->BerandaModel->getTotalEstimator()->num_rows();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

	public function getTotalSuplier(){
	    $response = $this->BerandaModel->getTotalSuplier()->num_rows();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

	public function getTotalProyek(){
	    $response = $this->BerandaModel->getTotalProyek()->num_rows();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

	public function getGrafikProyek(){
	    $response = $this->BerandaModel->getGrafikProyek()->num_rows();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

	public function totalEstimator(){
        $response = $this->BerandaModel->totalEstimator()->row();
        $this->output
             ->set_status_header(201)
             ->set_output(json_encode($response, JSON_PRETTY_PRINT))
             ->_display();
        exit();
	}
	
	public function totalSuplier(){
        $response = $this->BerandaModel->totalSuplier()->row();
        $this->output
             ->set_status_header(201)
             ->set_output(json_encode($response, JSON_PRETTY_PRINT))
             ->_display();
        exit();
	}
	
	public function totalProyek(){
        $response = $this->BerandaModel->totalProyek()->row();
        $this->output
             ->set_status_header(201)
             ->set_output(json_encode($response, JSON_PRETTY_PRINT))
             ->_display();
        exit();
	}
	

// PROYEK Grafik

    public function TrenProyekAllTahun(){
        $response = $this->BerandaModel->TrenProyekAllTahun();
        $this->output
             ->set_status_header(201)
             ->set_output(json_encode($response, JSON_PRETTY_PRINT))
             ->_display();
        exit();
    }
    public function FilterTrenProyekTahun(){
     
        $response = $this->BerandaModel->FilterProyekTahun();
          $this->output
                  ->set_status_header(201)
                  ->set_output(json_encode($response, JSON_PRETTY_PRINT))
                  ->_display();
         exit();
     }
    
    ///perbulan dalam satu tahun
    public function TrenProyekPerBulan(){
        $response = 
            $this->BerandaModel->TrenProyekPerBulan();
        $this->output
             ->set_status_header(201)
             ->set_output(json_encode($response, JSON_PRETTY_PRINT))
             ->_display();
        exit();
    }
    ///filter proyek
    public function FilterTrenProyekPerBulan(){
        ///hilangkan %20
     //   $str = str_replace("%20", " ", $produk);
        $response = $this->BerandaModel->FilterTrenProyekPerBulan();
        
        $this->output
             ->set_status_header(201)
             ->set_output(json_encode($response, JSON_PRETTY_PRINT))
             ->_display();
        exit();
	}
	
	
//SUPLIER GRafik

	public function TrenSuplierAllTahun(){
        $response = $this->BerandaModel->TrenSuplierAllTahun();
        $this->output
             ->set_status_header(201)
             ->set_output(json_encode($response, JSON_PRETTY_PRINT))
             ->_display();
        exit();
    }
    public function FilterTrenSuplierTahun(){
     
        $response = $this->BerandaModel->FilterSuplierTahun();
          $this->output
                  ->set_status_header(201)
                  ->set_output(json_encode($response, JSON_PRETTY_PRINT))
                  ->_display();
         exit();
     }
    
    ///perbulan dalam satu tahun
    public function TrenSuplierPerBulan(){
        $response = 
            $this->BerandaModel->TrenSuplierPerBulan();
        $this->output
             ->set_status_header(201)
             ->set_output(json_encode($response, JSON_PRETTY_PRINT))
             ->_display();
        exit();
    }
    ///filter produk
    public function FilterTrenSuplierPerBulan(){
        ///hilangkan %20
     //   $str = str_replace("%20", " ", $produk);
        $response = $this->BerandaModel->FilterTrenSuplierPerBulan();
        
        $this->output
             ->set_status_header(201)
             ->set_output(json_encode($response, JSON_PRETTY_PRINT))
             ->_display();
        exit();
	}
	

//ESTIMATOR Grafik

public function TrenEstimatorAllTahun(){
	$response = $this->BerandaModel->TrenEstimatorAllTahun();
	$this->output
		 ->set_status_header(201)
		 ->set_output(json_encode($response, JSON_PRETTY_PRINT))
		 ->_display();
	exit();
}
public function FilterTrenEstimatorTahun(){
 
	$response = $this->BerandaModel->FilterEstimatorTahun();
	  $this->output
			  ->set_status_header(201)
			  ->set_output(json_encode($response, JSON_PRETTY_PRINT))
			  ->_display();
	 exit();
 }

///perbulan dalam satu tahun
public function TrenEstimatorPerBulan(){
	$response = 
		$this->BerandaModel->TrenEstimatorPerBulan();
	$this->output
		 ->set_status_header(201)
		 ->set_output(json_encode($response, JSON_PRETTY_PRINT))
		 ->_display();
	exit();
}
///filter produk
public function FilterTrenEstimatorPerBulan(){
	///hilangkan %20
 //   $str = str_replace("%20", " ", $produk);
	$response = $this->BerandaModel->FilterTrenEstimatorPerBulan();
	
	$this->output
		 ->set_status_header(201)
		 ->set_output(json_encode($response, JSON_PRETTY_PRINT))
		 ->_display();
	exit();
}



    ///Bulan ini
    public function TrenBulanIni(){
        $response = array(
            "total_count" => $this->BerandaModel->TrenBulanIni($this->input->get("tahun"), $this->input->get("bulan")
            )
        );
        $this->output
             ->set_status_header(201)
             ->set_output(json_encode($response, JSON_PRETTY_PRINT))
             ->_display();
        exit();
    }


    //GRAFIK BARU

    function grafikProyek()
    {
     $data['year_list'] = $this->BerandaModel->fetch_year();
     $this->load->view('dynamic_chart', $data);
    }
   
    function fetchDataProyek()
    {
     if($this->input->post('year'))
     {
      $chart_data = $this->BerandaModel->fetch_chart_data($this->input->post('year'));
      
      foreach($chart_data->result_array() as $row)
      {
       $output[] = array(
        'month'  => $row["month"],
        'total' => floatval($row["total"])
       );
      }
      echo json_encode($output);
     }
    }

    function fetchDataEstimator()
    {
     if($this->input->post('year'))
     {
      $chart_data = $this->BerandaModel->fetch_chart_data_estimator($this->input->post('year'));
      
      foreach($chart_data->result_array() as $row)
      {
       $output[] = array(
        'month'  => $row["month"],
        'total' => floatval($row["total"])
       );
      }
      echo json_encode($output);
     }
    }

    function fetchDataSuplier()
    {
     if($this->input->post('year'))
     {
      $chart_data = $this->BerandaModel->fetch_chart_data_suplier($this->input->post('year'));
      
      foreach($chart_data->result_array() as $row)
      {
       $output[] = array(
        'month'  => $row["month"],
        'total' => floatval($row["total"])
       );
      }
      echo json_encode($output);
     }
    }
}