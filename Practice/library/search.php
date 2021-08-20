<html lang="en">
<head>
    <title>Search | Library</title>
</head>

<body>
<?php
$title = '';
if(!empty($_POST['title'])){
    $title = $_POST['title'];
    echo "Finding record, {$_POST['title']}, and Result";

}
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    Enter your name: <input type="text" name="title" />
    <input type="submit" value="Search" />
</form>

<?php
$myDB = new mysqli('localhost', 'root', '', 'library');

if($myDB->connect_error)
{
    die('Connect Error (' . $myDB->connect_errno . ')'
        . $myDB->connect_error);
}

if($title != ''){
    $sql = "SELECT * FROM books WHERE avaiable = 1 AND title LIKE '%{$title}%' ORDER  BY title";
}else{
    $sql = "SELECT * FROM books WHERE avaiable = 1 ORDER BY title";
}
$result = $myDB->query($sql);
?>

<table cellspacing="2" cellpadding="6" align="center" border="1">
    <tr>
        <td colspan="6">
            <h3 align="center">These Books are currently available</h3>
        </td>
    </tr>

    <tr>
        <td align="center">BookID</td>
        <td align="center">AuthorID</td>
        <td align="center">Title</td>
        <td align="center">ISBN</td>
        <td align="center">Year Published</td>
        <td align="center">Available</td>
    </tr>
    <?php
    while ($row = $result->fetch_assoc()){
        echo "<tr>";
        echo "<td align='center'>";
        echo $row["bookid"];
        echo "</td><td align='center'>";
        echo $row["authorid"];
        echo "</td><td>";
        echo stripcslashes($row["title"]);
        echo "</td><td align='center'>";
        echo $row["ISBN"];
        echo "</td><td align='center'>";
        echo $row["pub_year"];
        echo "</td><td align='center'>";
        echo $row["available"];
        echo "</td>";
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>