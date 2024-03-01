<?php
//Include config file
require_once 'config.php';

//Define variables and initialize with empty values
$name  = $phonenumber = "";
$name_err = $phonenumber_err = "";

//Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {

//    //Validate name
//    $input_name = trim($_POST["name"]);
//    if(empty($input_name)) {
//        $name_err = "Please enter a name.";
//    }elseif (!filter_var(trim($_POST["name"]), FILTER_VALIDATE_REGEXP, array("option" =>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))) {
//        $name_err = 'Please enter a valid name.';
//    }else{
//        $name = $input_name;
//    }
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var(trim($_POST["name"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
        $name_err = 'Please enter a valid name.';
    } else{
        $name = $input_name;
    }


    //Validate phone number
    $input_phonenumber = trim($_POST["phonenumber"]);
    if(empty($input_phonenumber)){
        $phonenumber_err = "Please enter the phone number.";

    }elseif (!ctype_digit($input_phonenumber)){
        $phonenumber_err = 'Please enter a positive integer value. ';
    }else{
        $phonenumber = $input_phonenumber;
    }

    //Check input errors before inserting in database
    if(empty($name_err) && empty($phonenumber_err)){
        //Prepare an insert statement
        $sql = "INSERT INTO phonecontact (name, phonenumber) VALUES (?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            //Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_phonenumber);

            //Set parameters
            $param_name = $name;

            $param_phonenumber = $phonenumber;

            //Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                //Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            }else{
                echo "Something went wrong. Please try again later.";
            }
        }
        //Close statement
        mysqli_stmt_close($stmt);
    }

//Close connection
    mysqli_close($link);
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
                <div class="page-header ">
                    <h2>Create Record</h2>
                </div>
                <p>Please fill this form and submit to add employee record to the database .</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"method="post">
                    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error': ''; ?>">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name; ?> ">
                        <span class="help-block"><?php echo $name_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($phonenumber_err)) ? 'has-error': ''; ?>">
                        <label>Phone Number</label>
                        <input type="text" name="phonenumber" class="form-control" value="<?php echo $phonenumber; ?> ">
                        <span class="help-block"><?php echo $phonenumber_err; ?></span>
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