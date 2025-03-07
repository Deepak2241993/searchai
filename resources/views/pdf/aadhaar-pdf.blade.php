<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aadhaar Details {{ $aadhaarData['reference_id'] }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            line-height: 1.6;
            padding: 0;
            margin: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            border-top: 8px solid black;
            border-bottom: 1px solid black;
            margin-bottom: 30px;
        }

        .logo img {
            height: 50px;
        }

        .company-details {
            text-align: right;
        }

        .company-details p {
            margin: 0;
            font-size: 14px;
        }

        .identity-check {
            display: flex;
            align-items: center;
            font-weight: bold;
            font-size: 16px;
            color: #000;
        }

        .identity-check::before,
        .identity-check::after {
            content: '';
            flex-grow: 1;
            height: 1px;
            background-color: #000;
            margin: 0 10px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .info-table th,
        .info-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .info-table th {
            background-color: #f2f2f2;
            width: 25%;
        }

        footer {
            font-size: 12px;
            text-align: center;
            border-top: 1px solid #eaeaea;
            padding: 10px 20px;
            background-color: #f9f9f9;
            margin-top: 30px;
        }

        .footer-disclaimer {
            text-align: justify;
            padding: 1.5rem;
        }
    </style>
</head>

<body>
    <div class="container">

        <!-- Header -->
        <div class="header">
            <div class="logo">
                <img src="{{ public_path('front-assets/images/logo.png') }}" alt="SearchAI Logo">
            </div>
            <div class="company-details">
                <p>Navigant Digital Pvt. Ltd.</p>
                <p>E44/3 Okhla Industrial Area,</p>
                <p>Phase 2 Near C Lal Chowk,</p>
                <p><strong>New Delhi 110020</strong></p>
            </div>
        </div>

        <!-- Client Info -->
        <section class="client-info">
            <div class="identity-check">BACKGROUND SCREENING REPORT</div>

            <table class="info-table">
                <tr>
                    <th>Client Name</th>
                    <td>{{ $client_data->name }}</td>
                </tr>
                <tr>
                    <th>Order ID</th>
                    <td>{{ $order_id }}</td>
                </tr>
                <tr>
                    <th>Mobile Number</th>
                    <td>--</td>
                </tr>
                <tr>
                    <th>Report Date</th>
                    <td>{{ date('d-m-Y', strtotime($createdData->updated_at)) }}</td>
                </tr>
            </table>
        </section>

        <!-- Aadhaar Report -->
        <section class="report-info">
            <div class="identity-check">IDENTITY CHECK : AADHAAR CARD</div>

            <table class="info-table">
                <tr>
                    <th>Aadhaar Number</th>
                    <td>{{ $createdData['aadhaar_number'] }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $aadhaarData['name'] }}</td>
                </tr>
                <tr>
                    <th>Date of Birth</th>
                    <td>{{ $aadhaarData['date_of_birth'] }}</td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>{{ $aadhaarData['gender'] }}</td>
                </tr>
                <tr>
                    <th>Father's Name</th>
                    <td>{{ $aadhaarData['care_of'] ?? 'null' }}</td>
                </tr>
                <tr>
                    <th>State</th>
                    <td>{{ $aadhaarData['state'] ?? 'null' }}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>
                        {{ $aadhaarData['house'] ?? 'null' }},
                        {{ $aadhaarData['street'] ?? 'null' }},
                        {{ $aadhaarData['district'] ?? 'null' }},
                        {{ $aadhaarData['sub_district'] ?? 'null' }},
                        {{ $aadhaarData['locality'] ?? 'null' }},
                        {{ $aadhaarData['post_office_name'] ?? 'null' }},
                        {{ $aadhaarData['state'] ?? 'null' }},
                        {{ $aadhaarData['country'] ?? 'null' }},
                        {{ $aadhaarData['vtc_name'] ?? 'null' }}
                    </td>
                </tr>
                <tr>
                    <th>Pin Code</th>
                    <td>{{ $aadhaarData['pincode'] ?? 'null' }}</td>
                </tr>
            </table>
        </section>

        <div style="page-break-before: always;"></div>

        <!-- Footer -->
        <footer>
            <div class="footer-disclaimer">
                <h4 style="text-align: center;"><strong><u>LEGAL DISCLAIMER</u></strong></h4>
                <p>
                    All rights reserved. The report and its contents are the property of SearchAPI (operated by Navigant Digital
                    Pvt. Ltd.) and may not be reproduced in any manner without express written permission. These reports are
                    confidential and intended for internal use only. No liability is assumed for any errors or omissions in the report.
                </p>
            </div>
            <p style="font-size: 16px;">SearchAPI Confidential</p>
        </footer>

    </div>

</body>

</html>
