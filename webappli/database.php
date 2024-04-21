<?php

class Database
{
    private string $servername = "172.16.0.214";
    private string $username = "group6";
    private string $password = "123456";
    private string $database = "group6";
    private ?mysqli $conn = null;

    public function __construct()
    {
        $this->connect();
    }

    public function connect(): void
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function createUser(string $name, string $email, string $password): bool
{
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $this->conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");

    if (!$stmt) {
        error_log("Error preparing statement: " . $this->conn->error);
        return false;
    }

    $stmt->bind_param("sss", $name, $email, $hashedPassword);

    if (!$stmt->execute()) {
        error_log("Error creating record: " . $stmt->error);
        return false;
    }

    return true;
}


public function updateUser(int $userId, string $name, string $email, string $password): bool
{
    $stmt = $this->conn->prepare("UPDATE users SET name=?, email=?, password=? WHERE user_id=?");

    if (!$stmt) {
        error_log("Error preparing statement: " . $this->conn->error);
        return false;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bind_param("sssi", $name, $email, $hashedPassword, $userId);
    if (!$stmt->execute()) {
        error_log("Error executing statement: " . $stmt->error);
        return false;
    }

    $affectedRows = $stmt->affected_rows;

    $stmt->close();

    return $affectedRows > 0;
}

    public function deleteUser(int $userId): bool
    {
        if (!$this->conn) {
            $this->connect();
        }

        $stmt = $this->conn->prepare("DELETE FROM users WHERE user_id=?");

        if (!$stmt) {
            error_log("Error preparing statement: " . $this->conn->error);
            return false;
        }

        $stmt->bind_param("i", $userId);

        return $stmt->execute();
    }

    public function getUserByEmail(string $email): ?User
    {
        if (!$this->conn) {
            $this->connect();
        }

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        
        if (!$stmt) {
            error_log("Error preparing statement: " . $this->conn->error);
            return null;
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            return new User($user['user_id'], $user['name'], $user['email'], $user['password']);
        }

        return null;
    }

    public function getUsers(): array
    {
        if (!$this->conn) {
            $this->connect();
        }

        $result = $this->conn->query("SELECT * FROM users");

        if (!$result) {
            error_log("Error getting users: " . $this->conn->error);
            return [];
        }

        $users = [];

        while ($row = $result->fetch_assoc()) {
            $users[] = new User($row['user_id'], $row['name'], $row['email'], $row['password']);
        }

        return $users;
    }
    public function createAdmin(string $username, string $password): bool
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");

        if (!$stmt) {
            error_log("Error preparing statement: " . $this->conn->error);
            return false;
        }

        $stmt->bind_param("ss", $username, $hashedPassword);

        if (!$stmt->execute()) {
            error_log("Error creating admin: " . $stmt->error);
            return false;
        }

        return true;
    }

    public function updateAdmin(int $adminId, string $username, string $password): bool
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare("UPDATE admins SET username=?, password=? WHERE admin_id=?");

        if (!$stmt) {
            error_log("Error preparing statement: " . $this->conn->error);
            return false;
        }

        $stmt->bind_param("ssi", $username, $hashedPassword, $adminId);

        if (!$stmt->execute()) {
            error_log("Error updating admin: " . $stmt->error);
            return false;
        }

        return true;
    }

    public function deleteAdmin(int $adminId): bool
    {
        $stmt = $this->conn->prepare("DELETE FROM admins WHERE admin_id=?");

        if (!$stmt) {
            error_log("Error preparing statement: " . $this->conn->error);
            return false;
        }

        $stmt->bind_param("i", $adminId);

        if (!$stmt->execute()) {
            error_log("Error deleting admin: " . $stmt->error);
            return false;
        }

        return true;
    }

    public function getAdminByEmail(string $email): ?Admin
    {
        $stmt = $this->conn->prepare("SELECT * FROM admins WHERE email = ?");
        
        if (!$stmt) {
            error_log("Error preparing statement: " . $this->conn->error);
            return null;
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $admin = $result->fetch_assoc();
            return new Admin($admin['admin_id'], $admin['username'], $admin['password']);
        }

        return null;
    }

    public function getAdmins(): array
    {
        $admins = [];

        $result = $this->conn->query("SELECT * FROM admins");

        if ($result->num_rows > 0) {
            while ($admin = $result->fetch_assoc()) {
                $admins[] = new Admin($admin['admin_id'], $admin['username'], $admin['password']);
            }
        }

        return $admins;
    }

    public function closeConnection(): void
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>