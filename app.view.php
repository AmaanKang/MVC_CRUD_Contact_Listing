<!DOCTYPE html>
<?php
include 'app.ctrl.php';
?>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
    <div class="container">
        <h1 class="text-center text-primary">Lab 2 Part B: CRUD</h1>
        <?php
        if($_REQUEST['act'] == 'Edit'){
            foreach($TPL['result'] as $row){
                $id = $_REQUEST['id'];
                $lastName = $row['lname'];
                $firstName = $row['fname'];
                $email = $row['email'];
                $phone = $row['phone'];
                $value = "Update";
                $text = "UPDATE LISTING";
            }
        }
        elseif($validCreate == 0 || $validUpdate == 0){
            $id = $_REQUEST['id'];
            $lastName = $_REQUEST['lastName'];
            $firstName = $_REQUEST['firstName'];
            $email = $_REQUEST['emailAdd'];
            $phone = $_REQUEST['phone'];
            if($validCreate == 0){
                $value = "Create";
                $text = "ADD NEW LISTING";
            }else{
                $value = "Update";
                $text = "UPDATE LISTING";
            }
        }
        else{
            if ($_REQUEST['act'] == 'Confirm') {
                foreach($TPL['result'] as $row){
                    $id = $row['id'];
                    $lname = $row['lname'];
                    $fname = $row['fname'];
                }
                $TPL['message'] = "Click <a href='app.view.php?act=Delete&id=".$_REQUEST['id']."'>here</a> if you really want to delete user: ".$fname." ".$lname."(".$id.")";
            }
            $id = "";
            $lastName = "";
            $firstName = "";
            $email = "";
            $phone = "";
            $value = "Create";
            $text = "ADD NEW LISTING";
        }
        ?>
        <h5 class="text-danger"><?=$TPL['message']?></h5>
        <form class="container border border-5 rounded-1" method="post">
            <h2 class="text-center">Contact Details</h2>
            <input type='text' name='id' value='<?=$id?>' hidden class="col-2"/>
            <label for='lastName'>Last Name: </label>
            <input type='text' class="form-control" name='lastName' value='<?=$lastName?>' required/><article>5-15 characters, no spaces</article>
            <label for='firstName'>First Name: </label>
            <input type='text' class="form-control" name='firstName' value='<?=$firstName?>' required/><article>characters, no spaces</article>
            <label for='emailAdd'>Email: </label>
            <input type='email' class="form-control" name='emailAdd' value='<?=$email?>' required/><article>valid Email (Ex: abc@abc.com)</article>
            <label for='phone'>Phone: </label>
            <input type='tel' class="form-control" name='phone' value='<?=$phone?>' required/><article>valid phone number (Ex: 123-4567)</article></br>
            <input type='text' name='act' value='<?=$value?>' hidden/>
            <input type='submit' class="btn btn-primary" value='<?=$text?>'/></br>
        </form>
        
        <table class="table table-bordered container table-light" style="margin-top:50px">
            <thead><h2 class="text-center">Contacts Database Listing</h2></thead>
            <tr class="table-dark">
                <th></th>
                <th>Contact ID 
                    <div><a class="text-decoration-none link-light fs-3" href='app.view.php?act=sortby&field=id&dir=up'><span>&#x2191;</span></a> 
                    <a class="text-decoration-none link-light fs-3" href='app.view.php?act=sortby&field=id&dir=down'><span>&#8595;</span></a></div></th>
                <th>Last Name 
                    <div><a class="text-decoration-none link-light fs-3" href='app.view.php?act=sortby&field=lname&dir=up'><span>&#x2191;</span></a> 
                    <a class="text-decoration-none link-light fs-3" href='app.view.php?act=sortby&field=lname&dir=down'><span>&#8595;</span></a></div></th>
                <th>First Name 
                    <div><a class="text-decoration-none link-light fs-3" href='app.view.php?act=sortby&field=fname&dir=up'><span>&#x2191;</span></a> 
                    <a class="text-decoration-none link-light fs-3" href='app.view.php?act=sortby&field=fname&dir=down'><span>&#8595;</span></a></div></th>
                <th>Email 
                    <div><a class="text-decoration-none link-light fs-3" href='app.view.php?act=sortby&field=email&dir=up'><span>&#x2191;</span></a> 
                    <a class="text-decoration-none link-light fs-3" href='app.view.php?act=sortby&field=email&dir=down'><span>&#8595;</span></a></div></th>
                <th>Phone 
                    <div><a class="text-decoration-none link-light fs-3" href='app.view.php?act=sortby&field=phone&dir=up'><span>&#x2191;</span></a> 
                    <a class="text-decoration-none link-light fs-3" href='app.view.php?act=sortby&field=phone&dir=down'><span>&#8595;</span></a></div></th>
            </tr>
        <?php
            foreach($TPL['results'] as $row){
                ?>
                <tr>
                    <td><a class="text-decoration-none" href='app.view.php?act=Edit&id=<?=$row['id']?>'>E</a> 
                    <a class="text-decoration-none" href='app.view.php?act=Confirm&id=<?=$row['id']?>'>D</a></td>
                    <td><?=$row['id']?></td>
                    <td><?=$row['lname']?></td>
                    <td><?=$row['fname']?></td>
                    <td><?=$row['email']?></td>
                    <td><?=$row['phone']?></td>
                </tr>
                <?php
            }
        ?>
        </table>
        <div>
            <ul>
                <li>
                <a class="text-success text-decoration-none" href="errorlog.txt">Error Log</a>
                </li>
                <li>
                <a class="text-success text-decoration-none" href="app.view.php?act=sortby&field=firstname&dir=up">Sort by column - firstname</a>
                </li>
            </ul>
        </div>
    </div>
    </body>
</html>