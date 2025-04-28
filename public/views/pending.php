<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account Pending Approval</title>
    <meta http-equiv="refresh" content="7;url=/neeco2/home" />
    <style>
        body {
            background-color: #f9fafb;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }
        .container {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            position: relative;
            animation: fadeIn 1s ease-out;
        }
        h1 {
            color: #ff9800;
            margin-bottom: 10px;
        }
        p {
            color: #555;
            font-size: 18px;
            margin-bottom: 30px;
        }
        .btn {
            text-decoration: none;
            background-color: #ff9800;
            color: white;
            padding: 12px 24px;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s;
            display: inline-block;
        }
        .btn:hover {
            background-color: #e68900;
        }
        .note {
            margin-top: 20px;
            font-size: 14px;
            color: #888;
        }
        .spinner {
            margin: 20px auto;
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #ff9800;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            transition: opacity 1s ease;
        }
        .fade-out {
            opacity: 0;
        }
        .loading-text {
            margin-top: 10px;
            font-size: 16px;
            color: #777;
            height: 24px;
            overflow: hidden;
            animation: blink 1s steps(2, start) infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg);}
            100% { transform: rotate(360deg);}
        }
        @keyframes blink {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(-20px);}
            100% { opacity: 1; transform: translateY(0);}
        }
    </style>
    <script>
        // Fade out spinner and loading text before redirect
        setTimeout(function() {
            var spinner = document.querySelector('.spinner');
            var loadingText = document.querySelector('.loading-text');
            if (spinner) spinner.classList.add('fade-out');
            if (loadingText) loadingText.classList.add('fade-out');
        }, 5000); // Fade out 2 seconds before redirect
    </script>
</head>
<body>

<div class="container">
    <h1>Your account is pending approval</h1>
    <p>Thank you for registering!<br>
    Your account is currently under review.<br>
    Please wait for an administrator to approve your account.</p>

    <div class="spinner"></div>
    <div class="loading-text">Loading...</div>

    <a href="/neeco2/home" class="btn">Return to Home</a>
    <div class="note">(You will be redirected automatically in 7 seconds.)</div>
</div>

</body>
</html>
