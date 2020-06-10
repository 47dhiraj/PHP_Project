<?php
session_start();
if (!$_SESSION['active']) {
    header('Location: ../login.php');
}

require_once '../database.php';
require_once '../Models/user_model.php';

if (!isset($_POST['yes_button'])) {
    $id = $_GET['id']; // value from url parameter
} else {
    $id = $_POST['id']; // value from hidden field

    $model = new Model();

    if ($model->user_delete($id)) {

        header('location: users.php');
    } else {
        $error = 'User could not be deleted.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delete</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div>

        <div class="left">
            <a href="../admin.php">

                <img src="../logo.jpg" style="width:185px; height:100px;">
            </a>
        </div>
        <div class="right">
            <a href="../logout.php" style="float: right;  padding: 2px;"><img src="../logout_logo.png" style="width:75px; height:100px;"></a>
            <h4>Delete Form</h4>
        </div>


    </div>

    <section id="sidebar">
        <nav class="menu">
            <a href="../Category/category.php">Categories</a>
            <a href="../Product/products.php">Products</a>
            <a href="users.php">Users</a>

        </nav>
    </section>



    <?php if (isset($error)) : ?>
        <p style="color: red"><?php echo $error; ?></p>
    <?php endif; ?>

    <br>
    <table align="center" width="50%" border="1" style="margin-left:450px; margin-top: 150px;">
        <tr>
            <th>S.N</th>
            <th>Image</th>
            <th>User</th>
            <th>Address</th>
            <th>Contact</th>
            <th>Delete Sure?</th>
        </tr>

        <?php
        if (isset($_REQUEST['id'])) {

            $database = new Database();

            $pid = $_REQUEST['id'];

            $parameters = ['id' => $id];

            $sql = "SELECT * FROM users WHERE id= :id";
            $rows = $database->fetchAll($sql, $parameters);

            $count = 0;
            foreach ($rows as $row) :
                $count++;
                ?>
                <tr style="text-align:center;">
                    <td> <?php echo $count; ?> </td>
                    <td style="width:100px; height: 96px;"  align="center"><img src="../images/<?php echo $row['image']; ?>" style="width:95px; height: 136px;"></td>  
                    <td> <?php echo $row['username']; ?> </td>
                    <td> <?php echo $row['address']; ?> </td>
                    <td> <?php echo $row['contact']; ?> </td>

                    <td>
                        <form action="" method="POST">
                            <input type="hidden" name="id" value="<?php if (isset($id)) echo $id; ?>">

                            <input type="submit" name="yes_button" value="Yes">

                        </form>
                        <a href="users.php"><input type="submit" value="n o"> </a>
                    </td>

                </tr>
        <?php endforeach;
        } else {
            header('location:users.php');
        }

        ?>

    </table>
</body>

</html>