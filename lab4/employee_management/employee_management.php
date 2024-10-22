<?php
include('db_connect.php');

if (isset($_POST['insert'])) {
    $employee_name = $_POST['employee_name'];
    $employee_id = $_POST['employee_id'];
    $department_name = $_POST['department_name'];
    $phone_number = $_POST['phone_number'];
    $joining_date = $_POST['joining_date'];

    $sql = "INSERT INTO employees (employee_name, employee_id, department_name, phone_number, joining_date) 
            VALUES ('$employee_name', '$employee_id', '$department_name', '$phone_number', '$joining_date')";

    if ($conn->query($sql) === TRUE) {
        echo "New employee inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_POST['update'])) {
    $employee_name = $_POST['employee_name'];
    $employee_id = $_POST['employee_id'];
    $department_name = $_POST['department_name'];
    $phone_number = $_POST['phone_number'];
    $joining_date = $_POST['joining_date'];

    $sql = "UPDATE employees SET 
            employee_name='$employee_name', 
            department_name='$department_name', 
            phone_number='$phone_number', 
            joining_date='$joining_date' 
            WHERE employee_id='$employee_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Employee updated successfully!";
    } else {
        echo "Error updating employee: " . $conn->error;
    }
}

if (isset($_POST['delete'])) {
    $employee_id = $_POST['employee_id'];

    $sql = "DELETE FROM employees WHERE employee_id='$employee_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Employee deleted successfully!";
    } else {
        echo "Error deleting employee: " . $conn->error;
    }
}

if (isset($_POST['view'])) {
    $sql = "SELECT * FROM employees";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Employee Name</th>
                    <th>Employee ID</th>
                    <th>Department</th>
                    <th>Phone Number</th>
                    <th>Joining Date</th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["id"]."</td>
                    <td>".$row["employee_name"]."</td>
                    <td>".$row["employee_id"]."</td>
                    <td>".$row["department_name"]."</td>
                    <td>".$row["phone_number"]."</td>
                    <td>".$row["joining_date"]."</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No employees found";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <script>
        function validateForm() {
            var name = document.forms["employeeForm"]["employee_name"].value;
            var empId = document.forms["employeeForm"]["employee_id"].value;
            var phone = document.forms["employeeForm"]["phone_number"].value;
            var date = document.forms["employeeForm"]["joining_date"].value;
            
            if (name == "" || empId == "" || phone == "" || date == "") {
                alert("All fields must be filled out");
                return false;
            }

            var phonePattern = /^[0-9]+$/;
            if (!phone.match(phonePattern)) {
                alert("Please enter a valid phone number (digits only)");
                return false;
            }
            
            return true;
        }
    </script>
</head>
<body>
    <h1>Employee Management System</h1>

    <form name="employeeForm" action="employee_management.php" onsubmit="return validateForm()" method="POST">
        <label for="employee_name">Employee Name:</label><br>
        <input type="text" id="employee_name" name="employee_name" required><br><br>

        <label for="employee_id">Employee ID:</label><br>
        <input type="text" id="employee_id" name="employee_id" required><br><br>

        <label for="department_name">Department Name:</label><br>
        <input type="text" id="department_name" name="department_name" required><br><br>

        <label for="phone_number">Phone Number:</label><br>
        <input type="text" id="phone_number" name="phone_number" required><br><br>

        <label for="joining_date">Joining Date:</label><br>
        <input type="date" id="joining_date" name="joining_date" required><br><br>

        <input type="submit" name="insert" value="Insert Employee">
        <input type="submit" name="update" value="Update Employee">
        <input type="submit" name="delete" value="Delete Employee">
        <input type="submit" name="view" value="View Employees">
    </form>
</body>
</html>