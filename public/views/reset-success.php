<!-- views/reset-success.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reset Successful</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f2f2f2;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .container {
      background: white;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      text-align: center;
      max-width: 400px;
    }
    a {
      display: inline-block;
      margin-top: 1rem;
      color: white;
      background-color: #4CAF50;
      padding: 0.75rem 1rem;
      border-radius: 4px;
      text-decoration: none;
    }
    a:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Password Reset Successful</h2>
    <p>You can now log in using your new password.</p>
    <a href="/neeco2/login">Go to Login</a>
  </div>
</body>
</html>
