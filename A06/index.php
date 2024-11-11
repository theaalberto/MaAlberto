<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Members</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #a8dadc; 
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 20px; 
            height: 100%;
            min-height: 100vh;
        }
        h1 {
            font-size: 2.5em;
            color: #1d3557; 
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            width: 100%; 
            white-space: nowrap; 
        }
        .container {
            max-width: 100%; 
            padding: 20px;
        }
        .required:after {
            content: " *";
            color: red;
        }
    </style>
</head>
<body>
    <div class="container my-5" style="max-width: 600px;">
        <h1 class="text-center mb-4">Group Members</h1>
        
        <div class="table-responsive mb-5">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">gcMemberID</th>
                        <th scope="col">userID</th>
                        <th scope="col">gcID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include("connect.php");

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $gcMemberID = $_POST["gcMemberID"];

                        if (isset($_POST["submit"])) {
                            // Add member
                            $userID = $_POST["userID"];
                            $gcID = $_POST["gcID"];

                            $insertSql = "INSERT INTO gcmembers (gcMemberID, userID, gcID) VALUES (?, ?, ?)";
                            $stmt = $conn->prepare($insertSql);
                            $stmt->bind_param("sss", $gcMemberID, $userID, $gcID);

                            if ($stmt->execute()) {
                                echo "<div class='alert alert-success'>New member added successfully!</div>";
                            } else {
                                echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
                            }
                        } elseif (isset($_POST["delete"])) {
                            // Delete member
                            $deleteSql = "DELETE FROM gcmembers WHERE gcMemberID = ?";
                            $stmt = $conn->prepare($deleteSql);
                            $stmt->bind_param("s", $gcMemberID);

                            if ($stmt->execute()) {
                                echo "<div class='alert alert-success'>Member deleted successfully!</div>";
                            } else {
                                echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
                            }
                        }
                    }

                    $sql = "SELECT gcMemberID, userID, gcID FROM gcmembers";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row["gcMemberID"]) . "</td>
                                    <td>" . htmlspecialchars($row["userID"]) . "</td>
                                    <td>" . htmlspecialchars($row["gcID"]) . "</td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3' class='text-center'>No records found</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>

        <div class="card mb-5">
            <div class="card-header bg-primary text-white">
                <h2 class="h5 mb-0">Add or Delete Group Member</h2>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="gcMemberID" class="form-label required">gcMemberID</label>
                        <input type="text" class="form-control" name="gcMemberID" id="gcMemberID" required>
                    </div>
                    <div class="mb-3">
                        <label for="userID" class="form-label">userID</label>
                        <input type="text" class="form-control" name="userID" id="userID">
                    </div>
                    <div class="mb-3">
                        <label for="gcID" class="form-label">gcID</label>
                        <input type="text" class="form-control" name="gcID" id="gcID">
                    </div>
                    <div class="d-flex">
                        <button type="submit" name="submit" class="btn btn-primary w-50 me-2">Add Member</button>
                        <button type="submit" name="delete" class="btn btn-danger w-50">Delete Member</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
