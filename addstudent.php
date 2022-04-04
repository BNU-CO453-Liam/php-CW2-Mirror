<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

echo template("templates/partials/header.php");

// Setup html data
$data['content'] .= '<div class="container">';
$data['content'] .= '<form action="" method="post" enctype="multipart/form-data">';
$data['content'] .= '<h2>Add Student</h2><hr>';
$data['content'] .= '<input name="studentID" type="number" maxlength="8" placeholder="Student ID" required/><br/>';
$data['content'] .= '<input name="password" type="text" placeholder="Password" required/><br/>';
$data['content'] .= '<input name="dob" type="date" value="2018-07-22" max="2005-09-20" required/><br/>';
$data['content'] .= '<input name="firstname" type="text" placeholder="First Name" required/><br/>';
$data['content'] .= '<input name="lastname" type="text" placeholder="Last Name" required/><br/>';
$data['content'] .= '<input name="house" type="text" placeholder="House number and Street" required/><br/>';
$data['content'] .= '<input name="town" type="text" placeholder="Town" required/><br/>';
$data['content'] .= '<input name="county" type="text" placeholder="County" required/><br/>';
$data['content'] .= '<input name="country" type="text" placeholder="Country" required/><br/>';
$data['content'] .= '<input name="postcode" type="text" placeholder="Postcode" required/><br/>';
$data['content'] .= '<span style="color:7d7d7d">Upload photo :</span>';
$data['content'] .= '<input name="userimage" type="file" accept="image/jpeg/png" required/><br/>';
$data['content'] .= '<input type="submit" value="Save" name="addstudent"/>';
$data['content'] .= '</form>';
$data['content'] .= '</div>';

// render the template
echo template("templates/default.php", $data);

// check form submitted
if(isset($_POST['addstudent'])) {
   $pass = $_POST['password'];
   $_POST['password'] = get_hash_pswd($pass);

   // Prepare image
   $image = $_FILES['userimage']['tmp_name'];
   $imagedata = addslashes(fread(fopen($image, "r"), filesize($image)));

   // Build sql statment
   $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode, Image) ";
   $sql .= "VALUES ('$_POST[studentID]', '$_POST[password]', '$_POST[dob]', '$_POST[firstname]', '$_POST[lastname]', ";
   $sql .= "'$_POST[house]', '$_POST[town]', '$_POST[county]', '$_POST[country]', '$_POST[postcode]', '$imagedata');";

   // Execute sql query
   if($result = $conn->query($sql)) {
		header("Location: addstudent.php?success");
   }
}

echo template("templates/partials/footer.php");

?>
