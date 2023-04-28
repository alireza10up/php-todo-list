<?php

// security check

use Symfony\Component\Mime\Email;

defined("BASE_PATH") or die('PERMISSION_DENIAL');

function getCurrentUserId()
{
    return getUserById($_SESSION['login'])->id ?? 0;
}

function getUserByEmail(string $email = null)
{
    global $pdo;
    $sql = 'select * from `users` where email = :email';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);
    $record = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $record[0] ?? null;
}

function getUserById(int $id = null) {
    global $pdo;
    $sql = 'select * from `users` where id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $record = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $record[0] ?? null;
}

function isLoggedIn()
{
    return isset($_SESSION['login']);
}

function register(array $args = null)
{
    // get data
    $name = htmlspecialchars($args['name'] ?? 0);
    $password = htmlspecialchars($args['password'] ?? 0);
    $email = htmlspecialchars($args['email'] ?? 0);
    // validation //
    // check length
    if (strlen($name) > 32 || strlen($name) < 2) return INVALID_LENGTH_NAME;
    if (strlen($password) > 32 || strlen($password) < 8) return INVALID_LENGTH_PASSWORD;
    // check password
    if (!preg_match('/^[A-Za-z][A-Za-z0-9]{4,31}$/', $password)) return REGEX_NOT_MATCH_PASSWORD;
    // check email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return INVALID_EMAIL;
    // hash password
    $password = password_hash($password, PASSWORD_DEFAULT);
    // db process
    global $pdo;
    // check exists
    $sql = 'select * from `users` where email = :email';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);
    if ($stmt->rowCount()) return EMAIL_EXISTS;
    // insert in db
    $sql = 'insert into `users` (name ,  password , email) values (:name , :pass , :email )';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':name' => $name, ':pass' => $password, ':email' => $email]);
    return $stmt->rowCount();
}

function login(array $args = null)
{
    // get data
    $password = htmlspecialchars($args['password'] ?? 0);
    $email = htmlspecialchars($args['email'] ?? 0);
    // validation //
    // check length
    if (strlen($password) > 32 || strlen($password) < 8) return INVALID_LENGTH_PASSWORD;
    // check password
    if (!preg_match('/^[A-Za-z][A-Za-z0-9]{4,31}$/', $password)) return REGEX_NOT_MATCH_PASSWORD;
    // check email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return INVALID_EMAIL;
    $user = getUserByEmail($email);
    if (!$user) return USER_NOT_FOUND;
    // verify password
    if (!password_verify($password, $user->password)) return INFORMATION_INCORRECT;
    // set cookie
    // setcookie('login', $user->id, time() + 86400, '/');
    $_SESSION['login'] = $user->id;
    // back home
    redirectTool();
}

function logout() {
    // unset cookie
    // setcookie('login', '', time() - 106400, '/');
    session_destroy();
    redirectTool();
}