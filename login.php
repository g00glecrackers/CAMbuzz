<?php
   
session_start();

   include("classes/connect.php");
   include("classes/login.php");
    
    
       $Email = "";
       $password = "";
       

   if($_SERVER['REQUEST_METHOD'] == 'POST')
   {

      $login = new Login();
      $result = $login->evaluate($_POST);
    
    if($result != "")
    {
        
        echo "<div style='text-align:center; font-size:12px; color:white;background-color:grey;'>";
        echo "<br>The following errors occured<br><br>";
        echo $result; 
        echo "</div>";
    }else
    {

        header("Location: profilepage.php");
        die;
    }


       $password = $_POST['password'];
       $Email = $_POST['Email'];
     

   }
  
   ?>

<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>CAMbuzz | Log in</title>
    <style>
        #head-bar {
            height: 100px;
            background-color: rgb(70, 255, 200);
            color: black;
            font-size: ;
            padding: 4px;
        }

        #signup_btn {
            background-color: rgb(91, 205, 91);
            width: 70px;
            text-align: center;
            padding: 4px;
            border-radius: 4px;
            float: right;
        }

        #middle-content {
            background-color: white;
            width: 800px;
            
            margin: auto;
            margin-top: 100px;
            padding: 10px;
            text-align: center;
            padding-top: 50px;
            font-weight: bold;
        }
        #text{
            height: 40px;
            width: 300px;
            border-radius: 4px;
            border: solid 1px #ccc;
            padding: 4px;
            font-size: 14px;
        }
        #button{
            width: 300px;
            height: 40px;
            border-radius: 4px;
            border: none;
            background-color: rgb(91, 205, 91);
            color: white;
        }
    </style>
</head>

<body style="font-family: tahoma;background-color: #e9ebee;">
    <div id="head-bar">
        <div style="font-size: 40px;">CAMbuzz</div>

        <a href="signup.php">
        <a href="signup.php"> <div id="signup_btn"> Signup</div></a>
        </a>
    </div>
    <div id="middle-content">

          <form method="POST" action="">
        Login to CAMbuzz <br> <br>

        <input name="Email" value="<?php echo $Email ?>" type="text" id="text" placeholder="Email"> <br> <br>
        <input name="password" value="<?php echo $password ?>" type="password" id="text" placeholder="password"> <br><br>

        <input type="submit" id="button" value="Log in"> <br> <br>

          </form>

    </div>
</body>

</html>