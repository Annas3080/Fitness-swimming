<?php 

    session_start();

    if (isset($_SESSION['admin_login'])) {
        header("location: admin/admin_home.php");
    }

    if (isset($_SESSION['in_personnel_login'])) {
        header("location: in_personnel/in_personnel_home.php");
    }

    if (isset($_SESSION['student_login'])) {
        header("location: student/student_home.php");
    }
    
    if (isset($_SESSION['out_personnel_login'])) {
        header("location: out_personnel/out_personnel_home.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi Login PHP & PDO</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    
<div align="center">
    <h1 class="mt-5">Fitness and swimming pool for PSU sport complex</h1>

    <img src="psu.png"alt="PSU" width="7%" height="7%">
    <div class="container">
        <h1 class="mt-5" >ลงชื่อเข้าใช้งาน</h1>
        <hr>

        <?php if(isset($_SESSION['success'])) : ?>
            <div class="alert alert-success">
                <h3>
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>

        <?php if(isset($_SESSION['error'])) : ?>
            <div class="alert alert-danger">
                <h3>
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        
        <form action="login_db.php" method="post" class="form-horizontal my-5" style="width: 50%;" >
        <label for="email" class="col-sm-3 control-label">Email</label>
        <div class="col-sm-12">
            <input type="text" name="txt_email" class="form-control" required placeholder="Enter email">
        </div>
        
        <label for="password" class="col-sm-3 control-label">Password</label>
        <div class="col-sm-12">
            <input type="password" name="txt_password" class="form-control" required placeholder="Enter password">
        </div>

        <div class="form-group">
            <label for="type" class="col-sm-3 control-label">Select Type</label>
            <div class="col-sm-12">
                <select name="txt_role" class="form-control">
                    <option value="" selected="selected">- Select Role -</option>
                    <option value="admin">Admin</option>
                    <option value="student">Student</option>
                    <option value="in_personnel">In personnel</option>
                    <option value="out_personnel">Out personnel</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-12 mt-3">
                <input type="submit" name="btn_login" class="btn btn-success" style="auto" value="Login">
            </div>
        </div>

        <div class="form-group text-center">
            <!--<div class="col-sm-12 mt-3">
                You don't have a account register here? 
                <p><a href="register.php">Register Account</a></p>
            </div>-->
        </div>

        </form>
        
    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</div>        
</body>
</html>