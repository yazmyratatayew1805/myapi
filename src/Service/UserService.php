<?php

namespace App\Service;

use App\Config\Database;
use App\Model\User;
use PDO;

class UserService {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::connect();
    }

    public function createUser(string $username, string $password, string $email): int {
        $stmt = $this->pdo->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $stmt->execute([$username, password_hash($password, PASSWORD_DEFAULT), $email]);
        return $this->pdo->lastInsertId();
    }

    public function updateUser(int $id, string $username, string $email): int {
        $stmt = $this->pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
        $stmt->execute([$username, $email, $id]);
        return $stmt->rowCount();
    }

    public function deleteUser(int $id): int {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

    public function getUser(int $id): ?User {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch();
        if ($data) {
            return new User($data['id'], $data['username'], $data['password'], $data['email'], $data['created_at']);
        }
        return null;
    }

    public function authenticateUser(string $username, string $password): ?User {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $data = $stmt->fetch();
        if ($data && password_verify($password, $data['password'])) {
            return new User($data['id'], $data['username'], $data['password'], $data['email'], $data['created_at']);
        }
        return null;
    }
}
