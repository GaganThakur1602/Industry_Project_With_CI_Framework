<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    public function session_check($sess)
    {
        if($sess == TRUE){
            if($this->session->userdata('user_name')=='' || $this->session->userdata('is_logged_in')==FALSE)
            {
                //if user should be logged in but is not logged in redirect to login page 
                redirect('service/index');
            }

        }
        else{
            
            if($this->session->userdata('is_logged_in')==TRUE)
            {
                //if user should be logged and trying to go to login page prevent him to do so
                redirect('service/customer_ticket_view');
            }
        }

    }
    public function session_check_admin($sess)
    {
        if($sess == TRUE){
            if($this->session->userdata('admin_name')=='' || $this->session->userdata('is_logged_in_as_admin')==FALSE)
            {
                //if user should be logged in but is not logged in redirect to login page 
                redirect('service/admin_login_view');
            }

        }
        else{
            
            if($this->session->userdata('is_logged_in_as_admin')==TRUE)
            {
                //if user should be logged and trying to go to login page prevent him to do so
                redirect('service/admin_ticket_view');
            }
        }

    }
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }
    public function index()
	{

        //Controller for index.php page
        //$this->load->library('session');
        // $this->session->set_userdata(array('user_name' =>'', 'is_logged_in' =>FALSE));
        $this->session_check(FALSE);
        $this->load->library('form_validation'); 
		$this->load->view('index_header');
		$this->load->view('home');
		$this->load->view('footer');
	}
    public function customer_validation()
    {
        //validates the customer when they log in
        $this->load->helper('form');
        //$this->load->library('session');
	    $this->load->library('form_validation'); 
        //form validation rules   
        $this->form_validation->set_rules('c_email', 'Email', 'required');
	    $this->form_validation->set_rules('c_password', 'Password', 'required');
        if ($this->form_validation->run() === FALSE)
        {
            //if the form validtion runs as false, redirecrt to index page where customer can try again 
            $this->load->view('index_header');
            $this->load->view('home');
            $this->load->view('footer');
        }
        else
        {
            //if the form validtion runs as true redirect to customer ticket view page where they can see their tickets or submmit a new ticket  
            $this->load->model('customer_model'); 
            $data = $this->customer_model->check_customer_details();
            if ($data){
                //setting username as session username to 
                $this->session->set_userdata('c_id', $data['Customer_id']);
                $this->session->set_userdata(array('user_name' => $data['Customer_name'], 'is_logged_in' => TRUE));
                redirect('service/customer_ticket_view');
            }
            else
            {
                //if customer does no exist in the database
                echo "<br>Please sign up <a href='service/customer_sign_up'>HERE</a>" ;
            }
        }
    }
    public function customer_ticket_view()
    {   
        $this->session_check(TRUE);
        //supplying customer_id as a parameter to a model function
        $c_id = $this->session->userdata('c_id');
        $this->load->model('customer_model'); 
        $ticket_data = $this->customer_model->get_customer_tickets($c_id);
        //get tickets data and make a associative array of it so it can be passed onto a view
        $x = array('tickets'=>$ticket_data) ;
        $this->load->view('header');
        $this->load->view('customer_ticket_view',$x);

    }
    public function customer_sign_up()
    {
        $this->session_check(FALSE);
        //loads the customer sign up page
        $this->load->helper('form');
	    $this->load->library('form_validation');
        $this->load->view('signup_header.php');
        $this->load->view('customer_sign_up');
    }

    public function customer_details_submit()
    {
        $this->session_check(FALSE);
        //Submits the details obtained by Customer sign up page to be submitted to database
        $this->load->helper('form');
        //$this->load->library('session');
	    $this->load->library('form_validation');    
        //form validation on signup page
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
	    $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('re_pass', 'Password Confirmation', 'required|matches[password]');
        
        if ($this->form_validation->run() === FALSE)
        {
            //if the form validation fails Load the page once again and show validation errors 
            $this->load->view('customer_sign_up');
            
        }
        else
        {
            //Goes to success page where user must further login to continue submitting their ticket
            $this->load->model('customer_model'); 
            $data = $this->customer_model->customer_details_submit();
            if($data)
            {
                $this->load->view('success');
            }
        }

    }

    public function customer_ticket_submit()
    {
        $this->session_check(TRUE);
        //Submits a ticket to the database 
        $this->load->model('customer_model');
        $data = $this->customer_model->customer_ticket_submit();
        echo $data; // This is for xhr request the data echoed is returned as response text to xhr request
    }

    public function customer_attachment_view()
    {
        $this->session_check(TRUE);
        $ticket_filename = $this->input->post('ticket_filename');
        $x = array('name'=>$ticket_filename);
        //supply ticket filname to the view so that it can be fetched from the folder on viewing
        $this->load->view('customer_attachment_view',$x);
    }

    public function admin_login_view()
    {
        $this->session_check_admin(FALSE);
        //$this->load->library('session');
	    $this->load->library('form_validation');    
        $this->session->set_userdata(array('is_admin' =>TRUE));
        $this->session->set_userdata(array('to_admin_login' =>FALSE));
        // echo "This is working";
        $this->load->view('index_header');
        $this->load->view('admin_login_view');
    }

    public function admin_validation()
    {
        $this->load->helper('form');
        //$this->load->library('session');
	    $this->load->library('form_validation');    
        $this->form_validation->set_rules('a_email', 'Email', 'required');
	    $this->form_validation->set_rules('a_password', 'Password', 'required');
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('index_header');
            $this->load->view('admin_login_view');
        }
        else
        {
         
            $this->load->model('admin_model'); 
            $data = $this->admin_model->check_admin_details();
            // echo $data['Customer_id'];
            if ($data){
                $this->session->set_userdata(array('admin_name' => $data['Admin_name'], 'is_logged_in_as_admin' => TRUE));
                redirect('service/admin_ticket_view');
            }
            else
            {
                echo "<br>Your Access has been revoked or removed";
            }
        }  
    }
    public function admin_ticket_view()
    {
        $this->session_check_admin(TRUE);
        $this->load->model('admin_model'); 
        $ticket_data = $this->admin_model->get_tickets_for_admin();
        $x = array('tickets'=>$ticket_data) ;
        $this->load->view('header');
        $this->load->view('admin_ticket_view',$x);
    }
    public function admin_attachment_view()
    {
        $this->session_check_admin(TRUE);
        $ticket_filename = $this->input->post('ticket_filename');
        $x = array('name'=>$ticket_filename);
        // $this->load->view('header');
        $this->load->view('admin_attachment_view',$x);
    }

    public function success()
    {
        $this->load->view('success');
    }

    public function logout()
    {
        //$this->load->library('session');
        $this->session->sess_destroy();
        // null the session (just in case):   
        redirect('service/');
    }
}
/* End of file service.php */
/* Location: ./application/controllers/service.php */