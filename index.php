<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body class='container mt-5'>
    
<?php
session_start();
session_destroy();
 $emailmsg="";
 $pasdmsg="";
 $msg="";

 $ademailmsg="";
 $adpasdmsg="";


 if(!empty($_REQUEST['ademailmsg'])){
    $ademailmsg=$_REQUEST['ademailmsg'];
 }

 if(!empty($_REQUEST['adpasdmsg'])){
    $adpasdmsg=$_REQUEST['adpasdmsg'];
 }

 if(!empty($_REQUEST['emailmsg'])){
    $emailmsg=$_REQUEST['emailmsg'];
 }

 if(!empty($_REQUEST['pasdmsg'])){
  $pasdmsg=$_REQUEST['pasdmsg'];
}

if(!empty($_REQUEST['msg'])){
    $msg=$_REQUEST['msg'];
 }

 ?>
<div class="container login-container">
<h4><?php echo $msg?></h4>
            <div class="row">
                <div class="col-md-6 login-form-1">
                    <h3>Student Form</h3>
                    <form action="login_server_page.php" method="post">
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" name="login_email" placeholder="Your Email *" value="" />
                            <Label style="color:red"><?php echo $emailmsg?></label>
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" class="form-control" name="login_pasword" placeholder="Your Password *" value="" />
               
                            <Label style="color:red"><?php echo $pasdmsg?></label>
                        </div>
                        <div class="form-group mb-3">
                            <input type="submit" class="btnSubmit" value="Login" />
                        </div>
                        <div class="form-group mb-3">
                            <a href="#" class="ForgetPwd">Forget Password?</a>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 login-form-2">
                    <h3>Admin Form </h3>
                    <form action="loginadmin_server_page.php" method="post">
                        <div class="form-group mb-3">
                            <input type="text" class="form-control"  name="login_email" placeholder="Your Email *" value="" />
                            <Label style="color:red"><?php echo $ademailmsg?></label>
                        </div>
                        
                        <div class="form-group mb-3">
                            <input type="password" class="form-control" name="login_pasword" placeholder="Your Password *" value="" />
                            <Label style="color:red"><?php echo $adpasdmsg?></label>
                        </div>
                        <div class="form-group mb-3">
                            <input type="submit" class="btnSubmit" value="Login" />
                        </div>
                        <div class="form-group mb-3">
                            <a href="#" class="ForgetPwd" value="Login">Forget Password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>








<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>