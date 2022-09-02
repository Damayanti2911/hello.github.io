
<?php

$Paider= $_POST['Paider'];
$Receiver= $_POST['Receiver'];
$Amount_Transferred=$_POST['Amount_Transferred'];

$conn = new mysqli("localhost", "root", "", "bankdatabase","3308");
if($conn -> connect_error)
{
    die('connection failed: ' .$conn->connect_error);

}
else{
    $stmt = $conn->prepare("insert into transaction_table(Paider,Receiver,Amount_Transferred) values(?,?,?)");
    $stmt-> bind_param("iii",$Paider,$Receiver,$Amount_Transferred);
    $stmt->execute();
    //echo "Successfully connected...";
    $stmt -> close();
    $conn -> close();
}


?>



<?php

/**
 * PHP MySQL Transaction Demo
 */
class TransactionDemo {

    const DB_HOST = 'localhost:3308';
    const DB_NAME = 'bankdatabase';
    const DB_USER = 'root';
    const DB_PASSWORD = '';

    /**
     * Open the database connection
     */
    public function __construct() {
        // open database connection
        $conStr = sprintf("mysql:host=%s;dbname=%s", self::DB_HOST, self::DB_NAME);
        try {
            $this->pdo = new PDO($conStr, self::DB_USER, self::DB_PASSWORD);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * PDO instance
     * @var PDO 
     */
    private $pdo = null;

    /**
     * Transfer money between two accounts
     * @param int $from
     * @param int $to
     * @param float $amount
     * @return true on success or false on failure.
     */
    public function transfer($from, $to, $Current_Balance) {

        try {
            $this->pdo->beginTransaction();

            // get available amount of the transferer account
            $sql = 'SELECT Current_Balance FROM customer_database WHERE Cus_ID=:from';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(array(":from" => $from));
            $availableAmount = (int) $stmt->fetchColumn();
            $stmt->closeCursor();

            if ($availableAmount < $Current_Balance) {
                ?>
                <h2  style="font-size: 40px">
                <center>
                <br><br><br><br><br><br>
                    Insufficient amount to transfer
                </center>
                 </h2>
                 <br>
                <p style="text-align:center;">
                         <img src="https://st3.depositphotos.com/3356953/14145/v/600/depositphotos_141459568-stock-illustration-emoticon-smiley-with-thumb-down.jpg" width="300px" height="250px" class="center">
                   </p>
                
                <?php
                return false;
            }
            // deduct from the transferred account
            $sql_update_from = 'UPDATE customer_database
				SET Current_Balance = Current_Balance - :Current_Balance
				WHERE Cus_ID = :from';
            $stmt = $this->pdo->prepare($sql_update_from);
            $stmt->execute(array(":from" => $from, ":Current_Balance" => $Current_Balance));
            $stmt->closeCursor();

            // add to the receiving account
            $sql_update_to = 'UPDATE customer_database
                                SET Current_Balance = Current_Balance + :Current_Balance
                                WHERE Cus_ID = :to';
            $stmt = $this->pdo->prepare($sql_update_to);
            $stmt->execute(array(":to" => $to, ":Current_Balance" => $Current_Balance));

            // commit the transaction
            $this->pdo->commit();
            ?>

            <h2 style="font-size: 40px">
                <center>
                    <br><br><br><br><br><br>
                    The Amount has been transferred successfully
                 </center>
                </h2>
                <br>
            <p style="text-align:center;">
            <img src="http://www.i2symbol.com/pictures/emojis/a/f/f/2/aff22723ab391b694c9bcae65ee2da76_384.png" width="200px" height="200px" class="center">
        </p>
            <?php

            return true;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            die($e->getMessage());
        }
    }

    /**
     * close the database connection
     */
    public function __destruct() {
        // close the database connection
        $this->pdo = null;
    }

}




$obj = new TransactionDemo();

// transfer 30K from from account 1 to 2
$obj->transfer($Paider,$Receiver,$Amount_Transferred);

?>

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


<a href='http://localhost/PHPinVScode/BankManagementSystem/index1.php'>

  <p style="text-align:center;">
    <button  class="button" >
        Continue
    </button> 
</p>


</a>
</body>
</html>



