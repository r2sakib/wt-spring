<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Records</title>
    <style>
        .btn {
            padding: 12px 25px; 
            font-size: 16px;
        }
    </style>
</head>
<body>

    <h2>Student Records</h2>
    <a href="form.php" class="btn">Add New Student</a>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "student_management";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT id, name, email, registration_no, department FROM students";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registration</th>
                    <th>Department</th>
                </tr>";

        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["name"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["registration_no"] . "</td>
                    <td>" . $row["department"] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No records found.</p>";
    }

    mysqli_close($conn);
    ?>

</body>
</html>