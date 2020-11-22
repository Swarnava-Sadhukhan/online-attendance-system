<?php
  //include_once 'header_h.php';
?>

<?php
	//include_once 'roles.php';
?>

<?php
    $eid=$_SESSION['employee_id'];
?>
<form action = "change_dp.php" method = "POST" enctype = "multipart/form-data">
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>UPLOAD YOUR DP</h2>
            </div>
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                       
                        <div class="body">

<h2 class="card-inside-title">Image:</h2>


                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" name="file">
                                            <center>
                                                <input class="btn btn-primary waves-effect" name="submit" type="submit" value="SUBMIT"> 
                                                <input type="reset" name="close" class="btn btn-primary waves-effect" value="RESET" >
                                            </center>
                        
    </section>
</form>

<?php
    if(isset($_POST["submit"])) 
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
                    $fileNameNew = $eid.".".$fileActualExt;
                    $fileDestination = 'images/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    #echo '<script language="javascript">';
                    #echo 'alert("DP updated")';
                    #echo "</script>";
                    sleep(3);
                    header("location:./dashbord.php?uploadsuccess");
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

<?php
	include_once 'footer_h.php';
?>