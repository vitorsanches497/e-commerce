<div>

<table border="1">

<thead>
<tr>
<th>ID</th>
<th>Nome</th>
<th>Telefone</th>
<th>Ações</th>
</tr>
</thead>

<tbody>

@foreach($devices as $device)

<tr>
<td>{{ $device->id }}</td>
<td>{{ $device->name }}</td>
<td>{{ $device->phone }}</td>

<td>
<a href="{{ route('device.form', $device->id) }}">
Editar
</a>
</td>

</tr>

@endforeach

</tbody>

</table>

</div>