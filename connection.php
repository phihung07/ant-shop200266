<?php
$connect = pg_connect("postgres://pxoxmdhvjmlblq:10e4721965024f734251f0c82a9728060c01f436c8bb18d4677557fca55fa39e@ec2-44-194-4-127.compute-1.amazonaws.com:5432/d6o74l1q1mni6d");	
if (!$connect) {
    die("Connection failed");
}
?>