<?php
include 'db.php';

$first_name = $last_name = $roll_no = $password = $confirm_password = $contact_number = '';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $roll_no = $_POST['roll_no'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $contact_number = $_POST['contact_number'];

    if (empty($first_name)) {
        $errors[] = "First name is required.";
    }
    if (empty($last_name)) {
        $errors[] = "Last name is required.";
    }
    if (empty($roll_no)) {
        $errors[] = "Roll No is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }
    if (empty($contact_number)) {
        $errors[] = "Contact number is required.";
    }

    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO students (first_name, last_name, roll_no, password, contact_number) 
                VALUES ('$first_name', '$last_name', '$roll_no', '$hashed_password', '$contact_number')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

if (isset($_POST['delete'])) {
    $roll_no = $_POST['roll_no_delete'];
    $sql = "DELETE FROM students WHERE roll_no='$roll_no'";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

if (isset($_POST['update'])) {
    $roll_no = $_POST['roll_no_update'];
    $contact_number = $_POST['contact_update'];

    $sql = "UPDATE students SET contact_number='$contact_number' WHERE roll_no='$roll_no'";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration System</title>
    <script>
        function validateForm() {
            var firstName = document.forms["studentForm"]["first_name"].value;
            var lastName = document.forms["studentForm"]["last_name"].value;
            var rollNo = document.forms["studentForm"]["roll_no"].value;
            var password = document.forms["studentForm"]["password"].value;
            var confirmPassword = document.forms["studentForm"]["confirm_password"].value;
            var contactNumber = document.forms["studentForm"]["contact_number"].value;

            if (firstName == "" || lastName == "" || rollNo == "" || password == "" || contactNumber == "") {
                alert("All fields must be filled out");
                return false;
            }

            if (password != confirmPassword) {
                alert("Passwords do not match");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <h1>Student Registration</h1>

    <?php
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
    ?>

    <form name="studentForm" action="" method="POST" onsubmit="return validateForm();">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name"><br><br>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name"><br><br>

        <label for="roll_no">Roll No:</label>
        <input type="text" name="roll_no"><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password"><br><br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password"><br><br>

        <label for="contact_number">Contact Number:</label>
        <input type="text" name="contact_number"><br><br>

        <input type="submit" value="Register">
    </form>

    <h2>Delete a Student</h2>
    <form action="" method="POST">
        <label for="roll_no_delete">Roll No:</label>
        <input type="text" name="roll_no_delete"><br><br>
        <input type="submit" name="delete" value="Delete">
    </form>

    <h2>Update Contact Number</h2>
    <form action="" method="POST">
        <label for="roll_no_update">Roll No:</label>
        <input type="text" name="roll_no_update"><br><br>

        <label for="contact_update">New Contact Number:</label>
        <input type="text" name="contact_update"><br><br>
        <input type="submit" name="update" value="Update">
    </form>

    <h2>Students Record</h2>
    <table border="1">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Roll No</th>
            <th>Contact Number</th>
        </tr>

        <?php
        $sql = "SELECT first_name, last_name, roll_no, contact_number FROM students";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['first_name']}</td>
                        <td>{$row['last_name']}</td>
                        <td>{$row['roll_no']}</td>
                        <td>{$row['contact_number']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No records found</td></tr>";
        }
        ?>

    </table>
</body>
</html>

<?php $conn->close(); ?>