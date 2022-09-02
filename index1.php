<!DOCTYPE html>
<html>
<head>
<title>Bank database</title>

<style>
body
{
    background-image:url('https://png.pngtree.com/thumb_back/fw800/back_our/20190620/ourmid/pngtree-do-not-hurt-hair-dryer-promotion-main-map-image_145089.jpg');
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
<h1 style="font-size: 50px; color: white;"> 
Available Balanace
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
</body>
</html>


<html>
<style>

.button
{
border:none;
color: black;
background-color: gray;
padding: 15px 32px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 16px;
margin: 4px 2px;
cursor: pointer;

</style>
<body>

<br>
<a href='http://localhost/PHPinVScode/BankManagementSystem/Transaction_History.php'>

  <p style="text-align:center;">
    <button  class="button" >
        Continue
    </button> 
</p>


</a>
</body>
</html>
