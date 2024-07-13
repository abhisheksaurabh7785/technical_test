<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>


<a href="index.php">Back to Main Page</a>
<br><br>

</body>

<?php

// 2 Write the PHP script to generate series of prime numbers from 1 to 100.


function checkprime($num){
    if($num<=1) {
        return false;
    }
    for($i=2; $i<=sqrt($num); $i++){
        if($num % $i == 0){
            return false;
        }
    }
    return true;
}
echo "Prime numbers from 1 to 100 are : ";
for($i=1 ; $i<=100; $i++){
    if(checkprime($i)){
        echo $i. "";
    }
};
?>
</html>
