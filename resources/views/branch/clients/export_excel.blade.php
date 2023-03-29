


<table>
    <thead>
    <tr>
        <th>SN.</th>
        <th>Name</th>
        <th>Email</th>
        <th>Pin Code</th>
        <th>Phone 1</th>
        <th>Phone 2</th>
        <th>City</th>
        <th>Address</th>
    </tr>
    </thead>
    <tbody>
    @foreach($branchClients as $key => $data)
        <tr>
            <td>{{ ++$key }}</td>
            <td>{{ $data->name }}</td>
            <td>
                {{ $data->email }}
            </td>
            <td>
                {{ $data->pincode }}
            </td>
            <td>
                {{ $data->phone1 }}
            </td> 
            <td>{{ $data->phone1 }}</td>
            <td>{{ $data->city }}</td>
            <td>{{ $data->address }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
