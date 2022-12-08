<?php
include "../src/functions.php";
echo "<br>";
task1(["a", "b"], false);
echo "<br>";
echo task1(["a", "b"], true);

echo "<br>";
echo task2('+', 1, 2, 3, 4);
echo "<br>";
echo task2('-', 1, 2, 3, 4);
echo "<br>";
echo task2('/', 1, 2, 3, 4);
echo "<br>";
echo task2('*', 1, 2, 3, 4);
echo "<br>";
echo task2('*', false, 2, 3, 4);

echo "<br>";
task3(2,2);
echo "<br>";
task3(-2,2);

echo "<br>";
task4();
echo "<br>";
task5();
echo "<br>";
task6();
echo "<br>";
