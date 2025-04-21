<html>
<head>
<title></title>
</head>

<body>

<fieldset align="right">
<?php
$con = mysql_connect("50.63.226.129
","tennisplaya0687","Fe98Bd87Ln8");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("tennisplaya0687", $con);

$result = mysql_query("SELECT * FROM guestbook");

echo "<table border='1'>
<tr>
<th colspan='3'><br>
<font size='5'>Supracentric's Guestbook</size><br><br>
</th>
</tr>
<tr>
<th>Date</th>
<th>Name</th>
<th>Message<th>
</tr>";while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['Date'] . "</td>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['Message'] . "</td>";
  echo "</tr>";
  }
echo "</table>";mysql_close($con);
?>
</fieldset>

</body>
</html>