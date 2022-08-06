<?php 
        session_start();

        require_once "../connection.php";
        if (!isset($_SESSION['admin_login'])) {
            header("location: ../index.php");
        }

        if (isset($_GET['delete'])) {
            $delete_id = $_GET['delete'];
            $deletestmt = $db->query("DELETE FROM phplogin WHERE id = $delete_id");
            $deletestmt->execute();
    
            if ($deletestmt) {
                echo "<script>alert('Data has been deleted successfully');</script>";
                $_SESSION['success'] = "Data has been deleted succesfully";
                header("refresh:1; url=admin_home.php");
            }
            
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

    <div class="text-center mt-5">
        <div class="container">

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

            <h1>Admin Page</h1>
            <hr>
        
            <h3>
                <?php if(isset($_SESSION['admin_login'])) { ?>
                Welcome, <?php echo $_SESSION['admin_login']; }?>
            </h3>
            <div class="col-md-20 d-flex justify-content-end">
            <a href="../register.php" class="btn btn-primary">Add User</a>
            <div>&nbsp;</div>
            <a href="../logout.php" class="btn btn-danger">Logout</a>
            
            </div>
            <div>
            &nbsp;
            </div>

            <?php if (isset($_SESSION['success'])) { ?>
            <div class="alert alert-success">
                <?php 
                    echo $_SESSION['success'];
                    unset($_SESSION['success']); 
                ?>
            </div>
        <?php } ?>
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger">
                <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']); 
                ?>
            </div>
        <?php } ?>
            <table class="table">
            <thead>
                <tr>
                    <th scope="col">ไอดี</th>
                    <th scope="col">ชื่อ-นามสกุล</th>
                    <th scope="col">อีเมล์</th>
                    <th scope="col">เบอร์โทรศัพท์</th>
                    <th scope="col">ไลน์ไอดี</th>
                    <th scope="col">Select Role</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $stmt = $db->query("SELECT * FROM phplogin");
                    $stmt->execute();
                    $phplogins = $stmt->fetchAll();

                    if (!$phplogins) {
                        echo "<p><td colspan='6' class='text-center'>No data available</td></p>";
                    } else {
                    foreach($phplogins as $phplogin)  {  
                ?>
                    <tr>
                        <th scope="row"><?php echo $phplogin['id']; ?></th>
                        <td><?php echo $phplogin['username']; ?></td>
                        <td><?php echo $phplogin['email']; ?></td>
                        <td><?php echo $phplogin['phone_number']; ?></td>
                        <td><?php echo $phplogin['line_id']; ?></td>
                        <td><?php echo $phplogin['role']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $phplogin['id']; ?>" class="btn btn-warning">Edit</a>
                            <a onclick="return confirm('Are you sure you want to delete?');" href="?delete=<?php echo $phplogin['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php }  } ?>
            </tbody>
        </div>
    </div>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        let imgInput = document.getElementById('imgInput');
        let previewImg = document.getElementById('previewImg');

        imgInput.onchange = evt => {
            const [file] = imgInput.files;
                if (file) {
                    previewImg.src = URL.createObjectURL(file)
            }
        }

    </script>
</body>
</html>