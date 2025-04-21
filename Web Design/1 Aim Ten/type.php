<html>
<head>
<title></title>
</head>

<body>

<form action="insert.php" method="post">
<fieldset align="left">
<input type="hidden" name="date" value="

<?php
echo date("m/d/y h:i A");
?>

"/>

<center>
<table border="1" width="300">
<tr>
<td colspan="2">
<br>
<font size="5"><center><b>Post to Guestbook</b></center></size>
<br>
</td>
</tr>
<tr>
<td width="85px" valign="center" align="right">
Name: 
</td>
<td>
<input type="text" name="name" class="name"/>
</td>
<tr>
<td width="85px" valign="center" align="right">
Message: 
</td>
<td>
<textarea type="text" name="message" class="message"/></textarea>
</td>
</tr>
<tr>
<td colspan="2">
<br>
<center><input type="submit" /></center>
<br>
</td>
</tr> 
</table>
</center>
</fieldset>
</form>

</body>
</html>