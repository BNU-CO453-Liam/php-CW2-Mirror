<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// render the header
echo template("templates/partials/header.php");

// Prepare sql statement
$sql = "SELECT * FROM student";

// Execute sql or display error
if (!$result = $conn->query($sql)) {
    echo $conn->error;
} else {

    // prepare page content
    $data['content'] .= "<form method='post' action=''>";
    $data['content'] .= "<h2>Students</h2><hr>";
    $data['content'] .= "<table align='center' border='1'>";
    $data['content'] .= "<tr><th>Student ID</th><th>Password</th><th>DOB</th>";
    $data['content'] .= "<th>First Name</th><th>Last Name</th><th>Address</th>";
    $data['content'] .= "<th>Town</th><th>County</th><th>Country</th><th>Postcode</th>";
    $data['content'] .= "<th>Image</th><th>Select</th></tr>";

    while ($row = mysqli_fetch_array($result)) {
        $data['content'] .= "<tr>";
        $data['content'] .= "<td>" . $row['studentid'] . "</td>";
        $data['content'] .= "<td>" . $row['password'] . "</td>";
        $data['content'] .= "<td>" . $row['dob'] . "</td>";
        $data['content'] .= "<td>" . $row['firstname'] . "</td>";
        $data['content'] .= "<td>" . $row['lastname'] . "</td>";
        $data['content'] .= "<td>" . $row['house'] . "</td>";
        $data['content'] .= "<td>" . $row['town'] . "</td>";
        $data['content'] .= "<td>" . $row['county'] . "</td>";
        $data['content'] .= "<td>" . $row['country'] . "</td>";
        $data['content'] .= "<td>" . $row['postcode'] . "</td>";
		$data['content'] .= "<td><img style='width:100px'";
		$data['content'] .= " src='data:image/jpeg/png;base64," . base64_encode($row['image']) . "'</img></td>";
        $data['content'] .= "<td> &nbsp <input type='checkbox' name='checkbox[]' ";
        $data['content'] .= "value=" . $row['studentid'] . " />&nbsp;</td>";
        $data['content'] .= "</tr>";
    }

    $data['content'] .= "</table></br>";
    $data['content'] .= "<input class='btn-danger button'";
    $data['content'] .= "type='submit' value='Delete' name='delbtn'/>";
    $data['content'] .= "</form>";
}

// Initiate delete
if (isset($_POST['delbtn']) && isset($_POST['checkbox'])) {

	$arr = $_POST['checkbox'];

	// Copy post array of checkbox to session
	$_SESSION['idArray'] = $_POST['checkbox'];

    // prepare page content
	$data['content'] .= "</br></br>";
	$data['content'] .= "<form id='confirm' style='margin:auto;text-align:center;' method='GET' action=''>";
	$data['content'] .= "<span style='color:red;'>Are you sure? </span></br>";
	$data['content'] .= "<select name='confirm'>";
	$data['content'] .= "<option value='Yes'>Yes</option>";
	$data['content'] .= "<option value='No' selected>No</option>";
	$data['content'] .= "</select><br/>";
	$data['content'] .= "<input class='btn-danger button' type='submit' name='conbtn' value='confirm'/>";
	$data['content'] .= "</form>";
}

// Confirm delete
if (isset($_GET['conbtn'])) {

	$arr = $_SESSION['idArray'];

    if ($_GET['confirm'] == "Yes") {
        foreach ($arr as $value) {
            // prepare sql statement
            $sql = "DELETE from student WHERE studentid=" . $value;
            // Execute delete
			$conn->query($sql);
        }
	// Refresh page with updated table
	echo '<script> location.replace("students.php?success"); </script>';
    }
}

// render the template
echo template("templates/default.php", $data);

// render the footer
echo template("templates/partials/footer.php");

// Close connection to database
$conn->close();
?>
