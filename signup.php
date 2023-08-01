<?php
   
   include("classes/connect.php");
   include("classes/signup1.php");


       $first_name = "";
       $Last_name = "";
       $Gender = "";
       $Email = "";

   if($_SERVER['REQUEST_METHOD'] == 'POST')
   {

      $signup1 = new Signup();
      $result = $signup1->evaluate($_POST);
    
    if($result != "")
    {
        
        echo "<div style='text-align:center; font-size:12px; color:white;background-color:grey;'>";
        echo "<br>The following errors occured<br><br>";
        echo $result; 
        echo "</div>";
    }else
    {

        header("Location: login.php");
        die;
    }


       $first_name = $_POST['first_name'];
       $Last_name = $_POST['Last_name'];
       $Gender = $_POST['Gender'];
       $Email = $_POST['Email'];
     

   }
  

  

   ?>


<html>

<head>
    
    <title>CAMbuzz | Sign up</title>
    <style type="text/css">
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

        <a href="login.php">
        <div id="signup_btn"> Log in</div>
        </a>
    </div>
    <div id="middle-content">
        Sign up to CAMbuzz <br> <br>
        

        <form method="post" action="">

           <input value="<?php echo $first_name ?>" name="first_name" type="text" id="text" placeholder="First name"> <br> <br>
           <input value="<?php echo $Last_name ?>" name="Last_name" type="text" id="text" placeholder="Last name"> <br> <br>
           <input value="<?php echo $Email ?>" name="Email" type="text" id="text" placeholder="Email"> <br> <br>

           <span style="font-weight: normal;">Gender:</span><br>
           <select name="Gender" id="text">
           <option> <?php echo $Gender ?></option>
           <option>male</option>
           <option>Female</option>

           </select> <br> <br>

           <input name="password" type="password" id="text" placeholder="password"> <br><br>
           <input name="password2" type="password" id="text" placeholder="Re-password"> <br><br>

           <input type="submit" id="button" value="Sign up"> <br> <br>

        </form>

    </div>
</body>

</html>