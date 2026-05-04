<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
</head>
<body>

    <h2>Registration Form</h2>

    <?php
    $name = $email = $username = $pass = $confirm_pass = $age = $gender = $course = $terms = "";
    $nameErr = $emailErr = $usernameErr = $passErr = $confirm_passErr = $ageErr = $genderErr = $courseErr = $termsErr = "";
    $success = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $isValid = true;

        if (empty($_POST["name"])) {
            $nameErr = "Full Name is required";
            $isValid = false;
        } else {
            $name = test_input($_POST["name"]);
            if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                $nameErr = "Full Name must contain only letters and spaces";
                $isValid = false;
            }
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
            $isValid = false;
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
                $isValid = false;
            }
        }

        if (empty($_POST["username"])) {
            $usernameErr = "Username is required";
            $isValid = false;
        } else {
            $username = test_input($_POST["username"]);
            if (strlen($username) < 5) {
                $usernameErr = "Username must be at least 5 characters long";
                $isValid = false;
            }
        }

        if (empty($_POST["pass"])) {
            $passErr = "Password is required";
            $isValid = false;
        } else {
            $pass = $_POST["pass"];
            if (strlen($pass) < 6) {
                $passErr = "Password must be at least 6 characters long";
                $isValid = false;
            }
        }

        if (empty($_POST["confirm_pass"])) {
            $confirm_passErr = "Please confirm your password";
            $isValid = false;
        } else {
            $confirm_pass = $_POST["confirm_pass"];
            if ($pass !== $confirm_pass) {
                $confirm_passErr = "Passwords do not match";
                $isValid = false;
            }
        }

        if (empty($_POST["age"])) {
            $ageErr = "Age is required";
            $isValid = false;
        } else {
            $age = test_input($_POST["age"]);
            if ($age < 18) {
                $ageErr = "Age must be 18 or above";
                $isValid = false;
            }
        }

        if (empty($_POST["gender"])) {
            $genderErr = "Gender must be selected";
            $isValid = false;
        } else {
            $gender = $_POST["gender"];
        }

        if (empty($_POST["course"])) {
            $courseErr = "Course must be selected";
            $isValid = false;
        } else {
            $course = $_POST["course"];
        }

        if (!isset($_POST["terms"])) {
            $termsErr = "You must agree to the Terms & Conditions";
            $isValid = false;
        } else {
            $terms = "Agreed";
        }

        if ($isValid) {
            $success = true;
        }
    }

    function test_input($data) {
        $data = trim($data);      
        return $data;
    }
    ?>

    <?php if ($success): ?>
        <h3 style="color: green;">Registration Successful!</h3>
        <p><strong>Full Name:</strong> <?php echo $name; ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
        <p><strong>Username:</strong> <?php echo $username; ?></p>
        <p><strong>Age:</strong> <?php echo $age; ?></p>
        <p><strong>Gender:</strong> <?php echo $gender; ?></p>
        <p><strong>Course:</strong> <?php echo $course; ?></p>
        <p><strong>Terms:</strong> <?php echo $terms; ?></p>
    <?php else: ?>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <label>Full Name:</label><br>
            <input type="text" name="name" value="<?php echo $name; ?>">
            <span style="color:red;">* <?php echo $nameErr; ?></span><br><br>

            <label>Email Address:</label><br>
            <input type="email" name="email" value="<?php echo $email; ?>">
            <span style="color:red;">* <?php echo $emailErr; ?></span><br><br>

            <label>Username:</label><br>
            <input type="text" name="username" value="<?php echo $username; ?>">
            <span style="color:red;">* <?php echo $usernameErr; ?></span><br><br>

            <label>Password:</label><br>
            <input type="password" name="pass">
            <span style="color:red;">* <?php echo $passErr; ?></span><br><br>

            <label>Confirm Password:</label><br>
            <input type="password" name="confirm_pass">
            <span style="color:red;">* <?php echo $confirm_passErr; ?></span><br><br>

            <label>Age:</label><br>
            <input type="number" name="age" value="<?php echo $age; ?>">
            <span style="color:red;">* <?php echo $ageErr; ?></span><br><br>

            <label>Gender:</label><br>
            <input type="radio" name="gender" value="Male" <?php if($gender=="Male") echo "checked";?>> Male
            <input type="radio" name="gender" value="Female" <?php if($gender=="Female") echo "checked";?>> Female
            <span style="color:red;">* <?php echo $genderErr; ?></span><br><br>

            <label>Course Selection:</label><br>
            <select name="course">
                <option value="">Select Course</option>
                <option value="CSE" <?php if($course=="CSE") echo "selected";?>>CSE</option>
                <option value="EEE" <?php if($course=="EEE") echo "selected";?>>EEE</option>
                <option value="BBA" <?php if($course=="BBA") echo "selected";?>>BBA</option>
            </select>
            <span style="color:red;">* <?php echo $courseErr; ?></span><br><br>

            <input type="checkbox" name="terms" <?php if($terms=="Agreed") echo "checked";?>> I agree to the Terms & Conditions
            <span style="color:red;">* <?php echo $termsErr; ?></span><br><br>

            <input type="submit" value="Register">
        </form>
    <?php endif; ?>

</body>
</html>