<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Employee</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Employee</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="position" class="form-label">Position</label>
                <input type="text" class="form-control" id="position" name="position">
            </div>
            <div class="mb-3">
                <label for="salary" class="form-label">Salary</label>
                <input type="number" class="form-control" id="salary" name="salary" step="0.01">
            </div>
            <div class="mb-3">
                <label for="hireDate" class="form-label">Hire Date</label>
                <input type="date" class="form-control" id="hireDate" name="hireDate">
            </div>
            <div class="mb-3">
                <label for="departmentID" class="form-label">Department ID</label>
                <input type="number" class="form-control" id="departmentID" name="departmentID">
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col">
                    <!-- Button to jump back to employee page -->
                    <a class="btn btn-secondary mt-3" href="employee.php">Back</a>
                </div>
            </div>
        </form>
    </div>

    <?php
    // Include the database connection file
    include "dbconn.php";

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $name = $_POST["name"];
        $position = $_POST["position"];
        $salary = $_POST["salary"];
        $hireDate = $_POST["hireDate"];
        $departmentID = $_POST["departmentID"];

        // SQL insert query
        $sql = "INSERT INTO Employee (Name, Position, Salary, HireDate, DepartmentID) 
                VALUES (?, ?, ?, ?, ?)";

        // Prepare and execute the statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdsi", $name, $position, $salary, $hireDate, $departmentID);

        if ($stmt->execute()) {
            // Employee added successfully
            echo '<div class="alert alert-success mt-3" role="alert">New employee added successfully.</div>';
        } else {
            // Error occurred
            echo '<div class="alert alert-danger mt-3" role="alert">Error: ' . $sql . "<br>" . $conn->error . '</div>';
        }

        // Close the prepared statement
        $stmt->close();
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
