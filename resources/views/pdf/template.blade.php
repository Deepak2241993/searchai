<!DOCTYPE html>
<html>

<head>
    <title>Search Ai || User Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <h1>Details for Order ID: {{ $token->id }}</h1>
    <p><strong>Token:</strong> {{ $token->token }}</p>
    <p><strong>Service Type:</strong> {{ $token->service_type }}</p>

    <h2>Aadhaar Data</h2>
    <table>
        <tr>
            <th>Field</th>
            <th>Value</th>
        </tr>
        @php
        $aadhaarData = $token->aadhaarData;

        // Combine address-related fields into a single formatted address
        $addressFields = [
        'house', 'street', 'vtc_name', 'sub_district', 'district',
        'post_office_name', 'state', 'pincode', 'country'
        ];

        // Create formatted address by combining the relevant fields
        $address = collect($addressFields)->map(function ($field) use ($aadhaarData) {
        return $aadhaarData[$field] ?? null;
        })->filter()->implode(', ');

        // Add the formatted address as a new field
        $aadhaarData['address'] = $address;

        // Remove individual address fields so only the formatted address is shown
        foreach ($addressFields as $field) {
        unset($aadhaarData[$field]);
        }
        @endphp
        @foreach ($aadhaarData as $key => $value)
        <tr>
            <td>{{ ucwords(str_replace('_', ' ', $key)) }}</td>
            <td>{{ $value ?? 'N/A' }}</td>
        </tr>
        @endforeach
    </table>
</body>

</html>