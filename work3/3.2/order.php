<?php

CONST host = "localhost"; 
CONST db = "testdb1";
CONST login = "root";
CONST pass = "root";
CONST table_new = "burgers4";

if (isset($_POST["email"]) && $_POST["email"] !== "") {
  //echo "<br>";
  //var_dump($_POST["email"]);

  $email_new = $_POST["email"];

  //echo "<br>";
  //var_dump("addr: $_POST[street] $_POST[home] $_POST[part] $_POST[appt] $_POST[floor]");

  $addr_new = "ул. $_POST[street], д. $_POST[home], корп. $_POST[part], кв. $_POST[appt], эт. $_POST[floor]";

  if (testEmail($email_new) == false) {   
    add_user($email_new, $addr_new);   
  } else {
    update_user($email_new);
  }

  message($email_new);
}




function add_user($email_one, $adress_one)
{
  try {
    $conn3 = new PDO("mysql:host=localhost;dbname=testdb1", "root", "root");
    $sql3 = "INSERT INTO burgers4 (email, adress) VALUES (:useremail, :useradress)";
    
    $stmt3 = $conn3->prepare($sql3);
    
    $stmt3->bindValue(":useremail", $email_one);
    $stmt3->bindValue(":useradress", $adress_one);
    
    $affectedRowsNumber = $stmt3->execute();
    
    //if ($affectedRowsNumber > 0) {
      //echo "Data successfully added: name=" . $email_one . "  adress= " . $adress_one;
    //}
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



function update_user($email_one)
{
  try {
    
    $conn5 = new PDO("mysql:host=localhost;dbname=testdb1", "root", "root");
    $sql5 = "UPDATE burgers4 SET orders_count = orders_count+1 WHERE email = :useremail";

    $stmt5 = $conn5->prepare($sql5);
    $stmt5->bindValue(":useremail", $email_one);

    $stmt5->execute();;

    //echo "Обновлены строк: ";
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
   // echo ">>>>";
   // echo "<br>";
   // var_dump($stmt);

    if($stmt->rowCount() > 0){
      foreach ($stmt as $row) {
      //  echo "<br>";
      //  var_dump($row);
        $adr = $row["adress"];
        $n  = $row["orders_count"];
        $id_new = "$row[id]-$row[email]-$row[mydate]-$row[orders_count]";
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
 


if (false) {
  try {
    
    $conn = new PDO("mysql:host=localhost;dbname=testdb1", "root", "root");
    

    $sql = "create table burgers4 (id integer auto_increment primary key, email varchar(255) unique key, orders_count integer default '0', mydate datetime default current_timestamp, adress varchar(255));";

    $conn->exec($sql);
    echo "Tables has been created";
  } catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
  }
}