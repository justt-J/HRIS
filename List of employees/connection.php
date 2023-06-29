
<?php

function connection(){

$host='localhost';
$uname='root';
$dbpass='1234';
$dbname='eddie-db';


$con=new mysqli($host,$uname,$dbpass,$dbname);

if($con->connect_error){
    echo $con->connect_error;


}
else{
    return $con;
}



}

        



?>







