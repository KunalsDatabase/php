<?php

$conn = mysqli_connect('localhost', 'root','password','database');

$text = file_get_contents('filepath');

$textarray=explode("\n",$text);


$subject='';$code='';$title='';$term='';
$i = 0;

while($i<sizeof($textarray)){
  while((strlen($subject)<1 OR strlen($term)<1 OR strlen($title)<1 OR strlen($code)<1)AND $i<sizeof($textarray)){

    $term = 'S';
     if(strpos($textarray[$i], '~~') !== false){
    $i++;

       continue; }

    elseif(strpos($textarray[$i], '---') !== false){
    $i++;

      continue; }
     elseif(strlen($textarray[$i])<3){
    $i++;

       continue;
     }

    elseif(strpos($textarray[$i], '*') !== false){
      $subject = str_replace("*","",$textarray[$i]);
    $i++;continue;
    }

      elseif(strpos($textarray[$i], '/') !== false){
    $code = $textarray[$i]; 
        $i++;
      }

    else{
    $title = $textarray[$i];

      $i++;};
  };
echo $subject."<br>".$code."<br>".$title."<br>".$term;  

  $sql =  "insert into courses (Term,Course,Title,Subject) VALUES(\"$term\",\"$code\",\"$title\",\"$subject\")";
   $result = mysqli_query($conn,$sql);
  echo mysqli_error($conn);
  $code='';$title='';$term='';
};


$sql =  "insert into courses (Term,Course,Title,Subject) VALUES(\'$term\',\'$code\',\'$title\',\'$subject\')";
/*
 $result = mysqli_query($conn,$sql);

for($i=10;$i>0;$i--){
$row1=mysqli_fetch_assoc($result);
  echo("<br>");
var_dump($row1);
};

*/
?>