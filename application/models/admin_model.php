<?php
class Admin_model extends CI_Model
{
    public function __construct()
	{
		$this->load->database();
	}
    
    public function check_admin_details()
    {
        $a_email = $this->input->post('a_email');
        $a_password = $this->input->post('a_password');
        $query = $this->db->get_where('admins', array('Admin_email' => $a_email,'Admin_password'=>$a_password));
        return $query->row_array();
        
    }

    public function get_tickets_for_admin()
    {
        $status = 1;
        $query = $this->db->get_where('tickets',array('Ticket_status'=>$status));
        return $query->result();
    }
}
?>