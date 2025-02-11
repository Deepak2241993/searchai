<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criminal Background Screening Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 200px;
        }
        .header h1 {
            color: #007bff;
            font-size: 24px;
            margin-top: 10px;
        }
        .content {
            color: #333333;
            line-height: 1.6;
        }
        .details p {
            margin: 8px 0;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777777;
        }
        .footer a {
            color: #007bff;
            text-decoration: none;
        }
        .btn {
            display: inline-block;
            background-color: #007bff;
            color: #ffff
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img src="{{url('/front-assets/images/logo.png')}}" alt="SearchAPI Logo">
            <h1>Criminal Background Screening Report</h1>
        </div>
        <div class="content">
            <p>Dear <strong>{{ ucFirst(Auth::user()->name) }}</strong>,</p>
            <p>Thank you for choosing <strong>SearchAPI</strong>! We are pleased to inform you that your Criminal Background Screening Report is complete, and the detailed report is now available.</p>
            
            <div class="details">
                <p><strong>Victim Name:</strong> {{ $caseData[0]['name'] }}</p>
                <p><strong>Token ID:</strong> {{ $token }}</p>
                <p><strong>Verification Type:</strong>Criminal Background</p>
                <p><strong>Total Case:</strong> {{ $totalCase }}</p>
                <table border="1" cellpadding="10" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Case Number</th>
                            <th>Case Category</th>
                            <th>Case Type</th>
                            <th>Case Status</th>
                            <th>Case Year</th>
                            <th>CNR</th>
                            <th>District Name</th>
                            <th>Filing Date</th>
                            <th>Filing Number</th>
                            <th>Filing Year</th>
                            <th>First Hearing Date</th>
                            <th>Decision Date</th>
                            <th>Court Name</th>
                            <th>Opposing Party</th>
                            <th>Police Station</th>
                            <th>Under Acts</th>
                            <th>Under Sections</th>
                            <th>Nature of Disposal</th>
                            <th>Name</th>
                            <th>Father Match Type</th>
                            <th>Name Match Type</th>
                            <th>Algorithm Risk</th>
                            <th>State Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($caseData as $value)
                        <tr>
                            <td>12345</td>
                            <td>Criminal</td>
                            <td>Theft</td>
                            <td>Closed</td>
                            <td>2023</td>
                            <td>CNR00123</td>
                            <td>New York</td>
                            <td>2023-05-15</td>
                            <td>FN001</td>
                            <td>2023</td>
                            <td>2023-06-01</td>
                            <td>2023-07-10</td>
                            <td>High Court</td>
                            <td>John Doe</td>
                            <td>Central Station</td>
                            <td>Act XYZ</td>
                            <td>Section 123</td>
                            <td>Disposed</td>
                            <td>Jane Doe</td>
                            <td>Partial Match</td>
                            <td>Exact Match</td>
                            <td>Medium</td>
                            <td>California</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                
            </div>

            <p>Please find your <strong>Criminal Background Screening Report</strong> attached to this email.</p>

            <p>If you have any questions regarding the report or require further assistance, please do not hesitate to reach out to us.</p>

            <p><a href="mailto:care@searchai.space" class="btn">Contact Support</a></p>

            <p>Thank you for trusting us with your verification needs. We look forward to serving you again!</p>
        </div>
        <div class="footer">
            <p>Best regards,</p>
            <p><strong>SearchAPI Support Team</strong></p>
            <p>Email: care@searchai.space | Website: <a href="https://searchai.space">searchai.space</a></p>
        </div>
    </div>
</body>
</html>
