<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="UTF-8">
	    <title>Dashboard</title>
	    <?php require_once "includeLib.php"; ?>
	    <style type="text/css">
	        .wrapper{
	            width: 650px;
	            margin: 0 auto;
	        }

	        .page-header h2{
	            margin-top: 0;
	        }

	        table tr td:last-child a{
	            margin-right: 15px;
	        }
	    </style>
	    <script type="text/javascript">
	        $(document).ready(function(){
	            $('[data-toggle="tooltip"]').tooltip();   
	        });
	    </script>
	</head>
	<body>
	    <div class="wrapper">
	        <div class="container-fluid">
	            <div class="row">
	                <div class="col-md-12">
	                    <div class="page-header clearfix">
	                        <h2 class="pull-left">Employees Details</h2>
	                        <a href="create.php" class="btn btn-success pull-right">Add New Employee</a>
	                    </div>
	                    <?php
	                    // Include config file
	                    require_once "config.php";
	                    
	                    // Attempt select query execution
	                    $stid = oci_parse($conn, 'SELECT * FROM INV_EMP');
						oci_execute($stid);
	                   // if($result = oci_fetch_array($stid)){
				            // if(oci_num_rows($stid) > 0) {
				                echo "<table class='table table-bordered table-striped'>";
				                    echo "<thead>";
				                        echo "<tr>";
				                            echo "<th>#</th>";
				                            echo "<th>Name</th>";
				                            echo "<th>Address</th>";
				                            echo "<th>Salary</th>";
				                            echo "<th>Action</th>";
				                        echo "</tr>";
				                    echo "</thead>";
				                    echo "<tbody>";

				                    while($row = oci_fetch_array($stid)){
				                        echo "<tr>";
				                            echo "<td>" . $row['ID'] . "</td>";
				                            echo "<td>" . $row['NAME'] . "</td>";
				                            echo "<td>" . $row['ADDRESS'] . "</td>";
				                            echo "<td>" . $row['SALARY'] . "</td>";
				                            echo "<td>";
				                                echo "<a href='read.php?id=". $row['ID'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
				                                echo "<a href='update.php?id=". $row['ID'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
				                                echo "<a href='delete.php?id=". $row['ID'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
				                            echo "</td>";
				                        echo "</tr>";
				                    }
				                    echo "</tbody>";  
				                echo "</table>";
				                // Free result set
				                oci_free_statement($stid);
				            //}else{
				            //    echo "<p class='lead'><em>No records were found.</em></p>";
				            //}
				        //}else{
				        //    echo "ERROR: Could not able to execute $sql. " . oci_error();
				        //}
	                    ?>
	                </div>
	            </div>        
	        </div>
	    </div>
	</body>
</html>