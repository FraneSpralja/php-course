<?php

use Core\App;
use Core\Database;

require base_path("utils/navigation.php");

$db = App::container()->resolve(Database::class);

$heading = "Note";

$currentUserId = 101;

$query = 'select * from notes where id = :id';

$note = $db->query($query, [':id' => $_GET['id']])->findOrFail();

authorize((int) $note['user_id'] === $currentUserId);

require view_path("notes/show.view.php");

