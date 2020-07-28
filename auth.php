<?php 
 session_start();
 $_SESSION['login']=false;
 $error=0;
 $username=filter_input(INPUT_POST,'username',FILTER_SANITIZE_STRING);
 $password=filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
 $fp=fopen('data/user.txt','r');
 if(isset($_POST['username']) && isset($_POST['password'])){
    $_SESSION['login']=false;
    $_SESSION['user']=false;
    $_SESSION['role']=false;
    while($data=fgetcsv($fp)){
        if($data[0]==$username && $data[1]== md5($password)){
            $_SESSION['login']=true;
            $_SESSION['user']=$username;
            $_SESSION['role']=$data[2];
            header('location:index.php');
            
        }
        
    }
    if(!$_SESSION['login']){
        $error=1;
    }
}
 if(isset($_GET['logout'])){
    $_SESSION['login']=false;
    $_SESSION['user']=false;
    $_SESSION['role']=false;
     session_destroy();
     header('location:index.php');
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login System</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="//cdn.rawgit.com/necolas/normalize.css/master/normalize.css">
    <link rel="stylesheet" href="//cdn.rawgit.com/milligram/milligram/master/dist/milligram.min.css">
    <style>
        body {
            margin-top: 30px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="column column-60 column-offset-20">
            <?php 
               
               if(true==$_SESSION['login']):?>
               <h2>Welcome to admin pannel</h2>
            <?php 
               else:?>
                <h2>Login Admin</h2>
               <p>Please login and go to the admin pannel</p>
               <?php endif;?>
            <?php 
                 if('1'==$error):?>
                     <blockquote>Username and Passowrd did't match</blockquote>
                 
                <?php endif;?>
            
            <hr/>
            
        </div>
    </div>
        
        <div class="row">
            <div class="column column-60 column-offset-20">
            <?php if(false==$_SESSION['login']):?>
                <form action="" method="POST">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" value="">
                    
                    <button type="submit" class="button-primary" name="submit">Login</button>
                </form>
        
        
        <?php endif; ?>
            </div>
        </div>
    
</div>
</body>
</html>