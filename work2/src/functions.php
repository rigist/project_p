<?php

function task1($strs, $bool)
{
    $res = implode("\n", array_map(function (string $str) {
        return "<p>$str</p>";
    }, $strs));

    if ($bool) {
        return $res;
    }

    echo $res;
}
///////////////////////////////////////////////

function task2($type, ...$args)
{

    foreach ($args as $i => $arg) {
        if (!is_int($arg) && !is_float($arg)) {
            trigger_error( $i . ' аргумент не integer и не float');     
        }
    }	
     
    switch ($type) {
        case '+':
            return array_sum($args);
        case '-':
            return array_shift($args) - array_sum($args);
        case '/':
            $res = array_shift($args);
            foreach ($args as  $arg) {
                if ($arg == 0) {
                     
                    return 'Деление на ноль';
                }
                $res = $res / $arg;
            }
            return $res;
        case '*':
            $res = 1;
            foreach ($args as $arg) {
                $res *= $arg;
            }

            return $res;

        default:
            return 'Неизвестная операция';
    }
}


function task3($a, $b)
{
    if (!is_int($a)) {
        trigger_error('Первое число не целое');
        return false;
    }
    if (!is_int($b)) {
        trigger_error('Второе число не целое');
        return false;
    }

    if ($a < 0 || $b < 0) {
        trigger_error('Числа не положительны');
        return false;
    }

    $res = '<table>';
    for ($i = 1; $i <= $a; $i++) {
        $res .= '<tr>';
        for ($j = 1; $j <= $b; $j++) {
	    $res .= '<td>' . $i * $j . '</td>';	
        }
        $res .= '</tr>';
    }
    $res .= '</table>';
    echo $res;
}

function task4(){
    date_default_timezone_set('Europe/Moscow');
    echo date('d.m.Y H:i');
    echo '<br>';
    echo date('Y-m-d H:i:s', 1456261200);
    echo '<br>';
}

function task5(){
	echo str_replace('К', '', 'Карл у Клары украл Кораллы');
	echo '<br>';
	echo str_replace('Две', 'Три', 'Две бутылки лимонада');
}

function task6(){
    file_put_contents('test.txt', 'Hello again!');
    read_write_file('test.txt');
    function read_write_file($file){
            $fp = fopen($file, 'r');
            if (!$fp) {
                return false;
            }
        
            $str = '';
            while (!feof($fp)) {
                $str .= fgets($fp);
            }
        
            echo $str;
    }
}
