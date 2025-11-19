<table>
    <thead>
    <tr>
        <th>Nombre de la Escuela</th>
        <th>Nombre</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Correo</th>
        <th>Maestro</th>
        <th>Nivel Escolar</th>
        <th>Edad</th>
        <th>Progreso</th>
    </tr>
    </thead>
    <tbody>
    @foreach($clients as $client)
        <tr>
            <td>{{  $client->institution->name }}</td>
            <td>{{  $client->name }}</td>
            <td>{{  $client->last_name }}</td>
            <td>{{  $client->second_last_name }}</td>
            <td>{{  $client->email }}</td>
            <td>{{  $client->teacher === true ? 'SI' : 'NO' }}</td>
            <td>{{  $client->educational_level->name }}</td>
            <td>{{  $client->age }}</td>
            <td>{{  $client->progress }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
