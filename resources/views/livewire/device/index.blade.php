<div class="devices-wrapper">
    <table class="devices-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($devices as $device)
            <tr>
                <td class="id-cell">{{ $device->id }}</td>
                <td>{{ $device->name }}</td>
                <td>{{ $device->phone }}</td>
                <td>
                    <a href="{{ route('device.form', $device->id) }}" class="btn-edit">
                        ✏️ Editar
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>