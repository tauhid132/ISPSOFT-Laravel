<table class="table align-middle table-nowrap mb-0">
    <thead class="table-primary">
        <tr>
            <th scope="col">Month</th>
            <th scope="col">Year</th>
            <th scope="col">M.Bill</th>
            <th scope="col">Due Bill</th>
            <th scope="col">Paid Monthly</th>
            <th scope="col">Paid Due</th>
            <th scope="col">Payment Date</th>
            <th scope="col">Method</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bills as $bill )
        <tr>
            <td>{{ $bill->billing_month }}</td>
            <td>{{ $bill->billing_year }}</td>
            <td>{{ $bill->monthly_bill }}</td>
            <td>{{ $bill->due_bill }}</td>
            <td>{{ $bill->paid_monthly_bill }}</td>
            <td>{{ $bill->paid_due_bill }}</td>
            <td>{{ $bill->payment_date }}</td>
            <td>{{ $bill->payment_method }}</td>
        </tr>   
        @endforeach
    </tbody>
</table>