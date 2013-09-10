<?php
// Include Medoo
require_once 'medoo/medoo.php';
$database = new medoo([
    'database_type' => 'mysql',
    'database_name' => 'welfare',
    'server'        => '127.0.0.1',
    'username'      => 'medoo',
    'password'      => 'uW3GBFfE',
]);

$search_array = array();

if(!empty($_GET['service_id']) && "0" != $_GET['service_id'] )
{
    $search_array['AND']['service_id'] = htmlspecialchars($_GET['service_id']);
    if ( !empty($_GET['item_id']) ) {
        $search_array['AND']['item_id'] = htmlspecialchars($_GET['item_id']);
    }
    if ( !empty($_GET['type']) ) {
        $search_array['AND']['type'] = htmlspecialchars($_GET['type']);
    }
}
else if( !empty($_GET['name']) )
{
    $search_array['LIKE'] = array('name' => htmlspecialchars($_GET['name']));
}

$result = $database->select(
	'service_code',
    array('service_id', 'item_id', 'name', 'synthesis', 'type'),
    $search_array
);

echo json_encode($result);
exit();


