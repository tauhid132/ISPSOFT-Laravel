<h3>Ticket ID: {{ $data->id }}</h3>
@if($data->user_id != null)
<h3>Username: {{ $data->user->username }}</h3>
<h3>Customer Name: {{ $data->user->customer_name }}</h3>
@endif
<h3>Ticket Type: {{ $data->type->ticket_type_name }}</h3>
<h3>Ticket Details: {{ $data->ticket_description }}</h3>
<h3>Priority Level: {{ $data->priority == 0 ? 'Low' : (($data->priority == 1) ? 'Medium' : 'High') }}</h3>
<h3>Asigned To: 
    @forelse ($data->assigned_executives as $executive)
        {{ $executive->name }},
    @empty
        No One Assigned
    @endforelse

</h3>
