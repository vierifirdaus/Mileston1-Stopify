<?php
require_once(PROJECT_ROOT_PATH ."/src/models/BaseModel.class.php");

class UsersModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "users";
    }

    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE email = :email');
        $this->db->bind('email', $email);
        $result= $this->db->single();
        if($this->db->rowCount() != 0 && password_verify($password, $result->password))
        {
            $_SESSION["username"] = $result->username;
            $_SESSION["role"] = $result->role;    
            $_SESSION["id_user"] = $result->id_user;
        }
        else
        {
            $result = 0;
        }
        
        return $result;
    }

    public function getUserByUsername($username)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE username = :username');
        $this->db->bind('username', $username);
        return $this->db->single();
    }
    public function getUserById($id_user)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_user = :id_user');
        $this->db->bind('id_user', $id_user);
        return $this->db->single();
    }

    public function getAllUser(){
        $this->db->query('SELECT * FROM users');
        return $this->db->resultSet();
    }
    
    public function insertUser($email, $username, $password)
    {
        $query = "SELECT * FROM users WHERE email = :email OR username = :username";
        $this->db->query($query);
        $this->db->bind('email', $email);
        $this->db->bind('username', $username);
        $this->db->execute();
        if($this->db->rowCount() != 0)
        {
            return 0;
        }
        $query = "INSERT INTO users (email, username, password, role) values (:email, :username, :password, 'user')";
        $this->db->query($query);
        $this->db->bind('email', $email);
        $this->db->bind('username', $username);
        $this->db->bind('password', password_hash($password, PASSWORD_DEFAULT));
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteUser($id_user)
    {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id_user = :id_user');
        $this->db->bind(':id_user', $id_user);
        $this->db->execute();
        return $this->db->rowCount();
    }
}