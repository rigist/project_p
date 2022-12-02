<?php

function task1(
      
      function add_name(){
         $array = array ("ivan","oleg","kolya","grigoriy","fedor");
         $a=rand(0,4);
         return $array[$a];
      }

      function add_user ($i){
         $user = array("id"=> $i, "name"=> add_name(), "age"=> rand(18, 45));
         return $user;
      };



      //echo add_user();

      $users = array();

      for ($i = 0; $i < 50; $i++) {
         
         array_push($users, add_user ($i));
         
      };

      //var_dump($users);

      $jusers = json_encode($users);

      file_put_contents("file.txt", $jusers);

      $newjusers = file_get_contents("file.txt");

      //var_dump($newjusers);

      $newusers = json_decode($newjusers);

      //var_dump((array) $newusers[0]);

      $users2 = array();

      for ($i = 0; $i < 50; $i++) {
         
         array_push($users2, (array) $newusers[$i] );
         
      };

      //var_dump($users2);

      $result = array();

      $sum = 0;

      for ($i = 0; $i < 50; $i++) {
         if(array_key_exists($users[$i]["name"], $result) == false){
            $result[$users[$i]["name"]] = 0;
         };
      };

      for ($i = 0; $i < 50; $i++) {
         if(array_key_exists($users[$i]["name"], $result)){
            $result[$users[$i]["name"]]++;
         };
         
         $sum += $users[$i]["age"];
      };

      $sum = $sum / 50;
      //var_dump($result);
      //var_dump($sum / 50);

      

      foreach ($result as $key => $elem) {
         echo "Количество пользователей с именем $key: $elem \n";
      }
      echo "Средний возраст пользователей: $sum \n";

   );
    

  //$user = array("id"=>"", "name"=>"", "age"=>"");

  
  
// function fff(){
//    $array = array ("ivan","oleg","kolya","grigoriy","fedor");
//    $a=rand(0,4);
//    return $array[$a];
// }

//echo fff();

//echo "\n"

//$user = array("id"=>"1", "name"=> fff(), "age"=> rand(18, 45));
//"\nt";
//echo $user["age"];
//echo array("id"=>"1", "name"=> "1", "age"=>"1");
//echo json_encode($user);
//json_decode
//https://www.php.net/manual/ru/function.json-decode.php
//echo $user;
 
  