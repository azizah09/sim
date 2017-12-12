<?php
error_reporting(0);
include_once('connect.php');
$payment=$_GET['payment'];
$sql = "SELECT `reciept`, `method`, `refno`, `student_id`, `tdate`, `amount` FROM fee  WHERE student_id='$payment'";
$resultset = mysqli_query($db, $sql) or die("database error:". mysqli_error($db));
//get the students details
$sql2 = "SELECT * FROM studentstable  WHERE student_id='$payment'";
$resultset2 = mysqli_query($db, $sql2) or die("database error:". mysqli_error($db));
while($users3=mysqli_fetch_array($resultset2,MYSQL_ASSOC))
        {
        $name=$users3['sirname']." ".$users3['firstname']." ".$users3['lastname'];
        $adm=$users3['student_id'];
        $course_id=$users3['course_id'];
        $feepayable=$users3['feepayable'];
        }
$sql3 = "SELECT * FROM course  WHERE course_id='$course_id'";
$resultset3 = mysqli_query($db, $sql3) or die("database error:". mysqli_error($db));
while($users3=mysqli_fetch_array($resultset3,MYSQL_ASSOC))
        {
        $coursename=$users3['coursename'];
        }

//calculating the fee paid and the fee balance
$payment=$_GET['payment'];
$sql="SELECT SUM(amount) AS value_sum FROM fee WHERE  student_id='$payment'";
$user_query=mysqli_query($db,$sql) or die("error getting data");
while($row = mysqli_fetch_array($user_query, MYSQL_ASSOC)){
                                    
$totalpaid= $row['value_sum'];
}
         $balance=$feepayable-$totalpaid;
          if ($balance<0)
          {
           $msg="The student has an overpayment";
            }
           elseif($balance>0)
           {
            $msg="The Student is having fee balance of $balance";
            }
            else
            {
            $msg="The student has no fee balance";
}
//end of calculation process

require('fpdf/fpdf.php');
class PDF extends FPDF
{

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-10);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Line(0, 600, 210,600);
    $this->Cell(0,5,'Page '.$this->PageNo().'/{nb}',0,0,'L');
    // $tDate=date('l \t\h\e jS');
    //$this->Cell(0, 10, 'Date : '.$tDate, 0, false, 'C', 0, '', 0, false, 'T', 'M');
}
}


$pdf = new PDF();
$pdf->SetAuthor('John Muthama');
$pdf->AliasNbPages();
//set font for the entire document
$pdf->SetFont('Arial','B',20);
$pdf->SetTextColor(0,0,0);
//set up a page
$pdf->AddPage('P');
//$pdf->SetDisplayMode(real,'default');
//insert an image and make it a link

//display the title with a border around it
$pdf->SetXY(50,50);
$pdf->Cell(100,5,'Invoice',0,0,'C',0);
//C MEANS CENTERED
//Set x and y position for the main text, reduce font size and write content
$pdf->SetXY (10,50);
$pdf->SetFontSize(10);

//for($i=1;$i<=40;$i++)
//    $pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->Cell(0,10,'Student Name :'.$name ,0,1);
$pdf->Cell(0,10,'Admission Number :'.$adm ,0,1);
$pdf->Cell(0,10,'Course ID :'.$coursename ,0,1);

//This is teh date included in the submited form i.e printinvloice.php
$date1=$_GET['date'];
if($date1=="")
{
    $date="DATE NOT SELECTED";
}
else{
   $date=$_GET['date']; 
}
$pdf->SetXY(150, 50);
$pdf->SetFontSize(10); 
$pdf->Cell(0,10,'Date :'.$date ,0,0,'R',0);

//Put a line here
$pdf->Ln(4); //break 
$pdf->Ln(4); //break 
$pdf->Ln(4); //break 
$pdf->Ln(4); //break 
$pdf->Ln(4); //break 
$pdf->Ln(4); //break     
$pdf->Line(0, 80, 210, 80);  //Set the line
$pdf->Ln(4); //line Break
$pdf->Ln(4); //break 

//populate the table with data fetched using the resultset
while ($field_info = mysqli_fetch_field($resultset)) {
$pdf->Cell(32,8,$field_info->name,1);
}
while($rows = mysqli_fetch_assoc($resultset)){
$pdf->SetFont('Arial','',8);
$pdf->Ln();

foreach($rows as $column) {
$pdf->Cell(32,8,$column,1);
}
}


/// Begin with regular font
//Output the fee summary values calculated above

$pdf->Ln();
$pdf->SetFont('Arial','',14);
$pdf->SetFontSize(10);
$pdf->Cell(0,10,'Fee Payable :'.$feepayable ,0,1);
$pdf->Cell(0,10,'Paid :'.$totalpaid ,0,1);
$pdf->Cell(0,10,'Outstanding Balance :'.$balance ,0,1);
$pdf->SetFont('','U');
$pdf->Cell(0,10,'Comment');
$pdf->SetFont('','');
$pdf->Ln();
$pdf->Cell(100,10,$msg,1,0,'L',0);

//this ln things are ment to put line breaks great!!!!
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('','');
//change the color from the current blue to black, kudos
$pdf->SetTextColor(0,0,0);
$pdf->Write(10,'Accountant                                                                                                                                               Principal');
$pdf->Ln();
$pdf->Write(10,'------------------------------------------------------------------------------------------------------------------------------------------------------------');
$pdf->Ln();
$pdf->SetFont('Arial','I','U',9);
$pdf->SetTextColor(255,0,0);
$pdf->Write(10,'Payment Method:');
//$pdf->Image('assets/img/equity.png',10,10,-300);//this will output the image at the right top
//$pdf->Image('assets/img/equity.png',10,10,-300);//this will output the image at the right top
$pdf->Ln();
$pdf->Write(10,'Equiry Bank, Ruiru Branch');
$pdf->Ln();
$pdf->Write(10,'A/C NO: 0 8 7 0 2 6 3 6 6 3 3 6 9');
// Then put a blue underlined link TO THE WEBSITE

$pdf->SetTextColor(0,0,0);
$pdf->SetFont('','');
$pdf->Ln();
$pdf->Write(10,'Website:');
$pdf->SetTextColor(0,0,255);
$pdf->SetFont('','U');
$pdf->Write(10,'www.aberdareinstiute.ac.ke','http://www.aberdareinstiute.ac.ke');
$pdf->SetTextColor(0,0,0);
//nore text
$pdf->Ln();
$pdf->SetTextColor(0,0,0);
$pdf->SetFontSize(10);//set the font size of the last line
$pdf->SetFont('','u');
$pdf->Write(10,'Courses offered: Information Technology, Beauty & Hairdressing, Business Studies and Catering and Tourism');
$pdf->SetTextColor(0,0,0);


$pdf->Output();
?>