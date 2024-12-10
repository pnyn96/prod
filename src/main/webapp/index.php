<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<body background="images/2.png" style="background-repeat:no-repeat; background-size: 100% 100%">
<br><br><br><br>
<div class="container">
  <div class="jumbotron vertical-center">
    <table class="grid" cellspacing="0">
      <tr>
        <td colspan="4" style="text-align:center;">
          <form method="post">
            <div class="form-group">
              <label for="firstname">Name:</label>
              <input type="text" class="form-control" name="firstname" required>
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" name="email" required>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
          </form>
        </td>
      </tr>
    </table>
  </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form input values
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];

    // PostgreSQL connection details
    $servername = "database-1.c9kqysegcu97.us-east-1.rds.amazonaws.com";
    $username = "postgres";
    $password = "root12345";
    $dbname = "yashudb";
    $port = "5432"; // Default PostgreSQL port

    try {
        // Create a PDO connection
        $dsn = "pgsql:host=$servername;port=$port;dbname=$dbname;";
        $conn = new PDO($dsn, $username, $password);

        // Set error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert query
        $sql = "INSERT INTO data (firstname, email) VALUES (:firstname, :email)";
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':email', $email);

        // Execute query
        $stmt->execute();

        echo "<div class='alert alert-success'>New record created successfully</div>";
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    }

    // Close the connection
    $conn = null;
}
?>
</body>
</html>
