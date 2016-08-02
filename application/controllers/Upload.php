<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller
{
	public function  __construct() 
	{
		parent::__construct();
		$this->load->model('arquivo_model');
	}
	
	public function index(){

		$data = array();

		if($this->input->post('fileSubmit') && !empty($_FILES['userFiles']['name'])){

			$filesCount = count($_FILES['userFiles']['name']);

			for($i = 0; $i < $filesCount; $i++){

				$_FILES['userFile']['name'] = md5($_FILES['userFiles']['name'][$i].date('Y-m-d H:i:s')).'.jpg';
				$_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
				$_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
				$_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
				$_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];

				$uploadPath = 'uploads/files/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'gif|jpg|png';
				//$config['max_size']	= '100';
				//$config['max_width'] = '1024';
				//$config['max_height'] = '768';
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if($this->upload->do_upload('userFile')){

					$fileData = $this->upload->data();
					$uploadData[$i]['file_name'] = $fileData['file_name'];
					$uploadData[$i]['created'] = date("Y-m-d H:i:s");
					$uploadData[$i]['modified'] = date("Y-m-d H:i:s");

				}
			}

			if(!empty($uploadData)){
				
				// Insere os arquivos no banco de dados
				$insert = $this->arquivo_model->insert($uploadData);
				$statusMsg = $insert?'Files uploaded successfully.':'Some problem occurred, please try again.';
				$this->session->set_flashdata('statusMsg', $statusMsg);
			}

		}

		// Busca os arquivos no banco de dados
        $data['files'] = $this->arquivo_model->getRows();

		// Envia os arquivos para a view
		$this->load->view('index', $data);

	}

}