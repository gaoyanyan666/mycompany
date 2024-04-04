<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <?php
    include "dbconn.php";

    // Check if the 'id' parameter is set
    if (isset($_REQUEST["EmployeeID"])) {
        $EmployeeID = $_REQUEST["EmployeeID"];

        // SQL query to select data from the Employee table based on the provided EmployeeID
        $sql = "SELECT * FROM Employee WHERE EmployeeID = ?";

        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);

        // Bind the parameter to the SQL statement
        $stmt->bind_param("i", $EmployeeID);

        // Execute the SQL statement
        $stmt->execute();

        // Get the result of the SQL query
        $result = $stmt->get_result();

        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            // Fetch the row as an associative array
            $row = $result->fetch_assoc();
        } else {
            // No employee found with the provided ID
            echo '<div class="alert alert-danger" role="alert">No employee found with the provided ID.</div>';
            exit(); // Stop further execution
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // 'id' parameter is not set
        echo '<div class="alert alert-danger" role="alert">Employee ID is not provided.</div>';
        exit(); // Stop further execution
    }
    ?>

    <h2>Edit Employee</h2>
    <form action="update_employee.php" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $row["Name"] ?>">
        </div>
        <div class="form-group">
            <label for="position">Position:</label>
            <input type="text" class="form-control" id="position" name="position" value="<?php echo $row["Position"] ?>">
        </div>
        <div class="form-group">
            <label for="salary">Salary:</label>
            <input type="number" class="form-control" id="salary" name="salary" value="<?php echo $row["Salary"] ?>">
        </div>
        <div class="form-group">
            <label for="hireDate">Hire Date:</label>
            <input type="date" class="form-control" id="hireDate" name="hireDate" value="<?php echo $row["HireDate"] ?>">
        </div>
        <div class="form-group">
            <label for="departmentID">Department ID:</label>
            <input type="number" class="form-control" id="departmentID" name="departmentID" value="<?php echo $row["DepartmentID"] ?>">
        </div>
        <input type="hidden" id="id" name="id" value="<?php echo $row["EmployeeID"] ?>">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


</body>
</html>
