<?php

use Core\App;

$db =  App::resolve('Core\Database');

$notes = $db->query('select * from notes where user_id = 7')->get();

view("notes/index.view.php", [
    'heading' => 'My Notes',
    'notes' => $notes
]);