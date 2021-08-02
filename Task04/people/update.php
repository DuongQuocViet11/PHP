<?php
require_once 'config.php';

$name = $telephone = $address = $F = $startDate = $endDate = $location = "";
$name_err = $telephone_err = $address_err = $F_err = $startDate_err = $endDate_err = $location_err = "";

if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];


//Validate name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    } elseif (!filter_var(trim($_POST["name"]), FILTER_VALIDATE_REGEXP,
        array("options" => array("regexp" => "/^[a-zA-Z'-.\s]+$/")))) {
        $name_err = 'Please enter a valid name.';
    } else {
        $name = $input_name;
    }

//Validate telephone
    $input_telephone = trim($_POST["telephone"]);
    if (empty($input_telephone)) {
        $telephone_err = "Please enter telephone number";
    } else {
        $telephone = $input_telephone;
    }

//Validate address
    $input_address = trim($_POST["address"]);
    if (empty($input_address)) {
        $address_err = "Please enter an address";
    } else {
        $address = $input_address;
    }

//Validate F
    $input_F = trim($_POST["F"]);
    if (empty($input_F)) {
        $F_err = "Please enter F";
    } else {
        $F = $input_F;
    }

//Validate start date
    $input_startDate = trim($_POST["startDate"]);
    if (empty($input_startDate)) {
        $startDate_err = "Please enter start date";
    } else {
        $startDate = $input_startDate;
    }

//Validate end date
    $input_endDate = trim($_POST["endDate"]);
    if (empty($input_endDate)) {
        $endDate_err = "Please enter end date";
    } else {
        $endDate = $input_endDate;
    }

//Validate location
    $input_location = trim($_POST["location"]);
    if (empty($input_location)) {
        $location_err = "Please enter a location";
    } else {
        $location = $input_location;
    }

    if (empty($name_err) && empty($telephone_err) && empty($address_err) && empty($F_err) && empty($startDate_err) && empty($endDate_err) && empty($location_err)) {
        $sql = "UPDATE people SET name=?, tel=?, address=?, F=?, startDate=?, endDate=?, location=? WHERE id=?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssssss", $param_name, $param_telephone, $param_address, $param_F, $param_startDate, $param_endDate, $param_location);

            $param_name = $name;
            $param_telephone = $telephone;
            $param_address = $address;
            $param_F = $F;
            $param_startDate = $startDate;
            $param_endDate = $endDate;
            $param_location = $location;

            if (mysqli_stmt_execute($stmt)) {
                header("location: index.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}else{
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        //Get URL parameter
        $id = trim($_GET["id"]);

        //Prepare a select statement
        $sql="SELECT * FROM people WHERE id = ?";
        if ($stmt = mysqli_prepare($link, $sql)){
            //Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            //Set parameters
            $param_id = $id;

            //Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    //Retrieve individual field value
                    $name = $row["name"];
                    $telephone = $row["tel"];
                    $address = $row["address"];
                    $F = $row["F"];
                    $startDate = $row["startDate"];
                    $endDate = $row["endDate"];
                    $location = $row["location"];
                }else{
                    header("location: error.php");
                    exit();
                }
            }else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        //Close statement
        mysqli_stmt_close($stmt);

        //Close connection
        mysqli_close($link);
    }else{
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
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
                    <h2>Update Record</h2>
                </div>
                <p>Please edit the input values and submit to update the record.</p>
                <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                        <span class="help-block"><?php echo $name_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($telephone_err)) ? 'has-error' : ''; ?>">
                        <label>Telephone</label>
                        <input type="text" name="telephone" class="form-control" value="<?php echo $telephone; ?>" >
                        <span class="help-block"><?php echo $address_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                        <label>Address</label>
                        <textarea name="address" class="form-control"><?php echo $address; ?></textarea>
                        <span class="help-block"><?php echo $address_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($F_err)) ? 'has-error' : ''; ?>">
                        <label>F</label>
                        <input type="text" name="F" class="form-control" value="<?php echo $F; ?>">
                        <span class="help-block"><?php echo $F_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($startDate_err)) ? 'has-error' : ''; ?>">
                        <label>Start Date</label>
                        <input type="text" name="startDate" class="form-control" value="<?php echo $startDate; ?>">
                        <span class="help-block"><?php echo $startDate_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($endDate_err)) ? 'has-error' : ''; ?>">
                        <label>End Date</label>
                        <input type="text" name="endDate" class="form-control" value="<?php echo $endDate; ?>">
                        <span class="help-block"><?php echo $endDate_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($location_err)) ? 'has-error' : ''; ?>">
                        <label>Location</label>
                        <input type="text" name="location" class="form-control" value="<?php echo $location; ?>">
                        <span class="help-block"><?php echo $location_err; ?></span>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="index.php" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>




