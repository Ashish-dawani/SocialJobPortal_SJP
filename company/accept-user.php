<?php

session_start();

require_once("../db.php");

$sql = "UPDATE apply_job_post SET status='2' WHERE id_jobpost='$_GET[id_jobpost]' AND id_user='$_GET[id_user]'";

if($conn->query($sql) === TRUE) {

	$sql1 = "SELECT * FROM job_post WHERE id_jobpost='$_GET[id_jobpost]'";
    $result1 = $conn->query($sql1);

  if($result1->num_rows > 0) {
    while($row = $result1->fetch_assoc()) 
    {

		// $to = $_GET['email'];

		// $subject = "Job Portal - Application Accepted!";

		// $message = '
		
		// <html>
		// <head>
		// 	<title>Job Portal - Application Accepted!</title>
		// <body>
		// 	<p>Good News! Your Application For '.$row['jobtitle'].' Has Been Accepted!</p>
		// </body>
		// </html>
		// ';

		// $headers[] = 'MIME-VERSION: 1.0';
		// $headers[] = 'Content-type: text/html; charset=iso-8859-1';
		// $headers[] = 'To: '.$to;
		// $headers[] = 'From: hello@yourdomain.com';
		// //you add more headers like Cc, Bcc;

		// $result = mail($to, $subject, $message, implode("\r\n", $headers)); // \r\n will return new line. 

		// if($result === TRUE) {

		// 	header("Location: view-job-applications.php");
		// 	exit();

		// }
		header("Location: view-job-applications.php");
		exit();
	}
	}
} else {
	echo "Error!";
}

$conn->close();