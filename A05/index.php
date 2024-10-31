<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Members</title>
</head>
<body>
    <h1>Group Members</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>gcMemberID</th>
            <th>userID</th>
            <th>gcID</th>
        </tr>
        <?php
        include("connect.php"); // Make sure this file is in the correct path

        // Define the SELECT query
        $sql = "SELECT gcMemberID, userID, gcID FROM gcmembers"; // Adjust table name if necessary

        // Execute the query and get the result
        $result = $conn->query($sql);

        // Check if the result variable is set and has rows
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row["gcMemberID"]) . "</td>
                        <td>" . htmlspecialchars($row["userID"]) . "</td>
                        <td>" . htmlspecialchars($row["gcID"]) . "</td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No records found</td></tr>";
        }
        ?>
    </table>

    <?php
    $conn->close();
    ?>
</body>
</html>
