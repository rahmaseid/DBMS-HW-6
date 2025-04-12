<?php
// HW6.php
// This script demonstrates the use of PHP to create a simple web page that displays a list of items.
$servername = "127.0.0.1:3308";
$username = "root";
$password = "";
$dbname = "supplierpartshipment";
$conn = new mysqli($servername, $username, $password, $dbname);

//check connection
if ($conn->connect_error) {
    die("Fail: " . $conn->connect_error);
}

echo "Connected successfully!!! <br>";
echo "<br>";
echo "<br>";

if (isset($_POST['Q1'])) {
    $Sno = $_POST['Sno'] ?? null;
    $Pno = $_POST['Pno'] ?? null;
    $Qty = isset($_POST['Qty']) ? (int)$_POST['Qty'] : null;
    $Price = isset($_POST['Price']) ? (float)$_POST['Price'] : null;

    $sql = "INSERT INTO SHIPMENT (Sno, Pno, Qty, Price)
            VALUES ('$Sno', '$Pno', '$Qty', '$Price')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        echo "<br>";
    } else {
        echo "Error!! New record creation failed: " . $sql . "<br>" . $conn->error;
        echo "<br>";
    }
}

if (isset($_POST['Q2'])) {
    $Sno = $_POST['Sno'] ?? null;
    $Pno = $_POST['Pno'] ?? null;
    $Qty = isset($_POST['Qty']) ? (int)$_POST['Qty'] : null;
    $Price = isset($_POST['Price']) ? (float)$_POST['Price'] : null;

    $sql = "INSERT INTO SHIPMENT (Sno, Pno, Qty, Price)
            VALUES ('$Sno', '$Pno', '$Qty', '$Price')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        echo "<br>";
    } else {
        echo "Error!! New record creation failed: " . $sql . "<br>" . $conn->error;
        echo "<br>";
    }
}

if (isset($_POST['Q3'])) {
    if (isset($_POST['Percent'])) {
        $Percent = $_POST['Percent'];
    } else {
        $Percent = 0.0;
    }

    $Percent = $Percent / 100.0;
    $sql = "UPDATE SUPPLIER SET Status = Status + (Status * ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("d", $Percent);
        if ($stmt->execute()) {
            echo "Supplier status updated successfully";
        } else {
            echo "Execution failed: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Status preparation failed: " . $conn->error;
    }
}

if (isset($_POST['Q4'])) {
    $sql = "SELECT * FROM SUPPLIER";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h3>Supplier Info</h3>";
        echo "<table border = '1'>";
        echo "<tr>
            <th>Sno</th>
            <th>Sname</th>
            <th>Status</th>
            <th>City</th>
        </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . htmlspecialchars($row["Sno"]) . "</td>
                <td>" . htmlspecialchars($row["Sname"]) . "</td>
                <td>" . htmlspecialchars($row["Status"]) . "</td>
                <td>" . htmlspecialchars($row["City"]) . "</td>
            </tr>";
        }
        echo "</table>";
    } else {
        echo "No records found";
    }
}

if (isset($_POST['Q5'])) {
    if (isset($_POST['Pno'])) {
        $Pno = $_POST['Pno'];

        $sql = "SELECT DISTINCT s.Sno, s.Sname,s.Status, s.City 
                FROM SUPPLIER s
                JOIN SHIPMENT sh ON s.Sno = sh.Sno 
                WHERE  sh.Pno = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $Pno);

            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo "<h3>Suppliers who've shipped part: " . htmlspecialchars($Pno) . "</h3>";
                    echo "<table border = '1'>";
                    echo "<tr>
                        <th>Sno</th>
                        <th>Sname</th>
                        <th>Status</th>
                        <th>City</th>
                    </tr>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . htmlspecialchars($row["Sno"]) . "</td>
                            <td>" . htmlspecialchars($row["Sname"]) . "</td>
                            <td>" . htmlspecialchars($row["Status"]) . "</td>
                            <td>" . htmlspecialchars($row["City"]) . "</td>
                        </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No records found";
                }
            } else {
                echo "Execution failed: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Preparation failed: " . $conn->error;
        }
    } else {
        echo "No pno was provided";
    }
}

$conn->close();
