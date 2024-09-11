<?php
require base_path("utils/navigation.php");

use Core\App;
use Core\Database;


$db = App::container()->resolve(Database::class);

$heading = "Note";

$currentUserId = 101;

$query = 'select * from notes where id = :id';

$note = $db->query($query, [':id' => $_POST['id']])->findOrFail();

authorize($note['user_id'] == $currentUserId);

$query = 'delete from notes where id = :id';

$db->query($query, [
    'id' => $_POST['id']
]);

header('location: /notes');

exit();
