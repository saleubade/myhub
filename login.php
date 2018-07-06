<?php
    session_start();
?>

<meta charset="utf-8">
<?php 

include_once '../common_lib/dbconn.php';



$id= mysqli_real_escape_string($con, $_POST['id']);
$pass= mysqli_real_escape_string($con, $_POST['pass']);


if(empty($id)){
    echo("<script>
        window.alert('아이디를 입력하세요');
        history.go(-1);
    </script>");
    exit;
}

if(empty($pass)){
    echo("<script>
        window.alert('비밀번호를 입력하세요');
        history.go(-1);
         </script>");
    exit;
}
    

    
    $sql="select * from member where id='$id' ";
    $result = mysqli_query($con, $sql) or die("쿼리문 실패원인 : ".mysqli_error($con));    
    $num_match = mysqli_num_rows($result);  //개수리턴
    
if(!$num_match){
    echo("<script>
        window.alert('등록 되지 않은 아이디입니다.');
        history.go(-1);
         </script>");
}else{
   $row = mysqli_fetch_array($result); //
   $db_pass= $row[pass];        //db의 비밀번호의 값을 fetch array로 읽어서 배열로 한줄씩 저장 
   $db_id= $row[id];        
   
   if($pass == $db_pass && $id == $db_id){
   
       $userid = $row[id];
       $username = $row[name];
       $usernick = $row[nick];
       $userlevel = $row[level];
       
       $_SESSION['userid'] = $userid;
       $_SESSION['username'] = $username;
       $_SESSION['usernick'] = $usernick;
       $_SESSION['userlevel'] = $userlevel;
       
       echo ("<script>
               location.href ='../index.php';
        </script>");
       
   }else{
       
       echo("<script>
        window.alert('비밀번호가 틀립니다.');
        history.go(-1);
         </script>");
       exit;
       
   }
    
}


?>