<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Danh Sach Nguoi Di Cach Ly</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
        .wrapper{
            width: 1200px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
            text-align: center;
        }
        .table tr td:last-child a{
            margin-right: 10px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function (){
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
                    <h2>Danh Sach Theo Doi Nguoi Di Cach Ly</h2>
                </div>
                <?php
                  require_once 'config.php';
                  $sql = "SELECT * FROM people";
                  if ($result = mysqli_query($link, $sql)){
                      if (mysqli_num_rows($result)>0){
                          echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<td>Id</td>";
                                    echo "<td>Name</td>";
                                    echo "<td>Telephone</td>";
                                    echo "<td>Address</td>";
                                    echo "<td>F</td>";
                                    echo "<td>Start Date</td>";
                                    echo "<td>End Date</td>";
                                    echo "<td>Location</td>";
                                    echo "<td>Action</td>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while ($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                    echo "<td>". $row['id'] ."</td>";
                                    echo "<td>". $row['name'] ."</td>";
                                    echo "<td>". $row['tel'] ."</td>";
                                    echo "<td>". $row['address'] ."</td>";
                                    echo "<td>". $row['F'] ."</td>";
                                    echo "<td>". $row['startDate'] ."</td>";
                                    echo "<td>". $row['endDate'] ."</td>";
                                    echo "<td>". $row['location'] ."</td>";
                                    echo "<td>";
                                    echo "<a href='read.php?id=". $row['id']
                                        ."' title='View Record' data-toogle='tooltip'>
                                            <span class='glyphicon glyphicon-eye-open'></span></a>";

                                    echo "<a href='update.php?id=". $row['id']
                                        ."' title='Update Record' data-toogle='tooltip'>
                                            <span class='glyphicon glyphicon-pencil'></span></a>";

                                    echo "<a href='delete.php?id=". $row['id']
                                        ."' title='Delete Record' data-toogle='tooltip'>
                                            <span class='glyphicon glyphicon-trash'></span></a>";
                                echo "<a href='search.php?id=". $row['id']
                                    ."' title='Search Record' data-toogle='tooltip'>
                                            <span class='glyphicon glyphicon-search'></span></a>";
                                    echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                          echo "</table>";
                          mysqli_free_result($result);
                      }else{
                          echo "<p class='lead'><em>No records were found</em></p>";
                      }
                  }else{
                      echo "ERROR: Could not able to excute $sql. " . mysqli_error($link);
                  }
                    mysqli_close($link);
                ?>
                <a href="create.php" class="btn btn-info pull-right">Add New</a>
            </div>
        </div>
    </div>
</div>
</body>