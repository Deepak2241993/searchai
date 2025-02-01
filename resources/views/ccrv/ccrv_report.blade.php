@extends('layouts.admin-master')

@section('title')
    CCRV
@endsection

@section('content')
{{dd($data['data']['ccrv_data']['cases'])}}
{{dd($data)}}

<h1 class="mb-4">CCRV Cases</h1>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Request ID</th>
            <th>Transaction ID</th>
            <th>Status</th>
            <th>Code</th>
            <th>Message</th>
            <th>CCRV Status</th>
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
            <th>Oparty</th>
            <th>Police Station</th>
            <th>Under Acts</th>
            <th>Under Sections</th>
            <th>Nature of Disposal</th>
            <th>Name</th>
            <th>Father Match Type</th>
            <th>Name Match Type</th>
            <th>Algorithm Risk</th>
            <th>State Name</th>
            <th>Address</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ccrvCases as $case)
        <tr>
            <td>{{ $case->algorithm_risk }}</td>
            <td>{{ $case->father_match_type }}</td>
            <td>{{ $case->name_match_type }}</td>
            <td>{{ $case->case_category }}</td>
            <td>{{ $case->case_number }}</td>
            <td>{{ $case->case_status }}</td>
            <td>{{ $case->case_type }}</td>
            <td>{{ $case->case_year }}</td>
            <td>{{ $case->cnr }}</td>
            <td>{{ $case->decision_date }}</td>
            <td>{{ $case->district_name }}</td>
            <td>{{ $case->filing_date }}</td>
            <td>{{ $case->filing_number }}</td>
            <td>{{ $case->filing_year }}</td>
            <td>{{ $case->first_hearing_date }}</td>
            <td>{{ $case->name }}</td>
            <td>{{ $case->nature_of_disposal }}</td>
            <td>{{ $case->oparty }}</td>
            <td>{{ $case->state_name }}</td>
            <td>{{ $case->under_acts }}</td>
            <td>{{ $case->under_sections }}</td>
            
            {{-- <td>{{ $case->case_decision_date }}</td> --}}

            <td>{{ $case->id }}</td>
            <td>{{ $case->request_id }}</td>
            <td>{{ $case->transaction_id }}</td>
            <td>{{ $case->status }}</td>
            <td>{{ $case->code }}</td>
            <td>{{ $case->message }}</td>
            <td>{{ $case->ccrv_status }}</td>
            <td>{{ $case->court_name }}</td>
            <td>{{ $case->police_station }}</td>
            <td>{{ $case->address }}</td>
            <td>{{ $case->created_at }}</td>
            <td>{{ $case->updated_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection