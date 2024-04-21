<?php

class Admin {
    private $adminId;
    private $username;
    private $password;

    public function __construct(int $adminId, string $username, string $password) {
        $this->adminId = $adminId;
        $this->username = $username;
        $this->password = $password;
    }

    public function getAdminId() {
        return $this->adminId;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

}

?>
