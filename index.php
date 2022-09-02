<!DOCTYPE html>
<html>
<head>
<title>Bank database</title>

<style>

body
{
    background-image:url('https://image.freepik.com/free-vector/soft-green-watercolor-texture-elegant-background_1055-8764.jpg');
    background-size:cover;
    background-attachement:fixed;
}
table {
border-collapse: collapse;
width: 100%;
color: #588c7e;
font-family: monospace;
font-size: 25px;
text-align: left;
}
th {
background-color: #588c7e;
color: white;
}
tr:nth-child(even) {background-color: #f2f2f2}

</style>


</head>
<body>


<center>
<h1 style="font-size: 30px;"> 
Customer Details
</h1>
</center>


<table>
<tr>
<th> Cus_ID</th>
<th>Cus_Name</th>
<th>E-mail</th>
<th> Current_Balance</th>
</tr>

<?php

$conn = mysqli_connect("localhost", "root", "", "bankdatabase","3308");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM Customer_database";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["Cus_ID"]. "</td><td>" . $row["Cus_Name"] . "</td><td>" . $row["E-mail"]."</td><td>" . $row["Current_Balance"]. "</td></tr>";
}
echo "</table>";
} else { echo "No results"; }
$conn->close();
?>
</table>


<h2 style="font-size: 25px;">
   <br>
<center>
    Money Transfer
</center>
<br>
<form action="Transaction.php" method="post">
<center>
<label>Paider ID: </label>
<input type="number" name="Paider"/><br>

<label>Receiver ID: </label>
<input type="number" name="Receiver"/><br>

<label>Amount: </label>
<input type="number" name="Amount_Transferred"/><br>


<input type="submit" name=submit value="Submit"/>

</center>
</form>
</h2>


</body>
</html>