<?php
require base_path("utils/navigation.php");

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];
$valEmail = Validator::email($email);
$valPass = Validator::password($password, 7, 255);

$errors = [];

//validate de form inputs

if (!$valEmail) {
    $errors['email'] = 'Please provide a valida email address';
}

if (!$valPass) {
    $errors['password'] = 'Please provide a password of at least seven characters';
}

if (!empty($errors)) {
    require view_path('registration/create.view.php');
}

//check if the email already exist
$query = 'select * from users where email = :email';

$db = App::container()->resolve(Database::class);

$user = $db->query($query, [
    'email' => $email
])->find();

if ($user) {
    header('location: /');
    exit();
} else {
    $lastId = $db->query("SELECT TOP 1 id FROM users ORDER BY id DESC")->find() ?? 101;

    $query = 'insert into users values  (:id, :email, :password)';
    $db->query($query, [
        'id' => (int) $lastId['id'] + 1,
        'email' => $email,
        'password' => $password,
    ]);

    $_SESSION['user'] = [
        'email' => $email
    ];

    header('location: /');
    exit();
}