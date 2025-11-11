<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Error - LAPOS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f6fa 0%, #e8ecef 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .error-container {
            background: white;
            border-radius: 16px;
            padding: 60px 40px;
            text-align: center;
            max-width: 500px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }
        
        .error-code {
            font-size: 72px;
            font-weight: 700;
            color: #e74c3c;
            margin-bottom: 20px;
        }
        
        h1 {
            font-size: 24px;
            color: #2c3e50;
            margin-bottom: 15px;
        }
        
        p {
            color: #7f8c8d;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        
        .btn {
            display: inline-block;
            background: #16a085;
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn:hover {
            background: #138d75;
            transform: translateY(-2px);
        }
        
        .support-info {
            margin-top: 30px;
            padding-top: 30px;
            border-top: 1px solid #ecf0f1;
            color: #95a5a6;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">500</div>
        <h1>System Error</h1>
        <p>We're experiencing technical difficulties. Our team has been notified and is working to resolve the issue.</p>
        
        <a href="{{ route('home') }}" class="btn">Return to Homepage</a>
        
        <div class="support-info">
            If this problem persists, please contact support at:<br>
            <strong>support@e.bitzy.id</strong>
        </div>
    </div>
</body>
</html>
