<?php
include('db_connect.php');

if (isset($_POST['insert'])) {
    $passenger_name = $_POST['passenger_name'];
    $from_location = $_POST['from_location'];
    $to_location = $_POST['to_location'];
    $departure_date = $_POST['departure_date'];
    $arrival_date = $_POST['arrival_date'];
    $phone_number = $_POST['phone_number'];
    $email_id = $_POST['email_id'];

    $sql = "INSERT INTO passengers (passenger_name, from_location, to_location, departure_date, arrival_date, phone_number, email_id) 
            VALUES ('$passenger_name', '$from_location', '$to_location', '$departure_date', '$arrival_date', '$phone_number', '$email_id')";

    if ($conn->query($sql) === TRUE) {
        echo "New flight booking inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_POST['update'])) {
    $passenger_name = $_POST['passenger_name'];
    $from_location = $_POST['from_location'];
    $to_location = $_POST['to_location'];
    $departure_date = $_POST['departure_date'];
    $arrival_date = $_POST['arrival_date'];
    $phone_number = $_POST['phone_number'];
    $email_id = $_POST['email_id'];

    $sql = "UPDATE passengers SET 
            passenger_name='$passenger_name', 
            from_location='$from_location', 
            to_location='$to_location', 
            departure_date='$departure_date', 
            arrival_date='$arrival_date', 
            email_id='$email_id' 
            WHERE phone_number='$phone_number'";

    if ($conn->query($sql) === TRUE) {
        echo "Flight booking updated successfully!";
    } else {
        echo "Error updating booking: " . $conn->error;
    }
}

if (isset($_POST['delete'])) {
    $phone_number = $_POST['phone_number'];

    $sql = "DELETE FROM passengers WHERE phone_number='$phone_number'";

    if ($conn->query($sql) === TRUE) {
        echo "Flight booking deleted successfully!";
    } else {
        echo "Error deleting booking: " . $conn->error;
    }
}

if (isset($_POST['view'])) {
    $sql = "SELECT * FROM passengers";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Passenger Name</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Departure Date</th>
                    <th>Arrival Date</th>
                    <th>Phone Number</th>
                    <th>Email ID</th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["id"]."</td>
                    <td>".$row["passenger_name"]."</td>
                    <td>".$row["from_location"]."</td>
                    <td>".$row["to_location"]."</td>
                    <td>".$row["departure_date"]."</td>
                    <td>".$row["arrival_date"]."</td>
                    <td>".$row["phone_number"]."</td>
                    <td>".$row["email_id"]."</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No flight bookings found";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Booking Management System</title>
    <script>
        function validateForm() {
            var name = document.forms["flightForm"]["passenger_name"].value;
            var phone = document.forms["flightForm"]["phone_number"].value;
            var email = document.forms["flightForm"]["email_id"].value;
            var fromLocation = document.forms["flightForm"]["from_location"].value;
            var toLocation = document.forms["flightForm"]["to_location"].value;
            var departure = document.forms["flightForm"]["departure_date"].value;
            var arrival = document.forms["flightForm"]["arrival_date"].value;

            if (name == "" || phone == "" || email == "" || fromLocation == "" || toLocation == "" || departure == "" || arrival == "") {
                alert("All fields must be filled out");
                return false;
            }

            var phonePattern = /^[0-9]+$/;
            if (!phone.match(phonePattern)) {
                alert("Please enter a valid phone number (digits only)");
                return false;
            }

            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!email.match(emailPattern)) {
                alert("Please enter a valid email address");
                return false;
            }
            
            return true;
        }
    </script>
</head>
<body>
    <h1>Flight Booking Management System</h1>

    <form name="flightForm" action="flight_management.php" onsubmit="return validateForm()" method="POST">
        <label for="passenger_name">Passenger Name:</label><br>
        <input type="text" id="passenger_name" name="passenger_name" required><br><br>

        <label for="from_location">From:</label><br>
        <input type="text" id="from_location" name="from_location" required><br><br>

        <label for="to_location">To:</label><br>
        <input type="text" id="to_location" name="to_location" required><br><br>

        <label for="departure_date">Departure Date:</label><br>
        <input type="date" id="departure_date" name="departure_date" required><br><br>

        <label for="arrival_date">Arrival Date:</label><br>
        <input type="date" id="arrival_date" name="arrival_date" required><br><br>

        <label for="phone_number">Phone Number:</label><br>
        <input type="text" id="phone_number" name="phone_number" required><br><br>

        <label for="email_id">Email ID:</label><br>
        <input type="email" id="email_id" name="email_id" required><br><br>

        <input type="submit" name="insert" value="Insert Booking">
        <input type="submit" name="update" value="Update Booking">
        <input type="submit" name="delete" value="Delete Booking">
        <input type="submit" name="view" value="View Bookings">
    </form>
</body>
</html>