<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Mangement System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
        .error {
            color: red;
            font-size: 0.9em;
        }
        .success {
            color: green;
            font-weight: bold;
        }
        .btn {
            padding: 12px 25px; 
            font-size: 16px;
        }
        input {
            margin: 8px 0;
            padding: 8px;
            width: 320px;
        }
        label {
            font-weight: bold;
        }
    </style>
</head>
<body>
 
    <h2>University Management System - Form</h2>
 
    <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "student_management";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
   
    // variables
    $name = $email = $reg = $dept = "";
    $nameErr = $emailErr = $regErr = $deptErr = "";
    $success = "";
 
    if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
 
        // name
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }
 
        // email
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format (must contain @)";
            }
        }
 
        // phone
        if (empty($_POST["reg"])) {
            $regErr = "Registration number is required";
        } else {
            $reg = test_input($_POST["reg"]);
            // if (!preg_match("/^[0-9]{11}$/", $phone)) {
            //     $phoneErr = "Phone number must be exactly 11 digits";
            // }
        }

        // city
        if (empty($_POST['dept'])) {
            $deptErr = "Department is required";
        } else { 
                $dept = test_input(($_POST["dept"]));
                // if (!preg_match("/^[a-zA-Z- ]*$/", $city)) {
                //     $dept = "Only letters and white spaces allowed";
                // }
                // else if ($city != "Dhaka" || $city != "Sirajganj") {
                //     $cityErr = "Only Dhaka and Sirajganj allowed";
                // }
                
        }
 
     
        if (empty($nameErr) && empty($emailErr) && empty($regErr) && empty($deptErr)) {

            $sql = "INSERT INTO students (name, email, registration_no, department) 
            VALUES ('$name', '$email', '$reg', '$dept')";

            if (mysqli_query($conn, $sql)) {
                $success = "New record created successfully!";
                $name = $email = $reg = $dept = "";
            } else {
                $success = "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
 
   
    function test_input($data) {
        $data = trim($data);      
        return $data;
    }
 
 
    ?>
 
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
 
        <label>Name:</label><br>
        <input type="text" name="name" value="<?php echo $name; ?>" >
        <span class="error">* <?php echo $nameErr; ?></span><br><br>
 
        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo $email; ?>" >
        <span class="error">* <?php echo $emailErr; ?></span><br><br>
 
        <label>Registration Number:</label><br>
        <input type="text" name="reg" value="<?php echo $reg; ?>" >
        <span class="error">* <?php echo $regErr; ?></span><br><br>

        <label>Department:</label><br>
        <input type="text" name="dept" value="<?php echo $dept; ?>" >
        <span class="error">* <?php echo $deptErr; ?></span><br><br>
 
        <input type="submit" value="Add student" class="btn">
    </form>

    <a href="records.php" class="btn">View Records</a>

 
    <?php if ($success) echo "<p class='success'>$success</p>"; ?>
 
</body>
</html>