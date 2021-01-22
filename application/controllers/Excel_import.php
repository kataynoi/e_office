<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Excel_import extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("user_type") != 1)
            redirect(site_url("user/login"));
        $this->layout->setLeft("layout/left_admin");
        $this->layout->setLayout("admin_layout");
        //$this->load->model('Admin_hospital_model', 'crud');
        $this->load->model('excel_import_model');
        $this->load->library('excel');
    }

    function index()
    {
        $this->layout->view('excel_import/excel_import');
    }

    function fetch()
    {
        $data = $this->excel_import_model->select();
        $output = '
		<h3 align="center">Total Data - ' . $data->num_rows() . '</h3>
		<table class="table table-striped table-bordered">
			<tr>
				<th>Customer Name</th>
				<th>Address</th>
				<th>City</th>
				<th>Postal Code</th>
				<th>Country</th>
			</tr>
		';
        foreach ($data->result() as $row) {
            $output .= '
			<tr>
				<td>' . $row->CustomerName . '</td>
				<td>' . $row->Address . '</td>
				<td>' . $row->City . '</td>
				<td>' . $row->PostalCode . '</td>
				<td>' . $row->Country . '</td>
			</tr>
			';
        }
        $output .= '</table>';
        echo $output;
    }

    function import_fingerscan()
    {
        if (isset($_FILES["file_finger"]["name"])) {
            $path = $_FILES["file_finger"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            $data=array();
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {
                        $user_id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $date_work = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($worksheet->getCellByColumnAndRow(2, $row)->getValue()));
                        $sign_in = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $sign_out = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $exception = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $late = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        
                        $data[] = array(
                            'user_id' => $user_id,
                            'date_work' => $date_work,
                            'sign_in' => $sign_in,
                            'sign_out' => $sign_out,
                            'exception' => $exception,
                            'late' => $late
                    
                        );
                }
            }
            if(count($data)>0){$rs = $this->excel_import_model->update($data);}else{$rs=0;}
            echo $rs ? $rs:'0';
        }
    }
}
?>