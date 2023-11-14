<?php
namespace mo;
class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function getUsers ($id = null){
        if (isset($id)) {
            $this->db->where("id",$id);
            return $this->db->get('users');
        }
        else {
            return $this->db->get('users');
        }
        
    }
    public function addUser($data){
        return $this->db->insert('users', $data);

    }
    public function UpdataUser($data,$id){
        $this->db->where('id',$id );
        return $this->db->update('users', $data);
    }
    public function deleteuser($id){
        $this->db->where('id', $id);
        return $this->db->delete('users');
        
    }
}

?>