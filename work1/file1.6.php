<?php
echo '<table>';
for ($i = 1; $i <= 10; $i++) {
    echo '<tr>';
    for ($j = 1; $j <= 10; $j++) {
        $result = $i * $j;

        echo '<td>';
        if ($i % 2 == 0 && $j % 2 == 0) {
            echo "($result)";
        } elseif ($i % 2 !== 0 && $j % 2 !== 0) {
            echo "[$result]";
        } else {
            echo $result;
        }
        echo '</td>';
    }
    echo '</tr>';
}
echo '</table>';