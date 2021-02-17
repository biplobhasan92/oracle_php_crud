<?php

    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){    

        require_once "config.php";
        // echo $_GET["id"];
        $stid = oci_parse($conn, 'SELECT * FROM INV_EMP WHERE ID=:id');
        // oci_execute($stid);
        oci_bind_by_name($stid, ':id', $_GET["id"]);
        $r   = oci_execute($stid);  // executes and commits
        $row = oci_fetch_array($stid);
        if($r){
            $name   = $row["NAME"];
            $address= $row["ADDRESS"];
            $salary = $row["SALARY"];
        }else{
            header("location: error.php");
            exit();
        }
        oci_free_statement($stid);
        oci_close($conn);
    }else{
        header("location: error.php");
        exit();
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
    </head>
    <body>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header">
                            <h1>View Record</h1>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <p class="form-control-static"><?php echo $row["NAME"]; ?></p>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <p class="form-control-static"><?php echo $row["ADDRESS"]; ?></p>
                        </div>
                        <div class="form-group">
                            <label>Salary</label>
                            <p class="form-control-static"><?php echo $row["SALARY"]; ?></p>
                        </div>
                        <p><a href="index.php" class="btn btn-primary">Back</a></p>
                    </div>
                </div>        
            </div>
        </div>
    </body>
</html>