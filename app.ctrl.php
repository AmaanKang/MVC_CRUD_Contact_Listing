<?php
include 'app.config.php';
include 'app.model.php';
$validCreate = 1;
$validUpdate = 1;
function validateInput($lastname,$firstname,$email,$phone,$msg){
    if(strlen(trim($lastname)) < 5 || strlen(trim($lastname)) > 15 || ($lastname == trim($lastname) && strpos($lastname, ' ') !== false) || ctype_alnum($lastname) == false){
        $msg .= "Last name not in right format. 5-15 chars. Letters,Numbers only.";
    }
    if(($firstname == trim($firstname) && strpos($firstname, ' ') !== false) || ctype_alnum($firstname) == false){
        $msg .= "</br>First Name must contain letters numbers only.";
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $msg .= "</br>Not a valid email address.";
    }
    if(preg_match("/[0-9]{3}-[0-9]{4}/",$phone) == 0){
        $msg .= "</br>Not a valid phone number (Ex: 123-4567 ).";
    }
    return $msg;
}
switch ($_REQUEST['act'])
{
	case 'Create':
        $msgs = "";
        $msg = validateInput($_REQUEST['lastName'],$_REQUEST['firstName'],$_REQUEST['emailAdd'],$_REQUEST['phone'],$msgs);
        if($msg == ""){
            $msg = createRecord($conn,
            $_REQUEST['lastName'],
	        $_REQUEST['firstName'],
	        $_REQUEST['emailAdd'],
		    $_REQUEST['phone']);
            $validCreate = 1;
        }else{
            $validCreate = 0;
        }	   
	break;
	case 'Delete':
	    $msg = deleteRecord($conn, $_REQUEST['id']);
	break;
    case 'Edit':
        $TPL['result'] = selectRecord($conn,$_REQUEST['id']);
    break;
    case 'Confirm':
        $TPL['result'] = selectRecord($conn,$_REQUEST['id']);
    break;
	case 'Update':
        $msgs = "";
        $msg = validateInput($_REQUEST['lastName'],$_REQUEST['firstName'],$_REQUEST['emailAdd'],$_REQUEST['phone'],$msgs);
        if($msg == ""){
	        $msg = updateRecord($conn,
            $_REQUEST['id'],
            $_REQUEST['lastName'],
            $_REQUEST['firstName'],
            $_REQUEST['emailAdd'],
            $_REQUEST['phone']);
            $validUpdate = 1;
        }else{
            $validUpdate = 0;
        }
	break;
}
$TPL['results'] = readAllRecords($conn);
if($_REQUEST['act'] == 'sortby'){
    $TPL['results'] = sortBy($conn,$_REQUEST['field'],$_REQUEST['dir']);
}
$TPL['message'] = $msg;

