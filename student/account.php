<?php
    ob_start();
    session_start();

    if($_SESSION['name']!='oasis')
    {
        header('location: ../login.php');
    }
    include('connect.php');
?>
<?php 
    try
    {
        if(isset($_POST['done']))
        {
            if (empty($_POST['name']))
                throw new Exception("Name cannot be empty");
            if (empty($_POST['dept']))
                throw new Exception("Department cannot be empty");
            if(empty($_POST['batch']))
                throw new Exception("Batch cannot be empty");
            if(empty($_POST['email']))
                throw new Exception("Email cannot be empty");
            
            $sid = $_POST['id'];
            $result = mysqli_query($con,"update students set st_name='$_POST[name]',st_dept='$_POST[dept]',st_batch='$_POST[batch]',st_sem='$_POST[semester]', st_email = '$_POST[email]' where st_id='$sid'");
            $success_msg = 'Updated  successfully';

        }

    }
    catch(Exception $e)
    {
        $error_msg =$e->getMessage();
    }


?>
<!DOCTYPE html>

<head>
    <title>Attendance Management System</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/main1.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
</head>

<body>
	<?php
		include ('../includes/header.php');
    ?>
    <div class="container">
        <div class="col-xs-1">
        </div>
        <div class="col-xs-10 banner_image">
            <div class="inner row">
                <div class="col-xs-3">
                    <div class="vertical_menu">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="students.php">Students</a></li>
                                <li><a href="report.php">My Report</a></li>
                                <li><a style="background-color: #4caf50;"  href="account.php">My Account</a></li>
                                <li><a href = "../logout.php"><span class = "glyphicon glyphicon-log-out"></span> Log out</a></li>
                    </div>
                </div> 
                <div class="col-xs-9">
                    <div class="content2">
                            
                                <p>
                                    <?php
                                        if(isset($success_msg))
                                            echo $success_msg;
                                        if(isset($error_msg))
                                            echo $error_msg;
                                    ?>
                                </p>
                                <br>

                                <?php
                                    $filename="";
                                    $sr_id = $_SESSION['id'];
                                    $result = mysqli_query($con,"select * from students where st_id='$sr_id'");
                                    $data = mysqli_fetch_array($result);
                                    $i=0;
                                    $filename="images/".$sr_id.".jpg";
                                ?>
                                
                                <div class="row look">
                                    <div class="col-xs-4 card">
                                        <?php 
                                        echo "<img class=\"card_img\" src=".$filename." alt=\"Card image\">";
                                        ?>
                                    </div>
                                    <div class="col-xs-8 card_body">
                                        <h3 class="card-title"><?php echo "<b>".$data['st_name']."</b>";?></h3>
                                        <p class="card-text"><?php echo "Enrollment ID - <b>".$sr_id."</b>";?></p>
                                        <p class="card-text"><?php echo "Department - <b>".$data['st_dept']."</b>, Semester - <b>".$data['st_sem']."</b>";?></p>
                                        <p class="card-text"><?php echo "Email - <b>".$data['st_email']."</b>";?></p>
                                        
                                    </div>
                                </div>
								<form id = "dp" action="account.php" method="POST" enctype = "multipart/form-data" style="padding-bottom:5px">
									<input type="file" id="img" name="file" style="padding-top:5px;padding-left:10px">
									<button type="submit" name="dp_change" class="btn btn-info" style="width:30%;float:left;margin-left:10px;">Change Picture</button>
								</form>
								<?php
    if(isset($_POST["dp_change"])) 
    {

        $file = $_FILES['file'];

        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');
        
        if(in_array($fileActualExt, $allowed))
        {
            if($fileError === 0)
            {
                if($fileSize <= 1000000)
                {
                    $fileNameNew = $sr_id.".".$fileActualExt;
                    $fileDestination = 'images/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    echo '<script language="javascript">';
                    echo 'alert("DP updated")';
                    echo "</script>";
                    //sleep(3);
                    //header("location:./dashbord.php?uploadsuccess");
                }
                else    
                {
                    echo '<script language="javascript">';
                    echo 'alert("Image size limit : 1MB!")';
                    echo "</script>";
                }
                    
            }
            else
            {
                echo '<script language="javascript">';
                echo 'alert("Error in uploading!")';
                echo "</script>";
            }
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Choose among jpg, jpeg and png!")';
            echo "</script>";
        }
    }
	?>
                            
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-1">
        </div>
    </div>
	

	<?php
		include ('../includes/footer.php');
	?>
</body>

</html>
