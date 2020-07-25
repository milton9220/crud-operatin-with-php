<?php
  require_once "inc/functions.php";
  $task=$_GET['task'] ?? 'report';
  $info='';
  $error= 0;
  if('seed' ==$task){
     seed(DB_NAME);
     $infor="Seeding complete";
  }
  $fname='';
  $lname='';
  $age='';
  $class='';
  $roll='';
  if(isset($_POST['submit'])){
    $fname=filter_input(INPUT_POST,'fname',FILTER_SANITIZE_STRING);
    $lname=filter_input(INPUT_POST,'lname',FILTER_SANITIZE_STRING);
    $age=filter_input(INPUT_POST,'age',FILTER_SANITIZE_STRING);
    $class=filter_input(INPUT_POST,'class',FILTER_SANITIZE_STRING);
    $roll=filter_input(INPUT_POST,'roll',FILTER_SANITIZE_STRING);
    if($fname !='' && $lname !='' && $age !='' && $class !='' && $roll !=''){
      $result=addStudent($fname,$lname,$age,$class,$roll);

      if($result==true){
        header('location:index.php?task=report');
      }
      else{
        $error=1;
      }
      
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crud Project</title>
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
            <h2>CRUD PROJECT </h2>
            <p>A sample project to perform CRUD operations using plain files and PHP</p>
            <?php include_once( 'inc/templates/navbar.php' ); ?>
            <hr/>
            <?php if($info !=''){
                echo "<p>{$info}</p>";
            } ?>
        </div>
    </div>

      <?php if('1'==$error):?>
        <div class="row">
      <div class="column column-60 column-offset-20">
        <blockquote>
          This roll number is already have taken..please try another one
        </blockquote>
      </div>
    </div>
      <?php endif;?>

    <div class="row">
      <div class="column column-60 column-offset-20">
        <?php 
          if('report' ==$task){
              generateReport();
          }
        ?>
      </div>
    </div>

    <div class="row">
      <div class="column column-60 column-offset-20">
        <?php 
          if('add' ==$task):?>
            <form action="/index.php?task=add" method="POST">
              <label for="fname">First Name</label>
              <input type="text" name="fname" id="fname" value="<?php echo $fname; ?>">
              <label for="lname">Last Name</label>
              <input type="text" name="lname" id="lname" value="<?php echo $lname; ?>">
              <label for="age">Age</label>
              <input type="number" name="age" id="age" value="<?php echo $age; ?>">
              <label for="class">Class</label>
              <input type="number" name="class" id="class" value="<?php echo $class; ?>">
              <label for="roll">Roll</label>
              <input type="number" name="roll" id="roll" value="<?php echo $roll; ?>">
              <button type="submit" name="submit">Save</button>
            </form>   
          <?php endif;
        ?>
      </div>
    </div>
    
</div>
</body>
</html>