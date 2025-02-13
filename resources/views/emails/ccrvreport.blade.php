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
            {{-- {{dd($cases[0]['name'],$caseCount['case_count'])}} --}}
            <div class="details">
                @if(count($cases)>0)
                <p><strong>Victim Name:</strong> {{ ucFirst($cases[0]['name'])}}</p>
                @endif
                <p><strong>Token ID:</strong> {{ $token }}</p>
                <p><strong>Verification Type:</strong>Criminal Background</p>
                
                    <p>
                        @if(is_array($caseCount) && isset($caseCount['case_count']))
                        <strong>Total Case:</strong> {{ $caseCount['case_count'] }}
                        @elseif(is_int($caseCount) && $caseCount != 0)
                        <strong>Total Case:</strong> {{ $caseCount }}
                        @else
                        Case Status: Cleared
                        @endif
                    </p>
                    {{-- @if(count($cases)>0){{ $caseCount['case_count'] }} @else 0 @endif</p> --}}
                <table border="1" cellpadding="10" cellspacing="0">
                    <thead>
                        <tr>
                            @php
                                $headers = [
                                    'Source', 'State Name','District Name','Court Name', 'Case Category', 
                                    'Under Acts', 'Under Sections','Case Status','Filing Date','Decision Date'
                                ];
                            @endphp
                    
                            @foreach ($headers as $header)
                                <th>{{ $header }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($cases)>0)
                        @foreach ($cases as $case)
                            <tr>
                                @php
                                    $fields = [
                                        'source', 'state_name','district_name','court_name', 'case_category','under_acts', 'under_sections','case_status','filing_date'
                                        ,'decision_date'
                                    ];
                                @endphp
                    
                                @foreach ($fields as $field)
                                    <td>{{ $case[$field] ?? '' }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="10"> No cases available (case_count is zero) </td>
                        </tr>
                        @endif
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
