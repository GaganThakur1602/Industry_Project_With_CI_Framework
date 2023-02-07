<?php
class Customer_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

  public function customer_details_submit()
  {
      
      $c_name = $this->input->post('name');
      $c_email = $this->input->post('email');
      $c_password = $this->input->post('password');
      $c_id = rand(100,99999);
      $hashed_password = password_hash($c_password, PASSWORD_DEFAULT);
      $data = array(
        'Customer_email'=>$c_email,
        'Customer_password'=>$hashed_password,
        'Customer_name'=>$c_name,
        'Customer_id'=>$c_id
      );
      $this->db->insert('customers',$data);
      $insert_id = $this->db->insert_id();
      return $insert_id;
  }
  public function check_customer_details()
  {
      $c_email = $this->input->post('c_email');
      $c_password = $this->input->post('c_password');
      $query = $this->db->get_where('customers', array('Customer_email' => $c_email));
      $rows = $query->row_array();
      if($rows){
        $password_hashed = $rows['Customer_password'];
        $verify = password_verify($c_password,$password_hashed);
        if($verify){
          return $query->row_array();
        }
        else{
          return NULL;
        }
      }
      else
      {
        return NULL;
      }
  }
  public function get_customer_tickets($c_id)
  {
      $query = $this->db->get_where('tickets', array('Customer_id' => $c_id));
      return $query->result();
  }
  public function customer_ticket_submit()
  {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          
        //Get file name to check wether there is an attachment or not
        $fileName = $_FILES['file']['name'];
        $fileType = $_FILES['file']['type'];
        $field = 'file';
        $fileNameNew = '';
        if ($fileName != '') {
          $fileNameNew = uniqid('', true). '.' . $fileType;
          $config['upload_path'] = 'Customer_uploads/';
          $config['allowed_types'] = 'gif|jpg|png|jpeg|jfif|docx|pdf|csv|xls|txt|svg';
          $config['max_size']	= '2048';
          $config['max_width']  = '0';
          $config['max_height']  = '0';
          $config['file_name']  = $fileNameNew;
          $this->load->library('upload', $config);
          $this->upload->data($field);
        }
          date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
          $time =date('Y-m-d H:i:s');
          $t_des = $this->input->post('ticket_description');
          $t_title =$this->input->post('ticket_title');
          $t_status = rand(1,5);
          $c_id = $this->session->userdata('c_id');

          $data = array(
            'Ticket_id'=>NULL,
            'Ticket_file'=>$fileNameNew,
            'Ticket_description'=>$t_des,
            'Ticket_title'=>$t_title,
            'Customer_id'=>$c_id,
            'Ticket_status'=>$t_status,
            'Time'=>$time
          );
          $this->db->insert('tickets',$data);
          $flag = $this->db->insert_id();
          //Above 2 lines produces below given query
          // $sql = "INSERT INTO `tickets` (`Ticket_id`, `Customer_id`, `Ticket_title` , `Ticket_description`, `Ticket_file` ,`Ticket_status`, `Time`) VALUES (NULL, '$c_id','$t_title', '$t_des', '$fileNameNew' , '$t_status', FROM_UNIXTIME($time))";
  
          if ($flag!=0) 
          {
            // if data successfully inserted in data base 
            //$sql = "SELECT `Ticket_id`,`Ticket_description` , `Ticket_status` , `Time`, `Ticket_file` FROM `tickets` where (Customer_id = $c_id AND Time=(select max(Time) from tickets WHERE Customer_id = $c_id))";
            //Next 2 lines produces above query
            $this->db->select('Ticket_id, Ticket_description, Ticket_status,Time,Ticket_file');
            $result = $this->db->get_where('tickets', array('Ticket_id' => $flag));

            if ($result) 
            {
              // if data successfully retrieved from data base 
              $rows = $result->result();
              return json_encode($rows);
            }
          } else 
          {
            //if not inserted what is the error 
            var_dump($flag);
            //echo "Error: <br>" . mysqli_error($conn);
          }
      }
  }
}