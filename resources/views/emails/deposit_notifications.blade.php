<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Deposit Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            background: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin: auto;
        }
        .header {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            color: #333;
        }
        .content {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
            margin-top: 10px;
        }
        .table-container {
            width: 100%;
            margin-top: 20px;
        }
        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }
        .table-container th, .table-container td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="header">Deposit Confirmation</div>
    <div class="content">
        <p>Dear {{ $name }},</p>
        <p>We have received your deposit request. Below are the transaction details:</p>
    </div>
    <div class="table-container">
        <table>
            <tr>
                <th>Deposit Type</th>
                <td>{{ $depositType }}</td>
            </tr>
            <tr>
                <th>Amount</th>
                <td>${{ $amount }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $status }}</td>
            </tr>
            <tr>
                <th>Date</th>
                <td>{{ $created_at }}</td>
            </tr>
        </table>
    </div>
    <div class="content">
        <p>If you have any questions, please contact our support team</a>.</p>
        <p>Thank you for choosing {{ env('APP_NAME') }}.</p>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} {{ env('APP_NAME') }}. All rights reserved.
    </div>
</div>
</body>
</html>
