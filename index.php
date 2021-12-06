<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <?php 
    if(isset($_SESSION['username'])){
  ?>
  <div><h1>Welcome <?php 
  if($_SESSION['username'])
    echo $_SESSION['username']; 
  else
    echo "You are logged out";
  ?></h1>
  <a href="#" id="logout">logout</a>  
</div>
  <?php
    }
    else{
      echo "You are not logged in!";
    }
  ?>
  <div id="border">
    <form method="POST"> 
    <div id="userError"></div>
      Username: <input type="text" name="username" id="username" size="10"/><br>
      Password: <input type="password" name="password" size="10" id="password"/><br>
      <div id="passConfError" ></div>
      <button type="submit" id="submit">click on me</button>
      </form>
</div>

<script src="jquery-3.6.0.min.js"></script>
<script src="jquery-dev.js"></script>
<script>
  var modal = document.getElementById('border');
  window.onclick = function(event){
    if(event.target == modal){
      modal.style.display ="none";
    }
  }
    $(document).ready(function(){
      $("#submit").click(function(e){
        e.preventDefault();
        var username = $("#username").val();
        var password = $("#password").val();

        if(username != '' && password != '')
        {
          $.ajax({
            url:"ajax.php",
            method:"POST",
            data:{
              type: 'username',
              username:username,
              password:password
            },
            cache:false,
            success:function(data){
              if(data == "Failed Login!"){
                alert("Wrong Data");
              }
              else{
                alert("Welcome")
                location.reload();
              }
            }
          });
        }
        else{
          alert("Both fields are required");
        }
      });
      $('#logout').click(function(){
        var action = 'logout';
        $.ajax({
          url:"ajax.php",
          method:"POST",
          data:{action:action},
          success:function(data){
            location.reload();
          }
        })
      })
    });
</script>
</body>
</html>
