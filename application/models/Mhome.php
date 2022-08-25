<?php if ( ! defined('BASEPATH')) exit ('No direct script  allow'); 

class Mmembers extends  CI_Model {
    
    public function __construct()
    {
        parent::__construct(MEMBERS_TB);
    }

    public function get_user($user_id){
        $condition = array('user_id'=>$user_id);
        $query = $this->db->get_where(MEMBERS_TB, $condition);
        $q_rslt = $query->result();
        return $q_rslt[0];
    }

    public function get_userlist(){
        $userlist = array();
        $rows = array(); 
        $ii = 0;
        $query = $this->db->get(MEMBERS_TB);
        $q_rslt = $query->result_array();
        if(!empty($q_rslt)){
            foreach ($q_rslt as $row) {
                $edit_gp = '<button type="button" title="User Edit" userdata="'.$row['id'].'" class="btn btn-link text-success p-0 mr-2"><i class="fa fa-edit"></i></button>';
                $del_gp = '<button type="button" title="User Delete" userdata="'.$row['id'].'" class="btn btn-link text-danger p-0"><i class="fa fa-trash-o"></i></button>';
                
                if($row['status'] == 1){
                    $status = '<span class="badge badge-success">Active</span>';
                }else{
                    $status = '<span class="badge badge-warning">Not Active</span>';
                }

                if($row['role'] == "Super Admin"){
                    array_push($rows, [$row['id'], $row['first_name'], $row['last_name'], $row['email'], $row['role'], $status, date("m/d/Y", strtotime($row['created'])), date("m/d/Y H:i:s", strtotime($row['last_login'])), $edit_gp ]);
                }else{
                    array_push($rows, [$row['id'], $row['first_name'], $row['last_name'], $row['email'], $row['role'], $status, date("m/d/Y", strtotime($row['created'])), date("m/d/Y H:i:s", strtotime($row['last_login'])), $edit_gp.$del_gp ]);
                }
            }    
        }
        return $rows;
    }

    public function update_user($user_id){
        $user_info = array(
            'first_name'=>$this->input->post("first_name"),
            'last_name'=>$this->input->post("last_name"),
            'email'=>$this->input->post("user_email"),
            'dob'=>$this->input->post("dob"),
            'phone'=>$this->input->post("phone"),
            'role'=>$this->input->post("user_role"),
            'status'=>$this->input->post("status")
        );

        if($this->input->post("password") !== ""){
            $user_info["password"] = md5($this->input->post("password"));
        }

        if(isset($_FILES["profile_image"]["name"]) && $_FILES["profile_image"]["name"] !== ""){
            $config['upload_path']   = 'uploads/profile_images/';
            $config['allowed_types'] = '*';
            $config['file_name']     = 'photo'.getdate()[0];
            $this->load->library('upload', $config);
            if ( $this->upload->do_upload('profile_image')){
                
                true;
            }else{
                //print_r($this->upload->display_errors());exit;
                false;
            }
            $name = $_FILES["profile_image"]["name"];
            $ext = explode(".", $name);
            $user_info["photo"] = $config['upload_path'].$config['file_name'].".".$ext[1];
            move_uploaded_file($_FILES["profile_image"]["tmp_name"], $user_info["photo"]);
        }
        $condition = array('id'=>$user_id);
        $this->db->where($condition)->update(MEMBERS_TB, $user_info);
    }

    public function add_user(){
        $user_info = array(
            'first_name'=>$this->input->post("first_name"),
            'last_name'=>$this->input->post("last_name"),
            'email'=>$this->input->post("user_email"),
            'password'=>md5($this->input->post("password")),
            'role'=>$this->input->post("user_role")
        );
        $this->db->insert(MEMBERS_TB, $user_info);
    }

    public function delete_user($user_id){
         $this->db->where('id', $user_id);
         $this->db->delete(MEMBERS_TB);
         return 1;
    }

}
