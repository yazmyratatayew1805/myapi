<?php

namespace App\Controller;

use App\Service\UserService;
use Exception;

class UserController {
    private $userService;

    public function __construct() {
        $this->userService = new UserService();
    }

    public function processRequest(string $method, array $path): void {
        try {
            switch ($method) {
                case 'POST':
                    if (isset($path[1]) && $path[1] === 'auth') {
                        $this->authenticate();
                    } else {
                        $this->createUser();
                    }
                    break;
                case 'PUT':
                    $this->updateUser((int)$path[1]);
                    break;
                case 'DELETE':
                    $this->deleteUser((int)$path[1]);
                    break;
                case 'GET':
                    $this->getUser((int)$path[1]);
                    break;
                default:
                    $this->response(405, ['error' => 'Method Not Allowed']);
            }
        } catch (Exception $e) {
            $this->response(500, ['error' => $e->getMessage()]);
        }
    }

    private function createUser(): void {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $this->userService->createUser($data['username'], $data['password'], $data['email']);
        $this->response(201, ['id' => $id]);
    }

    private function updateUser(int $id): void {
        $data = json_decode(file_get_contents('php://input'), true);
        $count = $this->userService->updateUser($id, $data['username'], $data['email']);
        $this->response(200, ['updated' => $count]);
    }

    private function deleteUser(int $id): void {
        $count = $this->userService->deleteUser($id);
        $this->response(200, ['deleted' => $count]);
    }

    private function getUser(int $id): void {
        $user = $this->userService->getUser($id);
        if ($user) {
            $this->response(200, $user);
        } else {
            $this->response(404, ['error' => 'User Not Found']);
        }
    }

    private function authenticate(): void {
        $data = json_decode(file_get_contents('php://input'), true);
        $user = $this->userService->authenticateUser($data['username'], $data['password']);
        if ($user) {
            $this->response(200, $user);
        } else {
            $this->response(401, ['error' => 'Invalid credentials']);
        }
    }

    private function response(int $statusCode, $data): void {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
