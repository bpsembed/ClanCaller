<?php
    ini_set("display_errors",1);
    session_start();
    if(isset($_POST)){
        require '../_database/database.php';
        $war_enemy=$_REQUEST['war_enemy'];
		$war_size=$_REQUEST['war_size'];
		$hour=$_REQUEST['hours'];
		$minutes=$_REQUEST['minutes'];
		$time_call=$_REQUEST['call_timer'];
		date_default_timezone_set("America/Mexico_City");
		$war_time = date('Y-m-d H:i:s', strtotime('+ '.$hour.' hours' .$minutes.' minutes'));		
        $sql3="INSERT INTO war_table SET war_time='$war_time', caller_time='$time_call',war_enemy='$war_enemy',war_size='$war_size'";
		$loopvalue = $war_size; $i=1; while ($i <= $loopvalue) {
		$war_enemynumber = $i;	
		$sql4="INSERT INTO caller SET war_enemy='$war_enemy', war_enemynumber = '$war_enemynumber'";
		
			$r2 = mysqli_query($database,$sql4);
	
			$i++;};	
			$r1 = mysqli_query($database,$sql3); 
			
			$sqlResult = $r1 && $r2;
			
			if(!$sqlResult){
				mysqli_rollback($database);
				echo "error contact your admin";
			}else{
				mysqli_commit($database);
				header("location:../home.php?status=success");
			}
			mysqli_close($database);	
    }    
?>