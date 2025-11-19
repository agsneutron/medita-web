<table>
    <thead>
    <tr>
        <th>Nombre de la Escuela</th>
        <th>Nombre</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Correo</th>
        <th>Nivel Escolar</th>
        @for ($i = 1; $i <=$totalQuestions; $i++)
            <th>Respuest Q{{$i}}</th>
        @endfor
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
            <td>{{  $client->educational_level->name }}</td>
            @for ($i = 0; $i <$totalQuestions; $i++)
                <td>{{  isset($client->client_question[$i]) ? $client->client_question[$i]->answer->name : 'Sin Respuesta' }}</td>
            @endfor
        </tr>
    @endforeach
    </tbody>
</table>
