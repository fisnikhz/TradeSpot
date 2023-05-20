<!DOCTYPE html>
<html>
  <head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </head>
  <body>
    <div class="navbar">
        <h2 style="margin-left:10px; color:white; font-size:28px;">DASHBOARD</h2>
      <a href="#">Home</a>
      <div class="dropdown">
        <a href="#">Users</a>
        <div class="dropdown-content">
          <a href="add-user.php">Add User</a>
          <a href="view-users.php">Delete User</a>
        </div>
      </div>
      <a href = "logout.php">Sign Out</a>
    </div>
    <div class="content">
      <h1>Kategorite e produkteve</h1>
    <canvas id="categoryChart"width="300" height="100">></canvas>

<script>
  // Fetch the product data from your PHP script
  fetch('productData.php')
    .then(response => response.json())
    .then(data => {
      // Extract category names and counts
      const categories = [...new Set(data.map(product => product.pcategory))];
      const counts = categories.map(category => {
        return data.filter(product => product.pcategory === category).length;
      });

      // Set up the chart configuration
      const ctx = document.getElementById('categoryChart').getContext('2d');
      const chart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: categories,
          datasets: [{
            label: 'Product Count',
            data: counts,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
          }]
        },
        options: {
          // Customize chart options here
        }
      });
    });
</script>
<h1>Perdoruesit me me se shumti produkte
<canvas id="userChart" width="300" height="100"></canvas>
<script>
    // Fetch the user data from your PHP script
    fetch('userData.php')
      .then(response => response.json())
      .then(data => {
        // Extract user names and product counts
        const users = [...new Set(data.map(user => user.user_id))];
        const productCounts = users.map(user => {
          return data.filter(product => product.user_id === user).length;
        });

        // Set up the chart configuration
        const ctx = document.getElementById('userChart').getContext('2d');
        const chart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: users,
            datasets: [{
              label: 'Number of Posted Products',
              data: productCounts,
              backgroundColor: 'rgba(255, 99, 132, 0.2)', 
              borderColor: 'rgba(255, 99, 132, 1)', 
              borderWidth: 1
            }]
          },
          options: {
            // Customize chart options here
          }
        });
      });
  </script>

    </div>
  </body>
</html>
