<?php
// Database connection
require_once('../database/config.php');

// Check connection
if (!$conn || $conn->connect_error) {
    die("Database connection failed. Please try again later.");
}

// Fetch missing persons from the database
$sql = "SELECT * FROM MissingPersons ORDER BY reported_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Missing Persons List</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    .background {
      background-image: url('bgidn.jpg'); 
      background-size: cover;
      background-position: center;
    }
  </style>
</head>
<body class="background bg-gray-100">
  <!-- Header -->
  <header class="bg-black text-white p-4 fixed top-0 left-0 right-0 shadow-md z-50">
    <div class="flex items-center justify-between max-w-screen-xl mx-auto">
      <div class="flex items-center space-x-2">
        <img src="logo_brahma.png" alt="Logo" class="h-10">
        <span class="text-xl font-bold">Brahma</span>
      </div>
      <nav>
        <a href="index.php" class="text-white hover:text-gray-300 mx-2">Home</a>
        <a href="donation2.html" class="text-white hover:text-gray-300 mx-2">Donation</a>
        <a href="missing_person.php" class="text-white hover:text-gray-300 mx-2">Missing Persons</a>
        <a href="index.html#login" class="text-white hover:text-gray-300 mx-2">Login</a>
      </nav>
    </div>
  </header>

  <!-- Main Content -->
  <main class="pt-20 min-h-screen flex flex-col items-center p-8">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl">
      <h2 class="text-3xl font-bold text-center mb-6">Missing Persons List</h2>
      
      <?php if ($result->num_rows > 0): ?>
        <div class="space-y-6">
          <?php while ($row = $result->fetch_assoc()): ?>
            <div class="bg-gray-100 p-4 rounded-lg shadow-md">
              <div class="flex items-center mb-4">
                <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="Missing Person Image" class="w-24 h-24 object-cover rounded-full mr-4">
                <div>
                  <h3 class="text-xl font-semibold"><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></h3>
                  <p class="text-gray-700">Age: <?php echo htmlspecialchars($row['age']); ?></p>
                  <p class="text-gray-700">Date of Birth: <?php echo htmlspecialchars($row['dob']); ?></p>
                  <p class="text-gray-700">Gender: <?php echo htmlspecialchars($row['gender']); ?></p>
                  <p class="text-gray-700">Government ID: <?php echo htmlspecialchars($row['government_id']); ?></p>
                </div>
              </div>
              <p class="text-gray-700 mb-4"><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
              <p class="text-gray-500 text-sm">Reported At: <?php echo date('F j, Y, g:i a', strtotime($row['reported_at'])); ?></p>
            </div>
          <?php endwhile; ?>
        </div>
      <?php else: ?>
        <p class="text-center text-gray-700">No missing persons reported yet.</p>
      <?php endif; ?>

      <div class="mt-8 text-center">
        <a href="index.php" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-600 focus:outline-none">Back to Home</a>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-black text-white py-4 mt-auto">
    <div class="max-w-screen-xl mx-auto text-center">
      <p>&copy; 2024 Brahma. All rights reserved.</p>
    </div>
  </footer>
</body>
</html>

<?php
$conn->close();
?>
