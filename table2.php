<?php
$mysqli = new mysqli("127.0.0.1", "bloger", "mysql","firstbase");
$mysqli->query("SET NAMES 'utf8");

function printResultSet($row)
{
    echo "<table>";
    echo "<tr>" . "<td>" . 'id_product' . "</td>" . "<td>" .   'client' . "</td>" .  "<td>" . 'e-mail' . "</td>" . "<td>" . 'comment' . "</td>" . "<td>" . 'date_ordering' . "</td>" . "</tr>";
    foreach ($row as $app)
    {
        echo  "<tr>" . "<td>" . $app['id_product'] . "</td>" . "<td>" .   $app['client'] . "</td>" .  "<td>" . $app['e-mail'] . "</td>" . "<td>" . $app['comment'] . "</td>" . "<td>" . date('d.m.Y', $app['date_ordering']) . "</td>" . "</tr>";
    }
    echo "</table>";
}
$result_set = $mysqli->query("SELECT * FROM `ordering`");
$row = $result_set->fetch_assoc();
echo printResultSet($result_set);

$mysqli->close();
?>
<style>
    table, td {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 5px;
    }
</style>