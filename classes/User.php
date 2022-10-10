<?php 

class User {
    
    public function isAdmin(){
        return isset($_SESSION['role']) && $_SESSION['role'] == 'admin';
    }

    public function isSupervisor(){
        return isset($_SESSION['role']) && $_SESSION['role'] == 'supervisor';
    }

}