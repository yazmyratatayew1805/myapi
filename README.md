# User Management REST API

## Описание

Это REST API для управления пользователями, реализованное на чистом PHP с использованием современных практик разработки.

## Методы API

### Создание пользователя

**POST /users**

**Тело запроса:**
```json
{
    "username": "example",
    "password": "password123",
    "email": "user@example.com"
}
```
Ответ:
```json
{
    "id": 1
}
```

Обновление информации пользователя
PUT /users/{id}

Тело запроса:
```json
{
    "username": "newUsername",
    "email": "newemail@example.com"
}
```
Ответ:
```json
{
    "updated": 1
}
```

Удаление пользователя
DELETE /users/{id}

Ответ:
```json
{
    "deleted": 1
}
```

Авторизация пользователя
POST /users/auth

Тело запроса:
```json
{
    "username": "example",
    "password": "password123"
}
```
Ответ:
```json
{
    "id": 1,
    "username": "example",
    "email": "user@example.com",
    "created_at": "2023-07-23 00:00:00"
}
```

Получить информацию о пользователе
GET /users/{id}

Ответ:
```json
{
    "id": 1,
    "username": "example",
    "email": "user@example.com",
    "created_at": "2023-07-23 00:00:00"
}
```

Установка
1.Склонируйте репозиторий:
```json
git clone https://github.com/yazmyratatayew1805/myapi.git
cd myapi
```


2.Установите зависимости через Composer:
```json
composer install
```

3.Настройте базу данных в config/database.php.

4.Создайте базу данных и таблицу пользователей:
```json
CREATE DATABASE myapi;

USE myapi;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
5.Настройте веб-сервер для использования папки public в качестве корневой директории.
