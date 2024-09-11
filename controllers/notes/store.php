<?php

use Core\App;
use Core\Database;
use Core\Validator;

require base_path("utils/navigation.php");
require base_path("Core/Validator.php");

$db = App::container()->resolve(Database::class);

$errors = [];

$lastId = $db->query("SELECT TOP 1 id FROM notes ORDER BY id DESC")->find() ?? 201;

if (Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1,000 characters is required';
}

if (!empty($errors)) {
    $heading = "Create a note";
    require view_path("notes/create.view.php");
} else {
    $db->query("insert into notes values (:id, :body, :user_id)", [
        'id' => $lastId['id'] + 1,
        'body' => $_POST['body'],
        'user_id' => 101,
    ]);
}


header('location: /notes');
die();