<?php
error_reporting(0);
mysql_select_db('sms2',mysql_connect('localhost','root',''))or die(mysql_error());
?>
<?php
require_once('session1.php');
?>
<?php
SESSION_START();
?>
<?php
$id = $_GET['id'];
    $select = "SELECT * FROM 
            studentstable 
             WHERE student_id='$id'";
             $result = mysql_fetch_array(mysql_query($select));
    $qry=mysql_query($select);
        if($qry)
        {
        while($rec = mysql_fetch_array($qry)){
            $sirname = "$rec[sirname]";
            $firstname = "$rec[firstname]";
            $lastname = "$rec[lastname]";
            $idno = "$rec[idno]";
            $dateofbirth = "$rec[dateofbirth]";
            $gender = "$rec[gender]";
            $country_id = "$rec[country_id]";
            $county_id = "$rec[county_id]";
            $constituency_id = "$rec[constituency_id]";
            $mobile = "$rec[mobile]";
            $email = "$rec[email]";
            $address = "$rec[address]";
            $zipcode = "$rec[zipcode]";
            $course_id = "$rec[course_id]";
            $intake_id = "$rec[intake_id]";
            $reg_date = "$rec[reg_date]";
            //LOAD PARENT DETAILS TOO
            $psirname = "$rec[psirname]";
            $pfirstname = "$rec[pfirstname]";
            $plastname = "$rec[plastname]";
            $pmobile = "$rec[pmobile]";
            $prelationship = "$rec[prelationship]"; 
          $feepayable =$rec['feepayable'];}
        


        }


?>
<?php
                        include('connect.php');
                        $query="SELECT * FROM course WHERE course_id='$course_id'";
                        $records2=mysqli_query($db,$query);
                        while($rec=mysqli_fetch_array($records2, MYSQL_ASSOC))
                        {
                        $course_id2 = $rec['coursename'];
                        

                        }

 
  ?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>school management system</title>
    <link rel="shortcut icon" href="assets/img/title.gif" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link href="assets/css/loader.css" rel="stylesheet" />
    <script src="assets/js/canvasjs.min.js"></script>
    <!--*****jquery -3.2.1.js file supports the use of dropdown***-->
    <script src="assets/js/jquery-3.2.1.js"></script>

<!--this is javascript codes to sum up values as user inputs them-->
<script type='text/javascript'>
   function sumValues() {  
      var v1 = parseFloat(document.getElementById('box1').value);
      var v2 = parseFloat(document.getElementById('box2').value);
      var v3 = parseFloat(document.getElementById('box3').value);
      var v4 = parseFloat(document.getElementById('box4').value);
      var v5= parseFloat(document.getElementById('box5').value);
      document.getElementById('box6').value = v1 + v2 + v3 + v4 + v5;
   }
</script>
<!--this is javascript codes to sum up values as user inputs them-->
<!--printing the reciept-->

<script language="javascript" type="text/javascript">
        function printDiv(divID) {
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = "<html><head><title></title></head><body>" + divElements + "</body>";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;     
        }
</script>
<style type="text/css">
  #box1,#box2,#box3,#box4,#box5,#box6,#rf,#c,#an,#d{
              border-right:0 px solid;
              color:red;
              border-right: none;
              border-left: none;
              border-top: none;
              outline: none;
              }

</style>




</head>

<body >
<!--end of heading section--> 
<ul class="nav navbar-right top-nav">                        
    <div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" >
  <?php
        //Check to see if the user is logged in.if not redirect user to the loging page.
        
        if(isset($_SESSION['fname']))
        { 
        echo   "Current user: ".$_SESSION['fname']. "&nbsp;".$_SESSION['lname']. " ";
        }else{
          echo "<script type='text/javascript'>
                    alert( 'You must Log in to use the system');
                    </script>";
                echo "<script>
                    window.location = 'index.php'
                  </script>";
        }
        ?>
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
      <li><a href="manage_account.php"><i class="fa fa-users fa-lg"></i>&nbsp;View User</a></li>
      <li><a href="register_form.php"><i class="fa fa-users fa-lg"></i>&nbsp;Add New User</a></li>
      <li class="divider"></li>
      <li><a href="session_logout.php"><i class="fa fa-fw fa-power-off"></i>&nbsp;Log Out</a></li>
  </ul>
</div>
  </ul>
<!--************************************************-->
<div style="
    font-family:Nyala, Arial;
    text-align: left; 
    background-color: #526F35;
    padding: 20px; 
    color:white;
    width: 100%;
    height: 150px;">
    <!--This codes to load the image loader--> 
    <div id="loading">
            <img id="loading-image" src="assets/img/loader.gif" alt="Loading..." />
    </div>
<!--this is the heading section-->   
    <h2>
            <?php
            $sql="SELECT * FROM companyinfo";
            $result=mysqli_query($db,$sql) or die("error getting data");
            $num_rows=mysqli_num_rows($result);
             while($row=mysqli_fetch_array($result, MYSQL_ASSOC))
                    {
                    echo '<image style="height:82px; width:82px;" src="data:image;base64,'. $row['clogo'].' "> ';
                    $cname = $row['cname'];
                     $cemail = $row['cemail'];
                      $ccontact = $row['ccontact'];
                       $clocation = $row['clocation'];
                    }?>
                    <?php 
                    echo $cname;
                    ?>

    <div style="float:right; font-size:20px;text-align:right;">
    
    <img src="assets/img/mail2.png">Email: <?php  echo $cemail; ?><br>
    <img src="assets/img/call1.png">Contact:<?php  echo $ccontact; ?><br>
    <img src="assets/img/location.png">Location: <?php  echo $clocation; ?>
    
    </div> 
   </h2>
</div>
<!--end of heading section-->  
    
        <div>
        <ul class="nav nav-tabs">
            <li ><a href="homepage.php" >Administration <img src="assets/img/details.png"></a></li>
            <li ><a href="students.php" >Students <img src="assets/img/student48.png"></a></li>
            <li><a href="staff.php">Staff Member <img src="assets/img/staff48.png"></a></li>
            <li><a href="course.php" >Courses <img src="assets/img/course.png"></a></li>
            <li><a href="departments.php" >Departments <img src="assets/img/department.png"></a></li>
            <li><a href="markstep1.php" >Exams <img src="assets/img/update.png"></a></li>
            <li><a href="hostel.php" >Hostel <img src="assets/img/details.png"></a></li>
            <li class="active"><a href="parents.php">School fee  <img src="assets/img/details.png"></a></li>
            <!--<li><a href="tab-8" role="tab" data-toggle="tab">Hostel <img src="assets/img/details.png"></a></li>
            <li><a href="tab-7" role="tab" data-toggle="tab">Parents <img src="assets/img/details.png"></a></li>-->
            
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" role="tabpanel" id="tab-1">
                
                <p>
                    <div class="table-responsive"  >
<!--**************************************************************************************************************************-->
                        
<!--**************ths is the success msg on saving the cord-->
<div class="row">
        <div class="col-sm-3">
        </div>
<div class="col-sm-6" >
                       
               
                       
                          <form action="fee.php" method="POST" enctype="multipart/form-data">
                              <div id="printablediv">
                              <div   class="formelements">
                              <form action="fee.php" method="POST" enctype="multipart/form-data" >                        
                              <label>Recieved from:</label>
                              <input type="text" id="rf" name="name" value="<?php echo $sirname." ".$firstname." ".$lastname; ?>" class="form-control" readonly>
                          
                               <label>Course/Class:</label>
                               <input type="text" id="c" name="course_id" value="<?php echo $course_id2 ;?>" class="form-control" readonly>
                           
                               <label>Admmission number:</label>
                               <input type="text" id="an" name="student_id" value="<?php echo $id ;?>" class="form-control" readonly>
                          
                               <label>Date:</label>
                               <input type="text" readonly id="d" name="tdate" value="<?php echo date("Y-m-d") ;?>" class="form-control">
                                
                                Ref #:
                               <input type="text" name="refno" placeholder="e.g LD125YZ. Can also be reciept number in the manual record. e.g 4510" class="form-control" > 
                               
                               
                               Method Used

                               <select class="form-control" name="method">
                                 <option>Cash</option>
                                 <option>Cheque</option>
                                 <option>Money Order</option>
                                 <option>Postal Order</option>
                                 <option>Others</option>
                               </select>
                               <table>
                               <tr>
                               <td>Amount Paid</td>
                               <td>                               
                               <?php
                                        $id=$_GET['id'];
                                        $sql="SELECT SUM(amount) AS value_sum FROM fee WHERE  student_id='$id'";
                                        $user_query=mysqli_query($db,$sql) or die("error getting data");
                                        while($row = mysqli_fetch_array($user_query, MYSQL_ASSOC)){
                                    
                                    $totalpaid= $row['value_sum'];
                                  }
                                    $balance=$feepayable-$totalpaid;
                                    if ($balance<0)
                                    {
                                      $msg="The student has an overpayment of $balance";
                                    }
                                    elseif($balance>0)
                                    {
                                    $msg="The Student is having fee balance of $balance";
                                    }
                                    else
                                    {
                                      $msg="The student has no fee balance";
                                    }

                               ?>
                               <input type="number" name="totalpaid" readonly class="form-control" value="<?php echo $totalpaid; ?>"></td>

                                <td>Amount Payable</td><td><input type="number" name="feepayable" readonly class="form-control"  value="<?php echo $feepayable; ?>"></td>
                                <td>Remaining Balance</td><td><input type="number" name="feepayable" readonly class="form-control"  value="<?php echo $balance; ?>"></td>


                                </tr> 
                                <tr>
                                <td colspan="4"> <input type="text" name="OVERPAYMENT" class="form-control"  style="background-color:black" value="<?php echo $msg; ?>"> </td>
                                <td>Recieved</td><td> <input type="number" name="amount" class="form-control" min="0" style="background-color:black" > </td></tr></table>

                                 <br>                                                       
                               <input type="submit" name="register" enable="false" id="button2" onclick="sumValues()" value=" Register Transaction" class="btn btn-success">
                               <input type="button" value="Print Reciept" onclick="javascript:printDiv('printablediv')" class="btn btn-success">
                               <a button type='button' class="btn btn-primary" href="feestudents.php">Back</a>                  
                        </form>
<!--*************************************PHP CODES TO SAVE THE DATA************************************************-->
</div>

<?php
    mysql_select_db('sms2',mysql_connect('localhost','root',''))or die(mysql_error());
    if (isset($_POST['register'])){     
        $method=$_POST['method'];
        $refno=$_POST['refno'];
        $student_id=$_POST['student_id'];
        $tdate=$_POST['tdate'];
        $amount=$_POST['amount'];
         mysql_query("INSERT INTO fee (method, refno, student_id, tdate, amount) VALUES ('$method','$refno','$student_id','$tdate','$amount')") or die(mysql_error());    

?>
                        <?php 
                        $query="SELECT * FROM fee";
                        $records2=mysqli_query($db,$query);
                        while($rec=mysqli_fetch_array($records2, MYSQL_ASSOC))
                        {
                        $id = $rec['reciept'];
                        }?>
                        
                        <script>
 
                        alert('Transaction recorded Succsessfully');
                        window.location = "feestudents.php?id=<?php echo $id;?>";
                        </script>
<?php
 //<!--*******************************try add parent's details******************************************************-->  

}?>
<!--**********************************************************************************************************************-->
                 </div>

                </p>


            </div>
            
        </div>
    </div>
    
    <div class="col-md-12" style="background-color:#526F35;bottom:0px; position:fixed;">
        <p class="text-center text-danger" style="color:white;" >@J. Muthama Tel: +254729734768 <?php echo date("Y");?></p>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/affix.js"></script>
    <script src="assets/js/alert.js"></script>
    <script src="assets/js/alert1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap-datepicker.js"></script>
    <script src="assets/js/bootstrap-wysihtml5.js"></script>
    <script src="assets/js/button.js"></script>
    <script src="assets/js/carousel.js"></script>
    <script src="assets/js/chosen.jquery.min.js"></script>
    <script src="assets/js/ckeditor.js"></script>
    <script src="assets/js/collapse.js"></script>
    <script src="assets/js/color.js"></script>
    <script src="assets/js/dropdown.js"></script>
    <script src="assets/js/DT_bootstrap.js"></script>
    <script src="assets/js/dynamic.js"></script>
    <script src="assets/js/ie-emulation-modes-warning.js"></script>
    <script src="assets/js/jquery.dataTables.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/jquery.dialog.js"></script>
    <script src="assets/js/jquery.hoverdir.js"></script>
    <script src="assets/js/jquery.jgrowl.js"></script>
    <script src="assets/js/jquery.knob.js"></script>
    <script src="assets/js/jquery.uniform.min.js"></script>
    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/jquery-1.9.1.js"></script>
    <script src="assets/js/jquery-1.9.1.min.js"></script>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/jquery-1.11.0.js"></script>
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="assets/js/jquery-ui-1.10.3.js"></script>
    <script src="assets/js/modal.js"></script>
    <script src="assets/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script src="assets/js/myjquery.js"></script>
    <script src="assets/js/myjquery1.js"></script>
    <script src="assets/js/npm.js"></script>
    <script src="assets/js/popover.js"></script>
    <script src="assets/js/profile.js"></script>
    <script src="assets/js/raphael-min.js"></script>
    <script src="assets/js/sb-admin-2.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/scrollspy.js"></script>
    <script src="assets/js/tab.js"></script>
    <script src="assets/js/tooltip.js"></script>
    <script src="assets/js/transition.js"></script>
    <script src="assets/js/wysihtml5-0.3.0.js"></script>
    <script language="javascript" type="text/javascript">
     $(window).load(function()
      {
        $('#loading').hide();
      });
</script>
</body>

</html>