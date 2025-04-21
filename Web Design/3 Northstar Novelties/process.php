<html><body>
<?php
$username="20205";
$password="me2bc78";
$database="orders";

$item=$_POST['item'];
$shiptofirstname=$_POST['shiptofirstname'];
$shiptolastname=$_POST['shiptolastname'];
$shiptocompany=$_POST['shiptocompany'];
$shiptoaddress=$_POST['shiptoaddress'];
$shiptocity=$_POST['shiptocity'];
$shiptostate=$_POST['shiptostate'];
$shiptozip=$_POST['shiptozip'];
$shiptophone=$_POST['shiptophone'];
$email=$_POST['email'];
$shiptocountry=$_POST['shiptocountry'];
$shipmentmethod=$_POST['shipmentmethod'];
$billtofirstname=$_POST['billtofirstname'];
$billtolastname=$_POST['billtolastname'];
$billtocompany=$_POST['billtocompany'];
$billtoaddress=$_POST['billtoaddress'];
$billtocity=$_POST['billtocity'];
$billtostate=$_POST['billtostate'];
$billtozip=$_POST['billtozip'];
$billtophone=$_POST['billtophone'];
$billtocountry=$_POST['billtocountry'];
$cardcompany=$_POST['cardcompany'];
$cardnumber=$_POST['cardnumber'];
$expdate=$_POST['expdate'];
$cvv=$_POST['cvv'];
$mesg=$_POST['mesg'];
$agreement=$_POST['agreement'];

mysql_connect(localhost,$20205,$me2bc78);
@mysql_select_db($orders) or die( "Unable to select database");

$query = "INSERT INTO orders VALUES ('','$shiptofirstname','$shiptolastname','$shiptocompany','$shiptoaddress','$shiptocity','$shiptostate','$shiptozip','$shiptophone','$email','$shiptocountry','$shipmentmethod','$billtofirstname','$billtolastname','$billtocompany','$billtoaddress','$billtocuty','$billtostate','$billtozip','$billtophone','$billtocountry','$cardcompany','$cardnumber','$expdate','$cvv','$mesg','$agreement')";
mysql_query($query);

mysql_close();
?>
</body></html>
