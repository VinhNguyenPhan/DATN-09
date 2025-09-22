<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day la trang web dau tien</title>
</head>
<body>
    <h1>Hello</h1>
    <?php
    $ten = "Nguyen Phan Vinh";
    echo "Xin chao, ".$ten."<br>";
    $a = 1;
    $b = 2;
    echo $a + $b."<br>";
    if($a>$b)
    {
        echo "{$a}>{$b}!";
    }
    else{
        echo "Khong co gi de xem het"."<br>";
    }
    $n=200;
    $tong=0;
    for($i=0;$i<=$n;$i++)
    {
        $tong= $i+$tong;
    }
    echo $tong;
    ?>
</body>
</html>