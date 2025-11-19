<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Correo</th>
            <th>Edad</th>
            <th>Género</th>
            <th>Progreso</th>
            <th>Número de compras</th>
            <th>Recognitions programmm</th>
        </tr>
    </thead>
    <tbody>
    @foreach($clients as $client)
        <tr>
            <td>{{  $client->name }}</td>
            <td>{{  $client->last_name }}</td>
            <td>{{  $client->second_last_name }}</td>
            <td>{{  $client->email }}</td>
            <td>{{  $client->age }}</td>
            <td>{{  $client->gender->name }}</td>
            <td>{{  $client->progress }}</td>
            <td>{{  $client->paymentsCount }}</td>
            <td>
            @foreach($client->client_phase as $clientPhase)
            {{  $clientPhase->phase->name." " }}
            @endforeach
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
