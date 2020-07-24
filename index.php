<?php
  require_once "inc/functions.php";
  $task=$_GET['task'] ?? 'report';
  $info='';
  if('seed' ==$task){
     seed(DB_NAME);
     $infor="Seeding complete";
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

    <div class="row">
      <div class="column column-60 column-offset-20">
        <?php 
          if('report' ==$task){
              generateReport();
          }
        ?>
      </div>
    </div>
    
</div>
</body>
</html>