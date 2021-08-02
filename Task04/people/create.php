<?php
require_once 'config.php';

$name = $telephone = $address = $F = $startDate = $endDate = $location = "";
$name_err = $telephone_err = $address_err = $F_err = $startDate_err = $endDate_err = $location_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //Validate name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)){
        $name_err = "Please enter a name.";
    }elseif (!filter_var(trim($_POST["name"]), FILTER_VALIDATE_REGEXP,
        array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s]+$/")))){
        $name_err = 'Please enter a valid name.';
    }else{
        $name = $input_name;
    }

    //Validate telephone
    $input_telephone = trim($_POST["telephone"]);
    if (empty($input_telephone)){
        $telephone_err = "Please enter telephone number";
    }else{
        $telephone = $input_telephone;
    }

    //Validate address
    $input_address = trim($_POST["address"]);
    if (empty($input_address)){
        $address_err = "Please enter an address";
    }else{
        $address = $input_address;
    }

    //Validate F
    $input_F = trim($_POST["F"]);
    if (empty($input_F)){
        $F_err = "Please enter F";
    }else{
        $F = $input_F;
    }

    //Validate start date
    $input_startDate = trim($_POST["startDate"]);
    if (empty($input_startDate)){
        $startDate_err = "Please enter start date";
    }else{
        $startDate = $input_startDate;
    }

    //Validate end date
    $input_endDate = trim($_POST["endDate"]);
    if (empty($input_endDate)){
        $endDate_err = "Please enter end date";
    }else{
        $endDate = $input_endDate;
    }

    //Validate location
    $input_location = trim($_POST["location"]);
    if (empty($input_location)){
        $location_err = "Please enter a location";
    }else{
        $location = $input_location;
    }

    if (empty($name_err) && empty($telephone_err) && empty($address_err) && empty($F_err) && empty($startDate_err) && empty($endDate_err) && empty($location_err)){
        $sql = "INSERT INTO people (name, tel, address, F, startDate, endDate, location) VALUES (?, ?, ?, ?, ?, ?, ?);";
        if ($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sssssss", $param_name, $param_telephone, $param_address, $param_F, $param_startDate, $param_endDate, $param_location);

            $param_name = $name;
            $param_telephone = $telephone;
            $param_address = $address;
            $param_F = $F;
            $param_startDate = $startDate;
            $param_endDate = $endDate;
            $param_location = $location;

            if (mysqli_stmt_execute($stmt)){
                header("location: index.php");
                exit();
            }else{
                echo "Something went wrong. Please try again later";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style type="text/css">
        .wrapper{
            width: 700px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div clas="col-md-12">
                <div class="page-header">
                    <h2>Add New Record</h2>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="">
                        <span class="help-block"><?php echo $name_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($telephone_err)) ? 'has-error' : ''; ?>">
                        <label>Telephone</label>
                        <input type="text" name="telephone" class="form-control" value="">
                        <span class="help-block"><?php echo $telephone_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" value="">
                        <span class="help-block"><?php echo $address_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($F_err)) ? 'has-error' : ''; ?>">
                        <label>F</label>
                        <input type="text" name="F" class="form-control" value="">
                        <span class="help-block"><?php echo $F_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($startDate_err)) ? 'has-error' : ''; ?>">
                        <label>Start Date (y/m/d)</label>
                        <input type="text" name="startDate" class="form-control" value="">
                        <span class="help-block"><?php echo $startDate_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($endDate_err)) ? 'has-error' : ''; ?>">
                        <label>End Date (y/m/d)</label>
                        <input type="text" name="endDate" class="form-control" value="">
                        <span class="help-block"><?php echo $endDate_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($location_err)) ? 'has-error' : ''; ?>">
                        <label>Location</label>
                        <input type="text" name="location" class="form-control" value="">
                        <span class="help-block"><?php echo $location_err; ?></span>
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