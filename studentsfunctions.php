<?php
 include('connect.php');
 error_reporting(0);//turning off error reporting
 if(isset($_POST["Importstudent"])){
		
		$filename=$_FILES["file"]["tmp_name"];		
 
 
		 if($_FILES["file"]["size"] > 0)
		 {
		  	$file = fopen($filename, "r");
	        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
 
 
	           $sql = "INSERT into studentstable(sirname, firstname, lastname, idno, dateofbirth, gender, country_id, county_id, constituency_id, mobile, email, address, zipcode, course_id, intake_id,reg_date, feepayable)
                   values ('".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."','".$getData[5]."','".$getData[6]."','".$getData[7]."','".$getData[8]."','".$getData[9]."','".$getData[10]."','".$getData[11]."','".$getData[12]."','".$getData[13]."','".$getData[14]."','".$getData[15]."','".$getData[16]."','".$getData[17]."')";
                   $result = mysqli_query($db, $sql);
				if(!isset($result))
				{
					echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"csvstudents.php\"
						  </script>";		
				}
				else {
					  echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"csvstudents.php\"
					</script>";
				}
	         }
			
	         fclose($file);	
		 }
	}
?>

<?php	 
 
 if(isset($_POST["Exportstudent"])){
		 
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Student ID', 'Sirname', 'Firstname', 'Lastname', 'IDNO','DOB', 'Gender', 'Country ID', 'County ID', 'Constituency ID', 'Mobile','Email','Address','Zipcode','Course ID','Intake ID','Reg Date', 'Fee Payable'));  
      $query = "SELECT * from studentstable ORDER BY student_id DESC";  
      $result = mysqli_query($db, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }  
 
?>

