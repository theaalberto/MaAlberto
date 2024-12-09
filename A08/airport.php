<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PUP Airport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body>
    <div class="container mt-4 border border-primary rounded p-3">
      <h1 class="text-center mb-4">PUP Airport</h1>
      <div class="d-flex">
        <div class="d-flex flex-column p-3 bg-light border rounded w-25">
          <h4>Filters</h4>
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              Arrange By
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <li><a class="dropdown-item" href="#" id="sortByDeparture">Departure Date & Time</a></li>
              <li><a class="dropdown-item" href="#" id="sortByArrival">Arrival Date & Time</a></li>
            </ul>
          </div>
        </div>

        <div class="w-75 ms-3">
          <table class="table" id="flightsTable">
            <thead>
              <tr>
                <th scope="col">Flight Number</th>
                <th scope="col">Departure Airport</th>
                <th scope="col">Arrival Airport</th>
                <th scope="col">Departure Date & Time</th>
                <th scope="col">Arrival Date & Time</th>
                <th scope="col">Airline Name</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $servername = "localhost";
              $username = "root";
              $password = "";
              $dbname = "pupairport";
              $conn = new mysqli($servername, $username, $password, $dbname);
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }
              $sql = "SELECT flightNumber, departureAirportCode, arrivalAirportCode, departureDatetime, arrivalDatetime, airlineName 
                      FROM flightlogs";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>
                          <td>{$row['flightNumber']}</td>
                          <td>{$row['departureAirportCode']}</td>
                          <td>{$row['arrivalAirportCode']}</td>
                          <td>{$row['departureDatetime']}</td>
                          <td>{$row['arrivalDatetime']}</td>
                          <td>{$row['airlineName']}</td>
                        </tr>";
                }
              } else {
                echo "<tr><td colspan='6' class='text-center'>No data found</td></tr>";
              }
              $conn->close();
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
      function sortTableByDate(columnIndex) {
        const table = document.getElementById('flightsTable');
        const rows = Array.from(table.rows).slice(1);
        const sortedRows = rows.sort((a, b) => {
          const dateA = new Date(a.cells[columnIndex].textContent);
          const dateB = new Date(b.cells[columnIndex].textContent);
          return dateA - dateB;
        });
        const tbody = table.querySelector('tbody');
        tbody.innerHTML = '';
        sortedRows.forEach(row => tbody.appendChild(row));
      }

      document.getElementById('sortByDeparture').addEventListener('click', function() {
        sortTableByDate(3);
      });

      document.getElementById('sortByArrival').addEventListener('click', function() {
        sortTableByDate(4);
      });
    </script>
  </body>
</html>
