<?php
$mysqli = new mysqli("127.0.0.1", "bloger", "mysql","firstbase");
$mysqli->query("SET NAMES 'utf8");

function printResultSet($row)
{
    echo "<table>";
        echo "<tr>" . "<td>" . 'product_name' . "</td>" . "<td>" .   'product_description' . "</td>" .  "<td>" . 'full_description' . "</td>" . "<td>" . 'number_sold' . "</td>" . "</tr>";
        foreach ($row as $app)
        {
            echo  "<tr>" . "<td>" . "<a href='table2.php ?product_name=id_product'>" . $app['product_name'] . "</a>" . "</td>" . "<td>" .   $app['product_description'] . "</td>" .  "<td>" . $app['full_description'] . "</td>" . "<td>" . $app['number_sold'] . "</td>" . "</tr>";
        }
    echo "</table>";
}
$result_set = $mysqli->query("SELECT * FROM `product`");
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
