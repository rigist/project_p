<?php

CONST HOST = "localhost"; 
CONST DB = "testdb1";
CONST LOGIN = "root";
CONST PASS = "root";
CONST TABLE_NEW = "burgers4";

if (isset($_POST["email"]) && $_POST["email"] !== "") {

  $email_new = $_POST["email"];

  $addr_new = "ул. " . $_POST["street"] . ", д. " . $_POST["home"] . ", корп. " . $_POST["part"] . ", кв. " . $_POST["appt"] . ", эт. " . $_POST["floor"];

  if (testEmail($email_new) == false) {   
    addUser($email_new, $addr_new);   
  } else {
    updateUser($email_new);
  }

  message($email_new);
}

function addUser($email_one, $adress_one)
{
  try {
    $conn3 = new PDO("mysql:host=localhost;dbname=testdb1", "root", "root");
    $sql3 = "INSERT INTO burgers4 (email, adress) VALUES (:useremail, :useradress)";
    
    $stmt3 = $conn3->prepare($sql3);
    
    $stmt3->bindValue(":useremail", $email_one);
    $stmt3->bindValue(":useradress", $adress_one);
    
    $affectedRowsNumber = $stmt3->execute();
    
  } catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
  }
} //add_user

function testEmail($test_email)
{

  try {
    $conn4 = new PDO("mysql:host=localhost;dbname=testdb1", "root", "root");
    $sql4 = "SELECT email FROM burgers4";
    $result4 = $conn4->query($sql4);

    $test_bool = false;

    while ($row = $result4->fetch()) {
      if ($test_email == $row["email"]) {
        $test_bool = true;
      }
    }

    return $test_bool;
  } catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
  }
} // testEmail

function updateUser($email_one)
{
  try {
    
    $conn5 = new PDO("mysql:host=localhost;dbname=testdb1", "root", "root");
    $sql5 = "UPDATE burgers4 SET orders_count = orders_count+1 WHERE email = :useremail";

    $stmt5 = $conn5->prepare($sql5);
    $stmt5->bindValue(":useremail", $email_one);

    $stmt5->execute();;

  } catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
  }
} 

function message ($email_two){
  try {
    $conn = new PDO("mysql:host=localhost;dbname=testdb1", "root", "root");
    $sql = "SELECT * FROM burgers4 WHERE email = :useremail";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":useremail", $email_two);
    $stmt->execute();

    if($stmt->rowCount() > 0){
      foreach ($stmt as $row) {
        $adr = $row["adress"];
        $n  = $row["orders_count"];
        $id_new = $row["id"] . "-" . $row["email"] . "-" . $row["mydate"] . "-" . $row["orders_count"];
      }
    }

    $n += 1;
     
    echo "<br>";
    echo "Спасибо, ваш заказ будет доставлен по адресу: $adr";
    echo "<br>";
    echo "Номер вашего заказа: #$id_new";
    echo "<br>";
    echo "Это ваш $n-й заказ!"; 
    }
    catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    }
}
 
