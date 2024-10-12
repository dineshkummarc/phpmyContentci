<?php
class Content_model extends CI_Model
{

    //============================ Main construct
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }


    //============================ User role
    function get_user_role($table){
        $active = 1;
        $q = $this->db->query("Select $table.*
								FROM $table
								WHERE (user_type_id = 2) AND (user_role_status = $active)
								ORDER BY user_role_id ASC;");
        return $q;
    }


    //============================ Content List
    function get_content($table, $keyword, $content_type, $limit, $start)
    {
        $where = "";
        if($keyword != "" AND $content_type != "")
            $where = "WHERE content_title LIKE '%$keyword%' AND $table.content_type_id = '$content_type'";
        if($keyword != "" AND $content_type == "")
            $where = "WHERE content_title LIKE '%$keyword%'";
        if($keyword == "" AND $content_type != "")
            $where = "WHERE $table.content_type_id = '$content_type'";

        $q = $this->db->query("Select $table.*, category_table.category_title, content_type_table.content_type_title
								FROM $table
								INNER JOIN category_table
								ON $table.content_category_id = category_table.category_id 
								INNER JOIN content_type_table
								ON $table.content_type_id = content_type_table.content_type_id 
								$where
								ORDER BY content_id DESC
								LIMIT $limit OFFSET $start;");
        return $q;
    }


    //============================ Content type
    function get_content_type($table)
    {
        $q = $this->db->query("Select $table.*
								FROM $table
								WHERE content_type_status = 1
								ORDER BY content_type_id ASC;");
        return $q;
    }


    //============================ Content count
    public function get_total_content_count($table, $keyword, $content_type) {
        $where = "";
        if($keyword != "" AND $content_type != "")
            $where = "WHERE content_title LIKE '%$keyword%' AND $table.content_type_id = '$content_type'";
        if($keyword != "" AND $content_type == "")
            $where = "WHERE content_title LIKE '%$keyword%'";
        if($keyword == "" AND $content_type != "")
            $where = "WHERE $table.content_type_id = '$content_type'";

        $q = $this->db->query("Select $table.*
								FROM $table
								$where
								;");
        return $q->num_rows();
    }


    //============================ Get content, content with content_id
    function get_content_content($table, $content_id)
    {
        $query = $this->db->query("Select $table.* FROM $table
								WHERE content_id = $content_id;");
        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }


    //============================ Get content image with content_id
    function get_content_image($table, $content_id){
        $this->db->select('content_image');
        $query = $this->db->get_where($table, array('content_id'=>$content_id));
        return $query->result()[0];
    }
}