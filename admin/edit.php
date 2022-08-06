<?php 

    session_start();

    require_once "../connection.php";

    if (isset($_POST['update'])) {

        $users_id = $_POST['users_id'];

        $id = $_POST['id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];

        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $line_id = $_POST['line_id'];

        $role = $_POST['role'];


        $sql = $conn->prepare("UPDATE users SET users_id = :users_id, firstname = :firstname, lastname = :lastname, email = :email, phone_number = :phone_number, line_id = :line_id, role = :role, img = :img WHERE id = :id");
        
        $sql->bindParam(":users_id", $users_id);

        $sql->bindParam(":id", $id);
        $sql->bindParam(":firstname", $firstname);
        $sql->bindParam(":lastname", $lastname);

        $sql->bindParam(":email", $email);
        $sql->bindParam(":phone_number", $phone_number);
        $sql->bindParam(":line_id", $line_id);

        $sql->bindParam(":role", $role);
        $sql->bindParam(":img", $fileNew);
        $sql->execute();

        if ($sql) {
            $_SESSION['success'] = "Data has been updated successfully";
            header("location: index.php");
        } else {
            $_SESSION['error'] = "Data has not been updated successfully";
            header("location: index.php");
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        .container {
            max-width: 550px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Data</h1>
        <hr>
        <form action="edit.php" method="post" enctype="multipart/form-data">
            <?php
                if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $stmt = $db->query("SELECT * FROM phplogin WHERE id = $id");
                        $stmt->execute();
                        $data = $stmt->fetch();
                }
            ?>

                <div class="mb-3">
                    <label for="id" class="col-form-label">ID:</label>
                    <input type="text" readonly value="<?php echo $data['id']; ?>" required class="form-control" name="id" >
                    <label for="username" class="col-form-label">ชื่อ:</label>
                    <input type="text" value="<?php echo $data['username']; ?>" required class="form-control" name="username" >
                    <input type="hidden" value="<?php echo $data['img']; ?>" required class="form-control" name="img2" >
                </div>

                <div class="mb-3">
                    <label for="email" class="col-form-label">อีเมล์:</label>
                    <input type="email" value="<?php echo $data['email']; ?>" required class="form-control" name="email">
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="col-form-label">เบอร์โทรศัพท์:</label>
                    <input type="text" value="<?php echo $data['phone_number']; ?>" required class="form-control" name="phone_number">
                </div>
                <div class="mb-3">
                    <label for="line_id" class="col-form-label">ไลน์ไอดี:</label>
                    <input type="text" value="<?php echo $data['line_id']; ?>" required class="form-control" name="line_id">
                </div>

                <div class="mb-3">
                    <label for="type" class="col-form-label">Select Type</label>
                    <div class="col-sm-12">
                        <select name="role" class="form-control">
                            <option value="" selected="selected">- Select Role -</option>
                            <option value="admin">Admin</option>
                            <option value="employee">Employee</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    </div>
                <hr>
                <a href="index.php" class="btn btn-secondary">Go Back</a>
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>
    </div>

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