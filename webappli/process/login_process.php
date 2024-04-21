<?php
session_start();
include '../database.php';
include '../admin_class.php';
include '../class/user_class.php';

class Login {
    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function loginUser($email, $password) {
        $admin = $this->database->getAdminByEmail($email);
        
        if ($admin && password_verify($password, $admin->getPassword())) {
            $_SESSION['admin_loggedin'] = true;
            $_SESSION['admin'] = [
                'id' => $admin->getAdminId(),
                'username' => $admin->getUsername(),
            ];
            echo json_encode(['success' => true]);
            exit();
        }

        $user = $this->database->getUserByEmail($email);

        if ($user && password_verify($password, $user->getPassword())) {
            $_SESSION['loggedin'] = true;
            $_SESSION['user'] = [
                'id' => $user->getUserId(),
                'name' => $user->getName(),
                'email' => $user->getEmail()
            ];
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
        }
    }    
}

$login = new Login();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $login->loginUser($email, $password);
}
?>