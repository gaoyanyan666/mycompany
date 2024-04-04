<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <?php
    include "dbconn.php";

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $id = $_POST["id"];
        $name = $_POST["name"];
        $position = $_POST["position"];
        $salary = $_POST["salary"];
        $hireDate = $_POST["hireDate"];
        $departmentID = $_POST["departmentID"];

        // SQL update query for the Employee table
        $sql = "UPDATE Employee 
                SET Name=?, Position=?, Salary=?, HireDate=?, DepartmentID=?
                WHERE EmployeeID=?";

        // Prepare and execute the statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdsii", $name, $position, $salary, $hireDate, $departmentID, $id);

        if ($stmt->execute()) {
            // Employee updated successfully
            echo '<div class="alert alert-success mt-3" role="alert">Employee updated successfully.</div>';
            // Add a button to jump back to the employee list page
            echo '<a class="btn btn-primary mt-3" href="employee.php">Back to Employee List</a>';
        } else {
            // Error occurred
            echo '<div class="alert alert-danger mt-3" role="alert">Error updating employee: ' . $stmt->error . '</div>';
        }

        // Close the prepared statement
        $stmt->close();
    }

    // Close the database connection
    $conn->close();
    ?>
</div>

</body>
</html>
