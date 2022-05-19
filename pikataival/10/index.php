<!-- Toteuta tähän tarvittava koodi -->

<?php
$arr = [];

for($i = 1; $i < 101; $i++){
    array_push($arr,$i);
}

shuffle($arr);

echo $arr[0];
echo $arr[1];
echo $arr[2];
echo $arr[3];
echo $arr[4];