<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
        $this->load->model("dashboard/Common_model");
        $this->load->model("dashboard/User_model");
        $this->load->model("Shared_model");
	}


    //============================ Get API Key
    private function api_key()
    {
        //Get API Key from api_table
        $query = $this->db->query("Select *
				FROM api_table
				WHERE (api_id = 1) AND (api_status = 1)");

        if ($query->num_rows() > 0) {
            $api_key = $this->encrypt->decode($query->result()[0]->api_key);
            return $api_key;
        }
    }


    //============================ Get main categories
	public function get_main_categories()
	{
        if (isset($_GET['api_key']))
        {
            $access_key_received = $_GET['api_key'];
            if ($access_key_received == $this->api_key()) {
                //Show Json
                $category_status = 1; //Active status
                $q = $this->db->query("Select category_id, category_title, category_image
				FROM category_table
				WHERE (category_status = $category_status AND category_parent_id = 0) 
				ORDER BY category_order ASC;");
                if ($q->num_rows() == 0)
                    echo $this->lang->line("Nothing Found...");
                else
                    echo json_encode($q->result(), JSON_UNESCAPED_UNICODE);

            }else{
                echo $this->lang->line("The API Key is Invalid!");
            }
        }
	}


    //============================ Get sub categories
    public function get_sub_categories($parnet_id="1")
    {
        if (isset($_GET['api_key']))
        {
            $access_key_received = $_GET['api_key'];
            if ($access_key_received == $this->api_key()) {
                //Show Json
                $category_status = 1; //Active status
                $q = $this->db->query("Select category_id, category_title, category_image
				FROM category_table
				WHERE (category_status = $category_status AND category_parent_id = $parnet_id) 
				ORDER BY category_order ASC;");
                if ($q->num_rows() == 0)
                    echo $this->lang->line("Nothing Found...");
                else
                    echo json_encode($q->result(), JSON_UNESCAPED_UNICODE);

            }else{
                echo $this->lang->line("The API Key is Invalid!");
            }
        }
    }


    //============================ Get one page
    public function get_one_page($page_id="1")
    {
        if (isset($_GET['api_key']))
        {
            $access_key_received = $_GET['api_key'];
            if ($access_key_received == $this->api_key())
            {
                //Show Json
                $q = $this->db->query("Select *
                                        FROM page_table
                                        WHERE page_id = $page_id;");
                if ($q->num_rows() == 0)
                    echo $this->lang->line("Nothing Found...");
                else
                    //echo json_encode($q->result(), JSON_UNESCAPED_UNICODE);
                    echo json_encode($q->result(), JSON_UNESCAPED_UNICODE);
            }
            else
                echo $this->lang->line("The API Key is Invalid!");
        }
    }


    //=================================================================================//
    public function get_sliders()
    {

        if (isset($_GET['api_key']))
        {
            $access_key_received = $_GET['api_key'];
            if ($access_key_received == $this->api_key())
            {
                //Show Json
                $slider_status = 1; //Active status
                $q = $this->db->query("Select *
				                        FROM slider_table
				                        WHERE (slider_status = $slider_status) 
				                        ORDER BY slider_id ASC;");
                if ($q->num_rows() == 0)
                    echo $this->lang->line("Nothing Found...");
                else
                    echo json_encode($q->result(), JSON_UNESCAPED_UNICODE);
            }
            else
                echo $this->lang->line("The API Key is Invalid!");
        }
    }


    //=================================================================================//
	public function get_last_content()
	{
        if (isset($_GET['api_key'])) {
            $access_key_received = $_GET['api_key'];
            if ($access_key_received == $this->api_key()) {
                // Show Json
                $last_id = $_GET['last_id'];
                $limit = $_GET['limit'];
                $content_status = 1; // 0: Inactive | 1: Active | 2: Expired

                // *** FirstLoad ***
                if ($last_id == 0)
                {
                    $q = $this->db->query("Select content_table.content_id, content_table.content_title, content_table.content_price, content_table.content_type_id, content_table.content_access, content_table.content_user_role_id, 
                                              content_table.content_image, content_table.content_duration, content_table.content_viewed, content_table.content_liked, content_table.content_publish_date, content_table.content_featured, 
                                              content_table.content_special, content_table.content_orientation, content_table.content_url,
                                              category_table.category_title,
                                              content_type_table.content_type_title
                                FROM content_table
                                INNER JOIN category_table
                                ON content_table.content_category_id = category_table.category_id
                                INNER JOIN content_type_table
                                ON content_table.content_type_id = content_type_table.content_type_id
								WHERE (content_status = $content_status)
								ORDER BY content_id DESC
								LIMIT $limit;");
                    if ($q->num_rows() == 0)
                        echo $this->lang->line("Nothing Found...");
                    else
                        echo json_encode($q->result(), JSON_UNESCAPED_UNICODE);

                }else{ // *** LoadMore ***
                    $q = $this->db->query("Select content_table.content_id, content_table.content_title, content_table.content_price, content_table.content_type_id, content_table.content_access, content_table.content_user_role_id, 
                                              content_table.content_image, content_table.content_duration, content_table.content_viewed, content_table.content_liked, content_table.content_publish_date, content_table.content_featured, 
                                              content_table.content_special, content_table.content_orientation, content_table.content_url,
                                              category_table.category_title,
                                              content_type_table.content_type_title
                                FROM content_table
                                INNER JOIN category_table
                                ON content_table.content_category_id = category_table.category_id
                                INNER JOIN content_type_table
                                ON content_table.content_type_id = content_type_table.content_type_id
								WHERE (content_status = $content_status) AND (content_id < $last_id)
								ORDER BY content_id DESC
								LIMIT $limit;");
                    if ($q->num_rows() == 0)
                        echo $this->lang->line("Nothing More Found...");
                    else
                        echo json_encode($q->result(), JSON_UNESCAPED_UNICODE);
                }


            }else{
                // API key is invalid
                echo $this->lang->line("The API Key is Invalid!");
            }
        }
	}


    //=================================================================================//
    public function get_featured_content()
    {
        if (isset($_GET['api_key'])) {
            $access_key_received = $_GET['api_key'];
            if ($access_key_received == $this->api_key()) {
                // Show Json
                $last_id = $_GET['last_id'];
                $limit = $_GET['limit'];
                $content_status = 1; // 0: Inactive | 1: Active | 2: Expired

                // *** FirstLoad ***
                if ($last_id == 0)
                {
                    $q = $this->db->query("Select content_table.content_id, content_table.content_title, content_table.content_price, content_table.content_type_id, content_table.content_access, content_table.content_user_role_id, 
                                              content_table.content_image, content_table.content_duration, content_table.content_viewed, content_table.content_liked, content_table.content_publish_date, content_table.content_featured, 
                                              content_table.content_special, content_table.content_orientation, content_table.content_url,
                                              category_table.category_title,
                                              content_type_table.content_type_title
                                FROM content_table
                                INNER JOIN category_table
                                ON content_table.content_category_id = category_table.category_id
                                INNER JOIN content_type_table
                                ON content_table.content_type_id = content_type_table.content_type_id
								WHERE (content_status = $content_status) AND (content_featured = 1)
								ORDER BY content_id DESC
								LIMIT $limit;");
                    if ($q->num_rows() == 0)
                        echo $this->lang->line("Nothing Found...");
                    else
                        echo json_encode($q->result(), JSON_UNESCAPED_UNICODE);

                }else{ // *** LoadMore ***
                    $q = $this->db->query("Select content_table.content_id, content_table.content_title, content_table.content_price, content_table.content_type_id, content_table.content_access, content_table.content_user_role_id, 
                                              content_table.content_image, content_table.content_duration, content_table.content_viewed, content_table.content_liked, content_table.content_publish_date, content_table.content_featured, 
                                              content_table.content_special, content_table.content_orientation, content_table.content_url,
                                              category_table.category_title,
                                              content_type_table.content_type_title
                                FROM content_table
                                INNER JOIN category_table
                                ON content_table.content_category_id = category_table.category_id
                                INNER JOIN content_type_table
                                ON content_table.content_type_id = content_type_table.content_type_id
								WHERE (content_status = $content_status) AND (content_featured = 1) AND (content_id < $last_id)
								ORDER BY content_id DESC
								LIMIT $limit;");
                    if ($q->num_rows() == 0)
                        echo $this->lang->line("Nothing More Found...");
                    else
                        echo json_encode($q->result(), JSON_UNESCAPED_UNICODE);
                }

            }else{
                // API key is invalid
                echo $this->lang->line("The API Key is Invalid!");
            }
        }
    }


    //=================================================================================//
    public function get_content_by_category_No_Load_More($limit="40", $category_id="1")
    {
        if (isset($_GET['api_key'])) {
            $access_key_received = $_GET['api_key'];
            if ($access_key_received == $this->api_key()) {
                // Show Json
                $content_status = 1; // 0: Inactive | 1: Active | 2: Expired
                $q = $this->db->query("Select content_table.content_id, content_table.content_title, content_table.content_price, content_table.content_type_id, content_table.content_access, content_table.content_user_role_id, 
                                              content_table.content_image, content_table.content_duration, content_table.content_viewed, content_table.content_liked, content_table.content_publish_date, content_table.content_featured, 
                                              content_table.content_special, content_table.content_orientation, content_table.content_url,
                                              category_table.category_title,
                                              content_type_table.content_type_title
                                FROM content_table
                                INNER JOIN category_table
                                ON content_table.content_category_id = category_table.category_id
                                INNER JOIN content_type_table
                                ON content_table.content_type_id = content_type_table.content_type_id
								WHERE (content_status = $content_status) AND (content_category_id = $category_id)
								ORDER BY content_id DESC
								LIMIT $limit;");
                if ($q->num_rows() == 0)
                    echo $this->lang->line("Nothing Found...");
                else
                    echo json_encode($q->result(), JSON_UNESCAPED_UNICODE);
            }else{
                // API key is invalid
                echo $this->lang->line("The API Key is Invalid!");
            }
        }
    }


    //=================================================================================//
    public function get_content_by_category()
    {
        if (isset($_GET['api_key'])) {
            $access_key_received = $_GET['api_key'];
            if ($access_key_received == $this->api_key()) {
                // Show Json
                if(isset($_GET['category_id'])) $category_id = $_GET['category_id'];
                if(isset($_GET['last_id'])) $last_id = $_GET['last_id'];
                if(isset($_GET['limit'])) $limit = $_GET['limit'];
                $content_status = 1; // 0: Inactive | 1: Active | 2: Expired

                // *** FirstLoad ***
                if ($last_id == 0)
                {
                    $q = $this->db->query("Select content_table.content_id, content_table.content_title, content_table.content_price, content_table.content_type_id, content_table.content_access, content_table.content_user_role_id, 
                                              content_table.content_image, content_table.content_duration, content_table.content_viewed, content_table.content_liked, content_table.content_publish_date, content_table.content_featured, 
                                              content_table.content_special, content_table.content_orientation, content_table.content_url,
                                              category_table.category_title,
                                              content_type_table.content_type_title
                                FROM content_table
                                INNER JOIN category_table
                                ON content_table.content_category_id = category_table.category_id
                                INNER JOIN content_type_table
                                ON content_table.content_type_id = content_type_table.content_type_id
								WHERE (content_status = $content_status) AND (content_category_id = $category_id)
								ORDER BY content_id DESC
								LIMIT $limit;");
                    if ($q->num_rows() == 0)
                        echo $this->lang->line("Nothing Found...");
                    else
                        echo json_encode($q->result(), JSON_UNESCAPED_UNICODE);

                }else{// *** LoadMore ***
                    $q = $this->db->query("Select content_table.content_id, content_table.content_title, content_table.content_price, content_table.content_type_id, content_table.content_access, content_table.content_user_role_id, 
                                              content_table.content_image, content_table.content_duration, content_table.content_viewed, content_table.content_liked, content_table.content_publish_date, content_table.content_featured, 
                                              content_table.content_special, content_table.content_orientation, content_table.content_url,
                                              category_table.category_title,
                                              content_type_table.content_type_title
                                FROM content_table
                                INNER JOIN category_table
                                ON content_table.content_category_id = category_table.category_id
                                INNER JOIN content_type_table
                                ON content_table.content_type_id = content_type_table.content_type_id
								WHERE (content_status = $content_status) AND (content_category_id = $category_id) AND (content_id < $last_id)
								ORDER BY content_id DESC
								LIMIT $limit;");
                    if ($q->num_rows() == 0)
                        echo $this->lang->line("Nothing More Found...");
                    else
                        echo json_encode($q->result(), JSON_UNESCAPED_UNICODE);
                }

            }else{
                // API key is invalid
                echo $this->lang->line("The API Key is Invalid!");
            }
        }
    }


    //=================================================================================//
    public function get_one_content($content_id="")
    {
        if (isset($_GET['api_key'])) {
            $access_key_received = $_GET['api_key'];
            if ($access_key_received == $this->api_key()) {
                // Show Json
                $content_status = 1; // 0: Inactive | 1: Active | 2: Expired
                $q = $this->db->query("Select content_table.*, category_table.category_title
                                FROM content_table
                                INNER JOIN category_table
                                ON content_table.content_category_id = category_table.category_id
                                WHERE (content_status = $content_status AND content_id = $content_id);");
                if ($q->num_rows() == 0)
                {
                    echo $this->lang->line("Nothing Found...");
                }
                echo json_encode($q->result(), JSON_UNESCAPED_UNICODE);
            }else{
                // API key is invalid
                echo $this->lang->line("The API Key is Invalid!");
            }
        }
    }


    //=================================================================================//
    public function total_content_viewed()
    {
        if (isset($_GET['api_key'])) {
            $access_key_received = $_GET['api_key'];
            if ($access_key_received == $this->api_key()) {
                // API key is correct
                $this->form_validation->set_rules('content_id', 'content_id', 'trim|required|xss_clean');
                if ($this->form_validation->run() == FALSE) {
                    //error
                } else {
                    //Update total view +1
                    $content_id = $this->input->post('content_id');
                    $this->db->query("UPDATE content_table SET content_viewed = content_viewed + 1 WHERE content_id = '$content_id'");
                }
            }else{
                // API key is invalid
                echo $this->lang->line("The API Key is Invalid!");
            }
        }
    }


    //=================================================================================//
    public function get_content_by_search()
    {
        if (isset($_GET['api_key'])) {
            $access_key_received = $_GET['api_key'];
            if ($access_key_received == $this->api_key()) {
                // Show Json
                if(isset($_GET['keyword'])) $keyword = $_GET['keyword'];
                if(isset($_GET['last_id'])) $last_id = $_GET['last_id'];
                if(isset($_GET['limit'])) $limit = $_GET['limit'];
                $content_status = 1; // 0: Inactive | 1: Active | 2: Expired

                // *** FirstLoad ***
                if ($last_id == 0)
                {
                    $q = $this->db->query("Select content_table.content_id, content_table.content_title, content_table.content_price, content_table.content_type_id, content_table.content_access, content_table.content_user_role_id, 
                                              content_table.content_image, content_table.content_duration, content_table.content_viewed, content_table.content_liked, content_table.content_publish_date, content_table.content_featured, 
                                              content_table.content_special, content_table.content_orientation, content_table.content_url,
                                              category_table.category_title,
                                              content_type_table.content_type_title
				                FROM content_table
                                INNER JOIN category_table
                                ON content_table.content_category_id = category_table.category_id
                                INNER JOIN content_type_table
                                ON content_table.content_type_id = content_type_table.content_type_id
                                WHERE (content_status = $content_status AND (content_title LIKE '%$keyword%' OR content_description LIKE '%$keyword%'))
                                ORDER BY content_id DESC
                                LIMIT $limit;");
                    if ($q->num_rows() == 0)
                    {
                        echo $this->lang->line("Nothing Found...");
                    }
                    echo json_encode($q->result(), JSON_UNESCAPED_UNICODE);

                }else{ // *** LoadMore ***
                    $q = $this->db->query("Select content_table.content_id, content_table.content_title, content_table.content_price, content_table.content_type_id, content_table.content_access, content_table.content_user_role_id, 
                                              content_table.content_image, content_table.content_duration, content_table.content_viewed, content_table.content_liked, content_table.content_publish_date, content_table.content_featured, 
                                              content_table.content_special, content_table.content_orientation, content_table.content_url,
                                              category_table.category_title,
                                              content_type_table.content_type_title
				                FROM content_table
                                INNER JOIN category_table
                                ON content_table.content_category_id = category_table.category_id
                                INNER JOIN content_type_table
                                ON content_table.content_type_id = content_type_table.content_type_id
                                WHERE (content_status = $content_status AND (content_title LIKE '%$keyword%' OR content_description LIKE '%$keyword%')) AND (content_id < $last_id)
                                ORDER BY content_id DESC
                                LIMIT $limit;");
                    if ($q->num_rows() == 0)
                    {
                        echo $this->lang->line("Nothing Found...");
                    }
                    echo json_encode($q->result(), JSON_UNESCAPED_UNICODE);
                }

            }else{
                // API key is invalid
                echo $this->lang->line("The API Key is Invalid!");
            }
        }
    }


    //============================ Hash password
    private function hash_password($user_password){
        $salt_password = "dF$.50^&D10?#^dA2z";
        return $hash_password = sha1(md5($user_password.$salt_password));
    }


    //=================================================================================//
    public function user_register()
    {
        if (isset($_GET['api_key'])) {
            $access_key_received = $_GET['api_key'];
            if ($access_key_received == $this->api_key()) {
                // API key is correct
                $this->form_validation->set_rules('user_firstname', 'user_firstname', 'trim|required|xss_clean');
                $this->form_validation->set_rules('user_lastname', 'user_lastname', 'trim|required|xss_clean');
                $this->form_validation->set_rules('user_username', 'user_username', 'trim|required|xss_clean');
                $this->form_validation->set_rules('user_email', 'user_email', 'trim|required|xss_clean');
                $this->form_validation->set_rules('user_password', 'user_password', 'trim|required|xss_clean');
                $this->form_validation->set_rules('user_referral', 'user_referral', 'trim|xss_clean');
                $this->form_validation->set_rules('user_reg_from', 'user_reg_from', 'trim|xss_clean');
                if ($this->form_validation->run() == FALSE) {
                    //error
                    echo "FormValidation";
                } else {
                    //Check if user_username is exist
                    $q = $this->db->get_where('user_table', array('user_username' => $this->input->post('user_username')));
                    if ($q->num_rows() > 0)
                    {
                        echo "UsernameExist";
                        $this->db->close();
                        die();
                    }
                    //Check if user_email is exist
                    if ($this->input->post('user_email') != null) {
                        $q = $this->db->get_where('user_table', array('user_email' => $this->input->post('user_email')));
                        if ($q->num_rows() > 0) {
                            echo "EmailExist";
                            $this->db->close();
                            die();
                        }
                    }
                    if ($this->input->post('user_referral') != null) { //Check if user refer not exist
                        $q = $this->db->get_where('user_table', array('user_id' => $this->input->post('user_referral')));
                        if ($q->num_rows() == 0) {
                            echo "ReferralNotExist";
                            $this->db->close();
                            die();
                        }
                    }

                    $dataArray = array(
                        "user_firstname" => $this->input->post('user_firstname'),
                        "user_lastname" => $this->input->post('user_lastname'),
                        "user_username" => $this->Shared_model->number2english($this->input->post('user_username')),
                        "user_mobile" => $this->input->post('user_username'),
                        "user_email" => $this->input->post('user_email'),
                        "user_password" => $this->hash_password($this->Shared_model->number2english($this->input->post('user_password'))),
                        "user_referral" => $this->input->post('user_referral'),
                        "user_reg_from" => $this->input->post('user_reg_from'),
                        "user_reg_date" => now(),
                    );
                    //Insert $dataArray to DB
                    $result = $this->Common_model->data_insert("user_table",$dataArray);
                    if ($result == TRUE) {
                        /*if ($this->input->post('user_email') != null) {
                            //Send welcome email to new user
                            $login_url = base_url()."dashboard/Auth";
                            $to = $this->input->post('user_email');
                            $cc = false; //To send a copy of email
                            $subject = $this->lang->line("New Account Information");
                            $message = $this->lang->line("email_new_account_information")
                                .$message = "- ".$this->lang->line("Login URL").": <a href='$login_url'>$login_url</a><br>- ".$this->lang->line("Username").": ".$user_username."<br>- ".$this->lang->line("Password").": ".$user_password."<br><br>";
                            $this->Shared_model->send_email($to, $cc, $subject, $message);
                        }*/

                     
                        //Insert data into activity_table
                        $this->db->select('user_id');
                        $q = $this->db->get_where('user_table', array('user_username'=> $this->input->post('user_username')));
                        $last_id = $q->result()[0]->user_id;
                        $dataArray = array(
                            "activity_user_id" => $last_id,
                            "activity_time" => now(),
                            "activity_agent" => $_SERVER['HTTP_USER_AGENT'],
                            "activity_ip" => $this->input->ip_address(),
                            "activity_desc" => $this->lang->line("User joined."),
                        );
                        $this->Common_model->data_insert("activity_table",$dataArray);

                        echo "Success";
                        $this->db->close();
                        die();

                    } else {
                        echo "NotSuccess";
                        $this->db->close();
                        die();
                    }
                }

            }else{
                // API key is invalid
                echo $this->lang->line("The API Key is Invalid!");
            }
        }
    }


    //=================================================================================//
    public function user_login()
    {
        if (isset($_GET['api_key'])) {
            $access_key_received = $_GET['api_key'];
            if ($access_key_received == $this->api_key()) {
                // API key is correct
                $this->form_validation->set_rules('user_username', 'user_username', 'trim|required|xss_clean');
                $this->form_validation->set_rules('user_password', 'user_password', 'trim|required|xss_clean');
                if ($this->form_validation->run() == FALSE) {
                    //error
                    echo "FormValidationError";

                } else {
                    $user_username = $this->input->post('user_username');
                    $user_username = $this->Shared_model->number2english($user_username);
                    $user_password = $this->input->post('user_password');
                    $user_password = $this->hash_password($user_password);

                    if ($this->User_model->auth_user_information('user_table', $user_username, $user_password) == true)
                    {
                        $result = $this->User_model->read_user_information('user_table', $user_username);
                        if ($result != false) {
                            //Insert data into activity_table
                            $dataArray = array(
                                "activity_user_id" => $result[0]->user_id,
                                "activity_time" => now(),
                                "activity_agent" => $_SERVER['HTTP_USER_AGENT'],
                                "activity_ip" => $this->input->ip_address(),
                                "activity_login_status" => 1,
                                "activity_desc" => $this->lang->line("User login into the Dashboard."),
                            );
                            $this->Common_model->data_insert("activity_table", $dataArray);

                            echo "Success";
                        }

                    }else{
                        echo "Failed";
                    }
                }

            }else{
                // API key is invalid
                echo $this->lang->line("The API Key is Invalid!");
            }
        }
    }


    //==============================================================================//
    public function add_to_bookmark()
    {
        if (isset($_GET['api_key'])) {
            $access_key_received = $_GET['api_key'];
            if ($access_key_received == $this->api_key()) {
                // API key is correct
                $this->form_validation->set_rules('user_id', 'user_id', 'trim|required|xss_clean');
                $this->form_validation->set_rules('content_id', 'content_id', 'trim|required|xss_clean');
                if ($this->form_validation->run() == FALSE) {
                    //error
                    echo "FormValidationError";

                } else {
                    $user_id = $this->input->post('user_id');
                    $content_id = $this->input->post('content_id');

                    $data = array(
                        'bookmark_user_id' => $user_id,
                        'bookmark_content_id' => $content_id,
                    );

                    if ($this->db->insert('bookmark_table', $data))
                    {
                        echo $this->lang->line("Add to bookmark successfully.");

                    }else{
                        echo $this->lang->line("Error!");
                    }
                }
            }else{
                // API key is invalid
                echo $this->lang->line("The API Key is Invalid!");
            }
        }
    }


    //==============================================================================//
    public function remove_from_bookmark()
    {
        if (isset($_GET['api_key'])) {
            $access_key_received = $_GET['api_key'];
            if ($access_key_received == $this->api_key()) {
                // API key is correct
                $this->form_validation->set_rules('user_id', 'user_id', 'trim|required|xss_clean');
                $this->form_validation->set_rules('content_id', 'content_id', 'trim|required|xss_clean');
                if ($this->form_validation->run() == FALSE) {
                    //error
                    echo "FormValidationError";

                } else {
                    $user_id = $this->input->post('user_id');
                    $content_id = $this->input->post('content_id');

                    $this->db->where('bookmark_user_id', $user_id);
                    $this->db->where('bookmark_content_id', $content_id);
                    $this->db->delete('bookmark_table');
                    echo $this->lang->line("Remove from bookmark successfully.");
                }
            }else{
                // API key is invalid
                echo $this->lang->line("The API Key is Invalid!");
            }
        }
    }


    //=================================================================================//
    public function get_bookmark_status()
    {
        if (isset($_GET['api_key'])) {
            $access_key_received = $_GET['api_key'];
            if ($access_key_received == $this->api_key()) {
                // API key is correct
                $user_id = $_GET['user_id'];
                $content_id = $_GET['content_id'];
                if (!empty($user_id) AND !empty($content_id))
                {
                    $q = $this->db->query("Select *
                                           FROM bookmark_table
                                           WHERE (bookmark_user_id = $user_id AND bookmark_content_id = $content_id);");
                    if ($q->num_rows() > 0)
                    {
                        echo "ContentIsBookmark";
                        $this->db->close();
                        die();
                    }else{
                        echo "ContentIsNotBookmark";
                        $this->db->close();
                        die();
                    }
                }

            }else{
                // API key is invalid
                echo $this->lang->line("The API Key is Invalid!");
            }
        }
    }


    //==============================================================================//
    public function get_bookmark_content()
    {
        if (isset($_GET['api_key'])) {
            $access_key_received = $_GET['api_key'];
            if ($access_key_received == $this->api_key()) {
                // Show Json
                $user_id = $_GET['user_id'];
                $last_id = $_GET['last_id'];
                $limit = $_GET['limit'];
                $content_status = 1; // 0: Inactive | 1: Active | 2: Expired

                // *** FirstLoad ***
                if ($last_id == 0)
                {
                    $q = $this->db->query("Select content_table.content_id, content_table.content_title, content_table.content_price, content_table.content_type_id, content_table.content_access, content_table.content_user_role_id, 
                                              content_table.content_image, content_table.content_duration, content_table.content_viewed, content_table.content_liked, content_table.content_publish_date, content_table.content_featured, 
                                              content_table.content_special, content_table.content_orientation, content_table.content_url,
                                              category_table.category_title,
                                              content_type_table.content_type_title
                                FROM content_table
                                INNER JOIN bookmark_table
					            ON content_table.content_id = bookmark_table.bookmark_content_id
                                INNER JOIN category_table
                                ON content_table.content_category_id = category_table.category_id
                                INNER JOIN content_type_table
                                ON content_table.content_type_id = content_type_table.content_type_id
								WHERE (content_status = $content_status) AND (bookmark_user_id = $user_id)
								ORDER BY content_id DESC
								LIMIT $limit;");
                    if ($q->num_rows() == 0)
                        echo $this->lang->line("Nothing Found...");
                    else
                        echo json_encode($q->result(), JSON_UNESCAPED_UNICODE);

                }else{ // *** LoadMore ***
                    $q = $this->db->query("Select content_table.content_id, content_table.content_title, content_table.content_price, content_table.content_type_id, content_table.content_access, content_table.content_user_role_id, 
                                              content_table.content_image, content_table.content_duration, content_table.content_viewed, content_table.content_liked, content_table.content_publish_date, content_table.content_featured, 
                                              content_table.content_special, content_table.content_orientation, content_table.content_url,
                                              category_table.category_title,
                                              content_type_table.content_type_title
                                FROM content_table
                                INNER JOIN bookmark_table
					            ON content_table.content_id = bookmark_table.bookmark_content_id
                                INNER JOIN category_table
                                ON content_table.content_category_id = category_table.category_id
                                INNER JOIN content_type_table
                                ON content_table.content_type_id = content_type_table.content_type_id
								WHERE (content_status = $content_status) AND (bookmark_user_id = $user_id) AND (bookmark_content_id < $last_id)
								ORDER BY content_id DESC
								LIMIT $limit;");
                    if ($q->num_rows() == 0)
                        echo $this->lang->line("Nothing More Found...");
                    else
                        echo json_encode($q->result(), JSON_UNESCAPED_UNICODE);
                }

            }else{
                // API key is invalid
                echo $this->lang->line("The API Key is Invalid!");
            }
        }

    }


    //=================================================================================//
    public function get_all_after_login()
    {
        if (isset($_GET['api_key'])) {
            $access_key_received = $_GET['api_key'];
            if ($access_key_received == $this->api_key()) {

                // API key is correct
                if(isset($_REQUEST['user_username']))
                    $user_username = $_REQUEST['user_username'];
                if (!empty($user_username)) {
                    $query = $this->db->get_where('user_table', array('user_username'=>$user_username));
                    if ($query->num_rows() > 0)
                    {
                        $q = $this->db->query("Select setting_table.*, user_table.user_id, user_table.user_username, user_table.user_firstname, user_table.user_lastname, user_table.user_mobile, user_table.user_email, user_table.user_coin, user_table.user_credit, 
                                                      user_table.user_referral, user_table.user_mobile_verified, user_table.user_email_verified, user_table.user_role_id,
                                                      user_role_table.user_role_title
                                               FROM setting_table
                                               INNER JOIN user_table
                                               INNER JOIN user_role_table
                                               ON user_table.user_role_id = user_role_table.user_role_id
                                               WHERE (setting_id = 1 AND user_username = '$user_username');");
                        echo json_encode($q->result(), JSON_UNESCAPED_UNICODE);
                    }
                }

            }else{
                // API key is invalid
                echo $this->lang->line("The API Key is Invalid!");
            }
        }
    }


    //=================================================================================//
    public function get_all_before_login()
    {
        if (isset($_GET['api_key'])) {
            $access_key_received = $_GET['api_key'];
            if ($access_key_received == $this->api_key()) {

                // API key is correct
                $q = $this->db->query("Select *
                                       FROM setting_table
                                       WHERE setting_id = 1;");
                echo json_encode($q->result(), JSON_UNESCAPED_UNICODE);

            }else{
                // API key is invalid
                echo $this->lang->line("The API Key is Invalid!");
            }
        }
    }
}
