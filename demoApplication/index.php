<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Salary Calculation</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Total Salary Calculation</h2>

    <?php
    // Configuration
    require_once 'config.php';

    // Sample data creation
    function createSampleData() {
        try {
            // Establish connection to MS SQL Server
            $conn = sqlsrv_connect($GLOBALS['serverName'], $GLOBALS['connectionOptions']);
            
            if ($conn === false) {
                throw new Exception("Failed to connect to MS SQL Server: " . print_r(sqlsrv_errors(), true));
            }

            // Sample data for employees table
            $sql = "
                INSERT INTO employees (employee_id, employee_name, salary)
                VALUES 
                (1, 'John Doe', 5000),
                (2, 'Jane Smith', 6000),
                (3, 'Michael Johnson', 5500)
            ";

            $stmt = sqlsrv_query($conn, $sql);
            if ($stmt === false) {
                throw new Exception("Failed to insert sample data into employees table: " . print_r(sqlsrv_errors(), true));
            }
            sqlsrv_free_stmt($stmt);

            // Sample data for loans table
            $sql = "
                INSERT INTO loans (employee_id, loan_amount)
                VALUES
                (1, 1000),
                (2, 2000)
            ";

            $stmt = sqlsrv_query($conn, $sql);
            if ($stmt === false) {
                throw new Exception("Failed to insert sample data into loans table: " . print_r(sqlsrv_errors(), true));
            }
            sqlsrv_free_stmt($stmt);

            // Sample data for salary_advances table
            $sql = "
                INSERT INTO salary_advances (employee_id, advance_amount)
                VALUES
                (1, 500),
                (3, 1000)
            ";

            $stmt = sqlsrv_query($conn, $sql);
            if ($stmt === false) {
                throw new Exception("Failed to insert sample data into salary_advances table: " . print_r(sqlsrv_errors(), true));
            }
            sqlsrv_free_stmt($stmt);

            // Sample data for deductions table
            $sql = "
                INSERT INTO deductions (employee_id, deduction_amount)
                VALUES
                (1, 200),
                (2, 150),
                (3, 300)
            ";

            $stmt = sqlsrv_query($conn, $sql);
            if ($stmt === false) {
                throw new Exception("Failed to insert sample data into deductions table: " . print_r(sqlsrv_errors(), true));
            }
            sqlsrv_free_stmt($stmt);

            echo "Sample data created successfully.";
            
        } catch (Exception $e) {
            // Handle errors
            echo "Error: " . $e->getMessage();
        }

        sqlsrv_close($conn);
    }

    // Data retrieval and calculation
    function calculateTotalSalary() {
        try {
            // Establish connection to MS SQL Server
            $conn = sqlsrv_connect($GLOBALS['serverName'], $GLOBALS['connectionOptions']);
            
            if ($conn === false) {
                throw new Exception("Failed to connect to MS SQL Server: " . print_r(sqlsrv_errors(), true));
            }

            // Retrieve data and calculate total salary
            $sql = "
                SELECT 
                    e.employee_id,
                    e.employee_name,
                    (e.salary + ISNULL(SUM(l.loan_amount), 0) + ISNULL(SUM(sa.advance_amount), 0) - ISNULL(SUM(d.deduction_amount), 0)) AS total_salary
                FROM 
                    employees e
                LEFT JOIN 
                    loans l ON e.employee_id = l.employee_id
                LEFT JOIN 
                    salary_advances sa ON e.employee_id = sa.employee_id
                LEFT JOIN 
                    deductions d ON e.employee_id = d.employee_id
                GROUP BY 
                    e.employee_id, e.employee_name, e.salary
            ";

            $stmt = sqlsrv_query($conn, $sql);

            if ($stmt === false) {
                throw new Exception("Failed to execute query: " . print_r(sqlsrv_errors(), true));
            }

            // Fetch data
            $data = array();
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $data[] = $row;
            }

            // Close statement and connection
            sqlsrv_free_stmt($stmt);
            sqlsrv_close($conn);

            // Display data in table
            echo "<table>";
            echo "<tr><th>Employee ID</th><th>Employee Name</th><th>Total Salary</th></tr>";
            foreach ($data as $row) {
                echo "<tr>";
                echo "<td>" . $row['employee_id'] . "</td>";
                echo "<td>" . $row['employee_name'] . "</td>";
                echo "<td>" . $row['total_salary'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            
        } catch (Exception $e) {
            // Handle errors
            echo "Error: " . $e->getMessage();
        }
    }

    // Check if action parameter is set
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        if ($action === 'create_sample_data') {
            createSampleData();
        } elseif ($action === 'calculate_total_salary') {
            calculateTotalSalary();
        } else {
            echo "Invalid action.";
        }
    } else {
        echo "No action specified.";
    }
    ?>
</body>
</html>
