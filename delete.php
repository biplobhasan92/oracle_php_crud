<?php
    // Process delete operation after confirmation
    if(isset($_POST["id"]) && !empty($_POST["id"])){

        require_once "config.php";
        $id = $_POST["id"];
        $stid = oci_parse($conn, 'DELETE FROM INV_EMP WHERE ID=:id');
        oci_bind_by_name($stid, ':id', $id);
        $r = oci_execute($stid);
        if($r){
            header("location: index.php");
            exit();
        }else{
            echo "Oops! Something went wrong. Please try again later.";
        }
        oci_free_statement($stid);
        oci_close($conn);
    }else{
        if(empty(trim($_GET["id"]))){
            header("location: error.php");
            exit();
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
    <?php require_once "includeLib.php"; ?>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Delete Record</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Are you sure you want to delete this record?</p><br>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="index.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>