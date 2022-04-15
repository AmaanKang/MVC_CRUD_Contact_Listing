<?php
$error = array();
function logError($sql,$ex){
	$ERROR = array();
	$ERROR['sql'] = $sql;
	$ERROR['time'] = date("F j, Y, g:i a");
	$ERROR['mysqlerror'] = $ex->getMessage();
	$ERROR['filename'] = __FILE__;
	$ERROR['linenumber'] =  __LINE__;
	$ERROR['remotehost'] = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	$ERROR['clientip'] = $_SERVER['REMOTE_ADDR'];
	error_log(print_r($ERROR,true),3,"./errorlog.txt");
	return $ERROR;
}
function deleteRecord($conn, $id)
{
	try {
		$stmt = $conn->prepare("DELETE FROM phonebook WHERE id=?");
		$stmt->execute([$id]);
		$count = $stmt->rowCount();
		if($count > 0){
			$message = "Record with ID = ".$id." was deleted";
		}else{
			$message = "Delete Failed";
		}
		
	} catch (PDOException $e)
	{
		$sql = "DELETE FROM phonebook WHERE id=".$id;
		$error['data'] = logError($sql,$e);
		include 'app.errorview.php';
		exit();
	}
	return $message;
}

function createRecord($conn, $lastName, $firstName, $emailAdd, $phone)
{
	try {
		$stmt = $conn->prepare("INSERT INTO phonebook (lname,fname,email,phone)".
								" VALUES (?,?,?,?)");
		$stmt->execute([$lastName,$firstName,$emailAdd,$phone]);
		$count = $stmt->rowCount();
		if($count > 0){
			$message = "Record successfully inserted.";
		}else{
			$message = "Add new listing failed.";
		}
	} catch (PDOException $e)
	{
		$sql = "INSERT INTO phonebook (lname,fname,email,phone) VALUES (".$lastName.",".$firstName.",".$emailAdd.",".$phone.")";
		$error['data'] = logError($sql,$e);
		include 'app.errorview.php';
		exit();
	}
	return $message;
}

function readAllRecords($conn)
{
	$results = array();
	
	try
	{
		$stmt = $conn->prepare("SELECT * FROM phonebook");
		$stmt->execute();
		while ($nextRow = $stmt->fetch()) $results[] = $nextRow;	
		
	}
	catch (PDOException $e)
	{
		$sql = "SELECT * FROM phonebook";
		$error['data'] = logError($sql,$e);
		include 'app.errorview.php';
		exit();
	}
	
	return $results;
}

function updateRecord($conn, $id, $lastName, $firstName, $emailAdd, $phone)
{
	try {
		$stmt = $conn->prepare("UPDATE phonebook SET lname=?,fname=?,email=?,phone=? WHERE id=?");
		$stmt->execute([$lastName,$firstName,$emailAdd,$phone,$id]);
		$count = $stmt->rowCount();
		if($count > 0){
			$message = "Update successful.";
		}else{
			$message = "Update failed.";
		}
	} catch (PDOException $e)
	{
		$sql = "UPDATE phonebook SET lname=".$lastName.",fname=".$firstName.",email=".$emailAdd.",phone=".$phone." WHERE id=".$id;
		$error['data'] = logError($sql,$e);
		include 'app.errorview.php';
		exit();
	}
	return $message;
}
function selectRecord($conn,$id){
	$result = array();
	try 
	{
		$stmt = $conn->prepare("SELECT * FROM phonebook WHERE id=?");
		$stmt->execute([$id]);
		while ($nextRow = $stmt->fetch()) $result[] = $nextRow;
	}
	catch (PDOException $e)
	{
		$sql = "SELECT * FROM phonebook WHERE id=".$id;
		$error['data'] = logError($sql,$e);
		include 'app.errorview.php';
		exit();
	}
	return $result;
}
function sortBy($conn,$field,$dir){
	$results = array();
	$sqlStr = "SELECT * FROM phonebook ORDER BY $field DESC";
	if($dir == "up"){
		$sqlStr = "SELECT * FROM phonebook ORDER BY $field ASC";
	}else{
		$sqlStr = "SELECT * FROM phonebook ORDER BY $field DESC";
	}
	try
	{
		$stmt = $conn->prepare($sqlStr);
		$stmt->execute();
		while ($nextRow = $stmt->fetch()) $results[] = $nextRow;
	}
	catch (PDOException $e)
	{
		$error['data'] = logError($sqlStr,$e);
		include 'app.errorview.php';
		exit();
	}
	
	return $results;
}
?>


