<style>
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
      font-size: 14px;
      text-align: center;
    }
    </style>
<table style="width:100%">
    <tr>
        <th>No</th>
        <th>Area</th>
        <th>Username</th>
        <th>Customer Name</th>
        <th>Address</th>
        <th>Mobile</th>
        <th>Monthly Bill</th>
        <th>Due</th>
    </tr>
    @foreach ($bills as $bill)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $bill->user->service_area->area_name }}</td>
            <td>{{ $bill->user->username }}</td>
            <td>{{ $bill->user->customer_name }}</td>
            <td>{{ $bill->user->billing_address }}</td>
            <td>{{ $bill->user->mobile_no }}</td>
            <td>{{ $bill->monthly_bill }}</td>
            <td>{{ $bill->due_bill }}</td>
        </tr>
    @endforeach
</table>