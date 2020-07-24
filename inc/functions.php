<?php
define('DB_NAME','data/db.txt');
function seed($filename){
    $allStudents=array(
        array(
            'fname'  =>'Milton',
            'lname'  =>'Hasan',
            'age'    =>'15',
            'class'  =>'7',
            'roll'   =>'10'
        ),
        array(
            'fname'  =>'Ador',
            'lname'  =>'Hasan',
            'age'    =>'15',
            'class'  =>'7',
            'roll'   =>'15'
        ),
        array(
            'fname'  =>'Tusar',
            'lname'  =>'Rahaman',
            'age'    =>'15',
            'class'  =>'7',
            'roll'   =>'1'
        ),
        array(
            'fname'  =>'Adil',
            'lname'  =>'Hasan',
            'age'    =>'15',
            'class'  =>'7',
            'roll'   =>'2'
        ),
        array(
            'fname'  =>'Anik',
            'lname'  =>'kader',
            'age'    =>'15',
            'class'  =>'7',
            'roll'   =>'20'
        )
    
    );
    $serializeData=serialize($allStudents);
    file_put_contents($filename,$serializeData,LOCK_EX);
}

function generateReport(){
    $getData=file_get_contents(DB_NAME);
    $allStudents=unserialize($getData);
    ?>
    <table>
      <tr>
         <td>Name</td>
         <td>Age</td>
         <td>Class</td>
         <td>Roll</td>
         <td>Actions</td>
      </tr>
      <?php 
         foreach($allStudents as $student):?>
         <tr>
           <td><?php printf("%s %s",$student['fname'],$student['lname']); ?></td>
           <td><?php printf("%s",$student['age']); ?></td>
           
           <td><?php printf("%s",$student['class']); ?></td>
           <td><?php printf("%1s",$student['roll']); ?></td>
           <td><?php printf("<a href='/index.php?task=edit&&roll= %s'>Edit</a> | <a href=/index.php?task=edit&&roll=%s>Delete</a>",$student['roll'],$student['roll']); ?></td>
         </tr>
         <?php endforeach; ?> 
    </table>
    <?php
   
}

