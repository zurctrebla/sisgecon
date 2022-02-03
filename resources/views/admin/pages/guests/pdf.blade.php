<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Visitante <strong>{{$guest->name}}</strong></title>


</head>
<body>
    <h3>Histórico de Acesso Visitante <strong>{{$guest->name}}</strong></h3>
    <table border="1">
        <thead>
            <tr>
                <th>Visitante</th>
                <th>Liberado por</th>
                <th>Documento</th>
                <th>Autorização</th>
                <th>Setor</th>
                <th>Data de Entrada</th>
                <th>Data de Saída</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $guest->name }}</td>
                <td>{{ $guest->authorized_at }}</td>
                <td>
                    @foreach ($guest->documents as $document)

                        {{ $document->doc_no }}<br>

                    @endforeach
                </td>
                <td>{{ $guest->authorization }}</td>
                <td>{{ $guest->sector->name }}</td>
                <td>{{ date('d/m/Y', strtotime($guest->start_at) )}}</td>
                <td>{{ date('d/m/Y', strtotime($guest->expires_at) )}}</td>
                <td>{{ $guest->status }}</td>
            </tr>
        </tbody>
    </table>
    <h3>Histórico de Acesso Visitante <strong>{{$guest->name}}</strong></h3>
    <table border="1">
        <thead>
          <tr>
            <th scope="col">data</th>
            <th scope="col">Entrada</th>
            <th scope="col">Saida</th>
            <th scope="col">Entrada</th>
            <th scope="col">Saida</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($guest->points->chunk(4) as $chunk)
                <tr>
                    @foreach ($chunk as $point)

                    @if ($loop->first)
                        <td>
                            <strong>
                                {{ date('d/m/Y', strtotime($point->register)) }}
                            </strong>
                        </td>
                    @endif

                        <td>{{ date('H:i:s', strtotime($point->register)) }}</td>

                    @endforeach

                    @if ($guest->points->count() == 3 )

                        <td></td>

                    @elseif ($guest->points->count() == 2 )

                        <td></td>
                        <td></td>

                    @elseif ($guest->points->count() == 1 )

                        <td></td>
                        <td></td>
                        <td></td>

                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>



