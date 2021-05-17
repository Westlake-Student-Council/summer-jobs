<?php
require_once 'DatabaseConnection.php';

class UserLogin {

    protected $pdo = null;
    private $username;
    private $password;
    private $user_id;

    public function __construct()
    {
        $this->pdo = DatabaseConnection::instance();
        $this->username = "";
        $this->password = "";
        $this->user_id = "";
    }

    public function setUsername(string $username): string
    {
        if(empty($username)) {
            return "Please enter your username.";
        }
        if($this->checkUsernameExists(strtolower($username))) {
            $this->username = strtolower($username);
            return "";
        }
        else
        {
            return "No account found with that username.";
        }
    }

    private function checkUsernameExists($username): bool
    {
        $stmt = $this->pdo->prepare("SELECT 1 FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        return (bool)$stmt->fetch();
    }

    public function setPassword(string $password): string
    {
        if(empty($password)) {
            return "Please enter a password.";
        }
        else {
            $this->password = $password;
            return "";
        }
    }

    public function login(): bool
    {
        $sql = "SELECT user_id, username, password FROM users WHERE username = :username";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['username' => $this->username]);
        $user = $stmt->fetch();

        if ($user && strcmp($this->password,$user['password']) == 0)
        {
            $this->user_id = $user["user_id"];
            return true;
        } else {
            return false;
        }
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

}
?>
