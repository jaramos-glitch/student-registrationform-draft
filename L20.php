<!DOCTYPE html>
<html>
<head>
    <title>Lab 20: Student Registration Form</title>
    <style>
        /* Modern Black & White Theme */
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background-color: #000; /* solid black background */
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        .form-section {
            background: #111; /* deep black card */
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(255,255,255,0.1);
            width: 420px;
            animation: fadeInUp 0.8s ease;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #fff;
            font-size: 22px;
            letter-spacing: 1px;
        }

        label {
            display: block;
            margin-top: 14px;
            font-weight: bold;
            color: #ddd;
        }

        input[type="text"], input[type="email"], input[type="number"], 
        input[type="password"], select, textarea {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            border: 1px solid #444;
            border-radius: 6px;
            font-size: 14px;
            background-color: #000;
            color: #fff;
            transition: all 0.3s ease;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #fff;
            box-shadow: 0 0 8px rgba(255,255,255,0.6);
            outline: none;
        }

        input[type="radio"], input[type="checkbox"] {
            margin-right: 6px;
        }

        input[type="submit"], input[type="reset"] {
            background: #fff;
            color: #000;
            border: none;
            padding: 12px 20px;
            border-radius: 6px;
            cursor: pointer;
            transition: transform 0.2s ease, background 0.3s ease;
            margin-top: 20px;
            margin-right: 10px;
            width: 48%;
            font-weight: bold;
        }

        input[type="submit"]:hover, input[type="reset"]:hover {
            background: #ddd;
            transform: scale(1.05);
        }

        .output {
            margin-top: 25px;
            padding: 15px;
            background-color: #000;
            border-left: 5px solid #fff;
            border-radius: 6px;
            font-size: 15px;
            color: #fff;
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<div class="form-section">
    <h2>Lab 20: Student Registration Form</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Name</label>
        <input type="text" name="reg_name" required>

        <label>Email</label>
        <input type="email" name="reg_email" required>

        <label>Age</label>
        <input type="number" name="reg_age" min="1" max="120" required>

        <label>Password</label>
        <input type="password" name="reg_password" required>

        <label>Gender</label>
        <input type="radio" name="reg_gender" value="Male"> Male
        <input type="radio" name="reg_gender" value="Female"> Female
        <input type="radio" name="reg_gender" value="Other"> Other

        <label>Course</label>
        <select name="reg_course" required>
            <option value="">Choose a Course</option>
            <option value="BSIT">BSIT</option>
            <option value="BSCS">BSOA</option>
            <option value="BSIS">CSS</option>
        </select>

        <label>Hobbies</label>
        <input type="checkbox" name="reg_hobbies[]" value="Reading"> Reading
        <input type="checkbox" name="reg_hobbies[]" value="Playing Games"> Playing Games
        <input type="checkbox" name="reg_hobbies[]" value="Watching Netflix"> Watching Netflix

        <label>Message</label>
        <textarea name="reg_message" rows="4" required></textarea>

        <div style="display:flex; justify-content:space-between;">
            <input type="submit" value="Register">
            <input type="reset" value="Reset">
        </div>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $errors = [];
        if (empty($_POST["reg_name"])) $errors[] = "Name is required.";
        if (empty($_POST["reg_email"])) $errors[] = "Email is required.";
        elseif (!filter_var($_POST["reg_email"], FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format.";
        if (empty($_POST["reg_age"])) $errors[] = "Age is required.";
        elseif (!is_numeric($_POST["reg_age"]) || $_POST["reg_age"] < 1 || $_POST["reg_age"] > 120) $errors[] = "Age must be between 1 and 120.";
        if (empty($_POST["reg_password"])) $errors[] = "Password is required.";
        if (empty($_POST["reg_gender"])) $errors[] = "Gender is required.";
        if (empty($_POST["reg_course"])) $errors[] = "Course is required.";
        if (empty($_POST["reg_message"])) $errors[] = "Message is required.";

        if (!empty($errors)) {
            echo "<div class='output'><h3>Errors:</h3>";
            foreach ($errors as $err) {
                echo htmlspecialchars($err) . "<br>";
            }
            echo "</div>";
        } else {
            echo "<div class='output'><h3>Registration Successful!</h3>";
            echo "Name: " . htmlspecialchars($_POST["reg_name"]) . "<br>";
            echo "Email: " . htmlspecialchars($_POST["reg_email"]) . "<br>";
            echo "Age: " . htmlspecialchars($_POST["reg_age"]) . "<br>";
            echo "Gender: " . htmlspecialchars($_POST["reg_gender"]) . "<br>";
            echo "Course: " . htmlspecialchars($_POST["reg_course"]) . "<br>";
            if (!empty($_POST["reg_hobbies"])) {
                echo "Hobbies: " . implode(", ", array_map('htmlspecialchars', $_POST["reg_hobbies"])) . "<br>";
            }
            echo "Message: " . nl2br(htmlspecialchars($_POST["reg_message"])) . "<br></div>";
        }
    }
    ?>
</div>

</body>
</html>