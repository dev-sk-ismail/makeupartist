<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .container {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .header {
            text-align: center;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            background-color: #3490dc;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 20px 0;
        }

        .footer {
            margin-top: 30px;
            font-size: 0.8em;
            color: #777;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Password Reset Request</h2>
        </div>

        <p>Hello,</p>
        <p>We received a request to reset your password. Please click the button below to set a new password:</p>

        <div style="text-align: center;">
            <a href="<?= $resetLink ?>" class="btn">Reset Password</a>
        </div>

        <p>If you did not request a password reset, you can safely ignore this email and your password will remain unchanged.</p>

        <p>This link will expire in 30 minutes for security reasons.</p>

        <div class="footer">
            <p>&copy; <?= date('Y') ?> Makeup Artist Hena. All rights reserved.</p>
        </div>
    </div>
</body>

</html>