<?php
$myDB = new mysqli('localhost', 'root', '', 'library');
if($myDB->connect_error)
{
    die('Connect Error (' . $myDB->connect_errno . ') '
        . $myDB->connect_error);
}
$sql = "SELECT * FROM books";
$result = $myDB->query($sql);
?>
<table cellspacing="2" cellpadding="6" align="center" border="1">
    <tr>
        <td colspan="6">
            <h3 align="center">These Books are currently avaiable</h3>
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
