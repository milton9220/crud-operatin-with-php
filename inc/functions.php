<?php
define('DB_NAME','data/db.txt');
function seed($filename){
    $allStudents=array(
        array(
            'id'    =>'1',
            'fname'  =>'Milton',
            'lname'  =>'Hasan',
            'age'    =>'15',
            'class'  =>'7',
            'roll'   =>'1'
        ),
        array(
            'id'    =>'2',
            'fname'  =>'Ador',
            'lname'  =>'Hasan',
            'age'    =>'15',
            'class'  =>'7',
            'roll'   =>'2'
        ),
        array(
            'id'    =>'3',
            'fname'  =>'Tusar',
            'lname'  =>'Rahaman',
            'age'    =>'15',
            'class'  =>'7',
            'roll'   =>'3'
        ),
        array(
            'id'    =>'4',
            'fname'  =>'Adil',
            'lname'  =>'Hasan',
            'age'    =>'15',
            'class'  =>'7',
            'roll'   =>'4'
        ),
        array(
            'id'    =>'5',
            'fname'  =>'Anik',
            'lname'  =>'kader',
            'age'    =>'15',
            'class'  =>'7',
            'roll'   =>'5'
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
           <td><?php printf("%s",$student['roll']); ?></td>
           <td><?php printf("<a href='/index.php?task=edit&&id= %s'>Edit</a> | <a href=/index.php?task=delete&&id=%s>Delete</a>",$student['id'],$student['id']); ?></td>
         </tr>
         <?php endforeach; ?> 
    </table>
    <?php
   
}

function addStudent($fname,$lname,$age,$class,$roll){
    $getData=file_get_contents(DB_NAME);
    $allStudents=unserialize($getData);
    $found=false;
    foreach($allStudents as $student){
        if($student['roll'] ==$roll){
            $found=true;
            break;
        }
    }
    if(!$found){
        $newId   = newId($allStudents);
        $newStudent=array(
            'id'   =>$newId,
            'fname' =>$fname,
            'lname' =>$lname,
            'age'   =>$age,
            'class' =>$class,
            'roll'  =>$roll
        );
        array_push($allStudents,$newStudent);
        $serializeData=serialize($allStudents);
        file_put_contents(DB_NAME,$serializeData,LOCK_EX);
        return true;
    }
    else{
        return false;
    }
}

function getStudent($id){
    $getData=file_get_contents(DB_NAME);
    $allStudents=unserialize($getData);
    
    foreach($allStudents as $student){
        if($student['id'] == $id){
            return $student;
        }
        
    }
    return false;
}

function updateStudent($id,$fname,$lname,$age,$class,$roll){
    $serialziedData = file_get_contents( DB_NAME );
    $students       = unserialize( $serialziedData );
    $found=false;
    foreach($students as $student){
        if($student['roll'] == $roll && $student['id'] !='id'){
            $found=true;
            break;
        }
    }
    if(!$found){
        $students[$id-1]['fname']=$fname;
    $students[$id-1]['lname']=$lname;
    $students[$id-1]['age']=$age;
    $students[$id-1]['class']=$class;
    $students[$id-1]['roll']=$roll;
    $serializedData               = serialize( $students );
    file_put_contents( DB_NAME, $serializedData, LOCK_EX );
    return true;
    }
    else{
        return false;
    }

    

}

function deleteStudent($id){
    $serialziedData = file_get_contents( DB_NAME );
    $students       = unserialize( $serialziedData );
    unset($students[$id-1]);
    $serializedData               = serialize( $students );
    file_put_contents( DB_NAME, $serializedData, LOCK_EX );
    return true;
}

function newId($allStudents){
    $maxId=max(array_column($allStudents,'id'));
    return $maxId+1;
}





