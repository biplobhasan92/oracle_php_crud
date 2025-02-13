<?php
	require_once "config.php";

	$name = $address = $salary = "";
    $name_err = $address_err = $salary_err = "";


    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        // Validate name
        $input_name = trim($_POST["name"]);
        if(empty($input_name)){
            $name_err = "Please enter a name.";
        }elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
            $name_err = "Please enter a valid name.";
        }else{
            $name = $input_name;
        }

    
        // Validate address
        $input_address = trim($_POST["address"]);
        if(empty($input_address)){
            $address_err = "Please enter an address.";
        }else{
            $address = $input_address;
        }
    

        // Validate salary
        $input_salary = trim($_POST["salary"]);
        if(empty($input_salary)){
            $salary_err = "Please enter the salary amount.";
        }elseif(!ctype_digit($input_salary)){
            $salary_err = "Please enter a positive integer value.";
        }else{
            $salary = $input_salary;
        }
    	


        // Check input errors before inserting in database
        if(empty($name_err) && empty($address_err) && empty($salary_err)){
            // Prepare an insert statement
           	// $sql  = oci_parse($conn, 'INSERT INTO employees(name, address, salary) VALUES(?, ?, ?)');
			$stid = oci_parse($conn, 'INSERT INTO inv_emp(id, name, address, salary) VALUES((select NVL(max(id)+1, 1) from inv_emp), :name, :address, :salary)');
            // Close statement
			oci_bind_by_name($stid, ':name', $name);
			oci_bind_by_name($stid, ':address', $address);
			oci_bind_by_name($stid, ':salary', $salary);
			$r = oci_execute($stid);  // executes and commits
			if($r){
			    header("location: index.php");
                exit();
            }else{
                echo "Something went wrong. Please try again later.";
            }
			oci_free_statement($stid);
			oci_close($conn);
        }
	}
?>





<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Create Record</title>
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
                            <h2>Create Record</h2>
                        </div>
                        <p>Please fill this form and submit to add employee record to the database.</p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                                <span class="help-block"><?php echo $name_err;?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                                <label>Address</label>
                                <textarea name="address" class="form-control"><?php echo $address; ?></textarea>
                                <span class="help-block"><?php echo $address_err;?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($salary_err)) ? 'has-error' : ''; ?>">
                                <label>Salary</label>
                                <input type="text" name="salary" class="form-control" value="<?php echo $salary; ?>">
                                <span class="help-block"><?php echo $salary_err;?></span>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Submit">
                            <a href="index.php" class="btn btn-default">Cancel</a>
                        </form>
                    </div>
                </div>        
            </div>
        </div>
    </body>
</html>