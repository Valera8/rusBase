<?php
$mysqli = new mysqli("127.0.0.1", "bloger", "mysql","firstbase");
$mysqli->query("SET NAMES 'utf8");
$mysqli->query("CREATE DATABASE `temp`");
$mysqli->query("CREATE TABLE `temp`.`cities` (`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, `title` VARCHAR (255)  character set utf8 collate utf8_general_ci NOT NULL) ENGINE=MYISAM CHARACTER  SET utf8 COLLATE  utf8_general_ci");
$mysqli->query("ALTER TABLE `temp`.`cities` ADD `utc` TINYINT(2) NOT NULL");
$mysqli->query("ALTER TABLE `temp`.`cities` DROP `utc`");
$mysqli->query("DROP TABLE `temp`.`cities`");
$mysqli->query("DROP DATABASE `temp`");
$mysqli->query("CREATE USER 'bloger1'@'%' IDENTIFIED BY '***';GRANT ALL PRIVILEGES ON *.* TO 'bloger1'@'%' IDENTIFIED BY '***' REQUIRE NONE WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;");
$mysqli->query("ALTER TABLE `ordering` CHANGE `client` `client` VARCHAR(55) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL");

$success = $mysqli->query("INSERT INTO `ordering` (`id_product`, `client`, `e-mail`, `date_ordering`) VALUES ('21','User1', 'abc@mail.ru', '".time()."')");
echo $success;
for ($i = 2; $i <10; $i++) {
    $mysqli->query("INSERT INTO `ordering` (`id_product`, `client`, `e-mail`, `date_ordering`) VALUES ('".($i + 2)."', 'User$i', 'abc$i@mail.ru', '".time()."')");
}
$insert_id = $mysqli->insert_id;
//$mysqli->query("UPDATE `ordering` SET `date_ordering`='1', `client`='Afyf' WHERE `id` = 1");
//$mysqli->query("DELETE FROM `ordering` WHERE `id` < 5");
//$mysqli->query("DELETE FROM `ordering` WHERE `id` > '".($insert_id - 3)."'");

/* Домашнее задание Lesson5_9 */

if (!empty($_POST))
{
    if (isset($_POST['product']))
    {
        if (isset($_POST['product_name']))
        {
            $product_name = $_POST['product_name'];
        }
        if (isset($_POST['product_description']))
        {
            $product_description = $_POST['product_description'];
        }
        if (isset($_POST['full_description']))
        {
            $full_description = $_POST['full_description'];
        }
        $insert_product = $mysqli->query("INSERT INTO `product` (`product_name`, `product_description`, `full_description`) VALUES ('$product_name', '$product_description', '$full_description')");
    }
    elseif (isset($_POST['ordering']))
    {
        if (isset($_POST['client']))
        {
            $client = $_POST['client'];
        }
        if (isset($_POST['email']))
        {
            $mail = $_POST['email'];
        }
        if (isset($_POST['comment']))
        {
            $comment = $_POST['comment'];
        }
        $insert_ordering = $mysqli->query("INSERT INTO `ordering` (`client`, `e-mail`, `comment`, `date_ordering`) VALUES ('$client', '$mail', '$comment', '".time()."')");
    }
    else
    {
        echo 'ошибка';
    }
}

/* Lesson5_10 */

function printResultSet($result_set)
{
    echo "Количество записей: ".$result_set->num_rows."<br> ";
    while (($row = $result_set->fetch_assoc()) != false)
    {
        print_r($row);
        echo "<br>";
    }
    echo "_____________________<br>";
}
$result_set = $mysqli->query("SELECT * FROM `ordering`");
printResultSet($result_set);
$result_set = $mysqli->query("SELECT `client`, `e-mail` FROM `ordering`");
printResultSet($result_set);
$result_set = $mysqli->query("SELECT * FROM `ordering` WHERE `id` > 224 ORDER BY `client` DESC LIMIT 1, 3");
printResultSet($result_set);
$result_set = $mysqli->query("SELECT COUNT(`comment`) FROM `ordering`");
printResultSet($result_set);
$result_set = $mysqli->query("SELECT * FROM `ordering` WHERE `client` LIKE '%5%'");
printResultSet($result_set);

/* Домашнее задание Lesson5_10 */

$mysqli->close();
?>


 