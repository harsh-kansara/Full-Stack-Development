<?php
include 'db.php'; 

$book_name = $isbn_no = $book_title = $author_name = $publisher_name = '';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
    $book_name = $_POST['book_name'];
    $isbn_no = $_POST['isbn_no'];
    $book_title = $_POST['book_title'];
    $author_name = $_POST['author_name'];
    $publisher_name = $_POST['publisher_name'];

    if (empty($book_name)) {
        $errors[] = "Book name is required.";
    }
    if (empty($isbn_no)) {
        $errors[] = "ISBN No is required.";
    }
    if (empty($book_title)) {
        $errors[] = "Book title is required.";
    }
    if (empty($author_name)) {
        $errors[] = "Author name is required.";
    }
    if (empty($publisher_name)) {
        $errors[] = "Publisher name is required.";
    }

    if (empty($errors)) {
        $sql = "INSERT INTO books (book_name, isbn_no, book_title, author_name, publisher_name) 
                VALUES ('$book_name', '$isbn_no', '$book_title', '$author_name', '$publisher_name')";

        if ($conn->query($sql) === TRUE) {
            echo "New book added successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

if (isset($_POST['delete'])) {
    $isbn_no = $_POST['isbn_no_delete'];
    $sql = "DELETE FROM books WHERE isbn_no='$isbn_no'";
    if ($conn->query($sql) === TRUE) {
        echo "Book deleted successfully.";
    } else {
        echo "Error deleting book: " . $conn->error;
    }
}

if (isset($_POST['update'])) {
    $isbn_no = $_POST['isbn_no_update'];
    $book_name = $_POST['book_name_update'];
    $book_title = $_POST['book_title_update'];
    $author_name = $_POST['author_name_update'];
    $publisher_name = $_POST['publisher_name_update'];

    $sql = "UPDATE books 
            SET book_name='$book_name', book_title='$book_title', author_name='$author_name', publisher_name='$publisher_name' 
            WHERE isbn_no='$isbn_no'";
    if ($conn->query($sql) === TRUE) {
        echo "Book updated successfully.";
    } else {
        echo "Error updating book: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <script>
        function validateForm() {
            var bookName = document.forms["bookForm"]["book_name"].value;
            var isbnNo = document.forms["bookForm"]["isbn_no"].value;
            var bookTitle = document.forms["bookForm"]["book_title"].value;
            var authorName = document.forms["bookForm"]["author_name"].value;
            var publisherName = document.forms["bookForm"]["publisher_name"].value;

            if (bookName == "" || isbnNo == "" || bookTitle == "" || authorName == "" || publisherName == "") {
                alert("All fields must be filled out");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <h1>Library Management</h1>

    <?php
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
    ?>

    <form name="bookForm" action="" method="POST" onsubmit="return validateForm();">
        <label for="book_name">Book Name:</label>
        <input type="text" name="book_name"><br><br>

        <label for="isbn_no">ISBN No:</label>
        <input type="text" name="isbn_no"><br><br>

        <label for="book_title">Book Title:</label>
        <input type="text" name="book_title"><br><br>

        <label for="author_name">Author Name:</label>
        <input type="text" name="author_name"><br><br>

        <label for="publisher_name">Publisher Name:</label>
        <input type="text" name="publisher_name"><br><br>

        <input type="submit" name="insert" value="Add Book">
    </form>

    <h2>Delete a Book</h2>
    <form action="" method="POST">
        <label for="isbn_no_delete">ISBN No:</label>
        <input type="text" name="isbn_no_delete"><br><br>
        <input type="submit" name="delete" value="Delete Book">
    </form>

    <h2>Update Book Details</h2>
    <form action="" method="POST">
        <label for="isbn_no_update">ISBN No:</label>
        <input type="text" name="isbn_no_update"><br><br>

        <label for="book_name_update">Book Name:</label>
        <input type="text" name="book_name_update"><br><br>

        <label for="book_title_update">Book Title:</label>
        <input type="text" name="book_title_update"><br><br>

        <label for="author_name_update">Author Name:</label>
        <input type="text" name="author_name_update"><br><br>

        <label for="publisher_name_update">Publisher Name:</label>
        <input type="text" name="publisher_name_update"><br><br>
        <input type="submit" name="update" value="Update Book">
    </form>

    <h2>Book Records</h2>
    <table border="1">
        <tr>
            <th>Book Name</th>
            <th>ISBN No</th>
            <th>Book Title</th>
            <th>Author Name</th>
            <th>Publisher Name</th>
        </tr>

        <?php
        $sql = "SELECT book_name, isbn_no, book_title, author_name, publisher_name FROM books";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['book_name']}</td>
                        <td>{$row['isbn_no']}</td>
                        <td>{$row['book_title']}</td>
                        <td>{$row['author_name']}</td>
                        <td>{$row['publisher_name']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No records found</td></tr>";
        }
        ?>

    </table>
</body>
</html>

<?php $conn->close(); ?>