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
                <p class="text-wrap mt-4 p-4">All rights reserved. The report and its contents are the property of
                    SearchAPI (operated by Navigant Digital
                    Pvt. Ltd.) and may not be reproduced in any manner without the express written permission of
                    SearchAPI.<br>
                    The reports and information contained herein are confidential and are meant only for the
                    internal use of
                    the SearchAPI client for assessing the background of their applicant. The information and report
                    are
                    subject to change based on changes in factual information.<br>
                    Information and reports, including text, graphics, links, or other items, are provided on an "as
                    is," "as
                    available" basis. SearchAPI expressly disclaims liability for errors or omissions in the report,
                    information, and
                    materials, as the information is obtained from various sources as per industry practice. No
                    warranty of any
                    kind implied, express, or statutory including but not limited to the warranties of
                    non-infringement of third
                    party rights, title, merchantability, fitness for a particular purpose, and freedom from
                    computer viruses, is
                    given in conjunction with the information and materials.<br>
                    Our findings are based on the information available to us and industry practice; therefore, we
                    cannot
                    guarantee the accuracy of the information collected. Should additional information or
                    documentation
                    become available that impacts our conclusions, we reserve the right to amend our findings
                    accordingly.<br>
                    These reports are not intended for publication or circulation. They should not be shared with
                    any other
                    person, including the applicant, nor reproduced for any other purpose, in whole or in part,
                    without prior
                    written consent from SearchAPI in each specific instance. Our reports cannot be relied upon by
                    any other
                    person, and we expressly disclaim all responsibility or liability for any costs, damages,
                    losses, or expenses
                    incurred by anyone as a result of the circulation, publication, reproduction, or use of our
                    reports contrary to
                    the provisions of this paragraph.<br>
                    The report and information consist of statements of opinion and not statements of fact or
                    recommendations. You should obtain any additional information necessary to make an informed
                    decision
                    prior to using the report. SearchAPI and its directors, officers, agents, and representatives
                    assume (and
                    hereby disclaim) all responsibility or liability that may arise directly or indirectly from the
                    usage of such
                    reports.<br>
                    Due to the limitations mentioned above, the result of our work with respect to background checks
                    should
                    be considered only as a guideline. Our reports and comments should not be considered a
                    definitive
                    pronouncement on the individual.</p>
            </div>
            <p style="font-size: 16px;">SearchAPI Confidential</p>
            <br class="mb-4">
        </footer>

    </div>

</body>

</html>
