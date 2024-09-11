<?php

use Core\App;
use Core\Database;
use Core\Validator;

require base_path("utils/navigation.php");

$db = App::container()->resolve(Database::class);

$currentUserId = 101;

$query = 'select * from notes where id = :id';

$note = $db->query($query, [':id' => $_POST['id']])->findOrFail();

authorize((int) $note['user_id'] === $currentUserId);

$errors = [];

if (Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1,000 characters is required';
}

if (count($errors)) {
    $heading = "Edit Note";
    require view_path("/notes/edit.view.php");
} else {
    $query = "update notes set body = :body where id = :id";
    $db->query($query, [
        'id' => $_POST['id'],
        'body' => $_POST['body'],
    ]);

    header('location: /notes');
    die();
}