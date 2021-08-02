<?php
require_once 'config.php';
if(isset($_GET["search"]) && !empty($_GET["search"])) {
    $key = $_GET["search"];
    $sql = "SELECT * FROM people WHERE name LIKE '%$key%' OR f LIKE '%$key%' OR location LIKE '%$key%'";
}else{
    header("location: error.php");
    exit();
}
$result = mysqli_query($link, $sql);
?>

<!DOCTYPe html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css ">
        .wrappers{
            width: 890px;
            margin: 0 auto;
        }
        .center{
            text-align: center;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 style="text-align: center">Search Record</h2>
                <?php
                require_once 'config.php';
                echo "<table class='table table-bordered table-striped'>";
                echo"<thead>";
                echo "<tr>";
                echo "<th style='text-align: center'>ID</th>";
                echo "<th style='text-align: center'>Name</th>";
                echo "<th style='text-align: center'>Tel</th>";
                echo "<th style='text-align: center'>Address</th>";
                echo "<th style='text-align: center'>F</th>";
                echo "<th style='text-align: center'>Location</th>";
                echo "<th style='text-align: center'>Date</th>";
                echo "<th style='text-align: center'>Exit-date</th>";
                echo "<th style='text-align: center'>Action</th>";
                echo "</tr>";
                echo"</thead>";
                echo"<tbody>";
                while ($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td style='text-align: center'>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td style='text-align: right'>" . $row['tel'] . "</td>";
                    echo "<td style='text-align: right' >" . $row['address'] . "</td>";
                    echo "<td style='text-align: center'>" . $row['f'] . "</td>";
                    echo "<td>" . $row['location'] . "</td>";
                    echo "<td style='text-align: center'>" . $row['date'] . "</td>";
                    echo "<td style='text-align: center'>" . $row['exit'] . "</td>";
                    echo "<td style='text-align: center'>";
                    echo"<a href='read.php?id=". $row['id']
                        . "'title='View Record' data-toggle='toolip'>
                                        <span class='glyphicon glyphicon-eye-open'></span></a>";
                    echo"<a href='update.php?id=". $row['id']
                        . "'title='Update Record' data-toggle='toolip'>
                                        <span class='glyphicon glyphicon-pencil'></span></a>";
                    echo"<a href='delete.php?id=". $row['id']
                        . "'title='Delete Record' data-toggle='toolip'>
                                        <span class='glyphicon glyphicon-trash'></span></a>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                mysqli_free_result($result);
                ?>
                <p align="right" style="margin-right: 150px"><a href="index.php" class="btn btn-primary">Back</a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>

