<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>employees</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
   <div class="container my-5">
        <h2>List of Employees</h2>
        <!-- Link to create a new employee -->
        <a class="btn btn-primary" href="/mycompany/employeecreate.php" role="button">New Employee</a>
        <br>
        <!-- Employee table -->
        <table class="table">
            <thead>
            <tr>
                <th>EmployeeID</th>
                <th>Name</th>
                <th>Position</th>
                <th>Salary</th>
                <th>HireDate</th>
                <th>DepartmentID</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                <?php
                // Prevent caching
                header("Cache-Control: no-cache");
                
                // Database connection parameters
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "mycompany";
                
                // Create a database connection
                $conn = new mysqli($servername, $username, $password, $database);
                
                // Check if the connection was successful
                if ($conn->connect_error) {
                    die("Connection Failed: " . $conn->connect_error);
                }

                // SQL query to retrieve employee data
                $sql = "SELECT * FROM Employee";
                
                // Execute the SQL query
                $result = $conn->query($sql);

                // Check if any rows were returned
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>{$row['EmployeeID']}</td>
                            <td>{$row['Name']}</td>
                            <td>{$row['Position']}</td>
                            <td>{$row['Salary']}</td>
                            <td>{$row['HireDate']}</td>
                            <td>{$row['DepartmentID']}</td>
                            <td>
                               <a class='btn btn-primary btn-sm' href='/mycompany/employee_edit.php?EmployeeID={$row['EmployeeID']}'>Edit</a>
                               <a class='btn btn-danger btn-sm' href='/mycompany/employee_delete.php?EmployeeID={$row['EmployeeID']}' onclick='return confirm(\"Are you sure you want to delete this employee?\")'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    // Display a message if no employees were found
                    echo "<tr><td colspan='7'>No employees found</td></tr>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
