<?php
        $conn = mysqli_connect('localhost','root','','harsh');
        if($conn->connect_error){
          die("not connected!".$conn->connect_error);
        }
        else{
          echo "Connected!<br>";
        }
session_start();
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $sql = "select count(*) from wp_users where(user_login = '$username' and user_pass='$password')";

    $res = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($res);

    if($row[0] > 0)
      {
        $_SESSION['username'] = $username;
        echo "Yes";
      }
    else
      echo "Failed Login!";
}
else{
  echo "Out of loop!";
}

// if(isset($_POST['username'])){
//   $sql = "select count(*) from wp_users where( user_login =' ".$_POST['username']."' and user_pass='".$_POST['password']."')";

//   $result = mysqli_query("$conn,$sql");

//   echo $result;
  
//   if(mysqli_num_rows($result)>0){
//     $_SESSION['username']= $_POST['username'];
//     echo 'Yes';
//   }
//   else{
//     echo "No";
//   }
// }

if(isset($_POST['action']))
{
  unset($_SESSION["username"]);
}


 ?>
