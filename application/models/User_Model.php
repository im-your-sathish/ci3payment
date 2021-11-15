<?php

class User_Model extends CI_Model
{

    public function getusers()
    {
        return $this->db->get("users")->result();
    }
    public function getbyid($id)
    {
        return $this->db->where("id", $id)->get("users")->row();
    }
    public function deleteuser($id)
    {
        return $this->db->where("id", $id)->delete("users");
    }
    public function updateuser($id,$data)
    {
        return $this->db->where("id",$id)->update("users", $data);
    }
}
