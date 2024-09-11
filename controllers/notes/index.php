<?php
require base_path("utils/navigation.php");

use Core\App;
use Core\Database;


$db = App::container()->resolve(Database::class);

$heading = "My Notes";

$notes = $db->query('select * from notes where user_id = 101')->get();

require view_path("notes/index.view.php");