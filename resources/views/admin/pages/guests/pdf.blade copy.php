<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Visitante <strong>{{$guest->name}}</strong></title>
</head>
<style>
    @page {
        margin-top: 30px;
        margin-left: 30px;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: "Open Sans", sans-serif;
    }


    .titulo {
        font-size: 22px;
        margin-bottom: 10px;
    }

    .subtitulo {
        font-size: 12px;
        margin-bottom: 10px;

    }

    .header {
        width: 100%;
        height: 140px;
    }

    .esquerdo {
        width: 20%;
        /* height: 150px; */
        float: left;
    }

    .borda {
        height: 120px;
        border-left: 1px solid rgb(241, 241, 241);
        float: left;
        margin-top: 0px;
    }

    .direito {
        width: 80%;
        /* height: 150px; */
        float: left;
        margin-left: 20px;
        padding-left: 10px;
        padding-top: 8px;
        vertical-align: middle;
    }

    .meio {
        border-top: 1px solid rgb(241, 241, 241);
        background-color: rgb(248, 248, 248);
        height: 130px;
    }

    .paciente {
        margin-top: 20px;
        font-family: "Open Sans", sans-serif;
        font-size: 14px;
        padding-left: 20px;
        padding-right: 20px;
    }

    .paciente_esquerdo {
        width: 60%;
        /* height: 150px; */
        float: left;
    }

    .paciente_direito {
        width: 40%;
        /* height: 150px; */
        float: right;
        text-align: right;
        vertical-align: middle;
    }

    .texto {
        font-family: "Open Sans", sans-serif;
        font-size: 10px;
        padding-left: 50px;
        padding-right: 50px;
        margin-top: 30px;
    }

    b {
        color: rgb(23, 79, 151);
        margin-bottom: 8px;
    }

    .titulo_texto {
        font-size: 22px;
        color: rgb(23, 79, 151);
        margin-bottom: 30px;
    }

    .linha {
        margin-bottom: 5px;
    }

    .assinatura {
        margin-top: 150px;
        font-family: "Open Sans", sans-serif;
        font-size: 10px;
        text-align: center;
    }

</style>

<body>
    <h3>Histórico de Acesso Visitante <strong>{{$guest->name}}</strong></h3>
    <table>
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
    <h3>Histórico</h3>
    <hr>
    <table>
        <thead>
          <tr>
            <th>data</th>
            <th>Entrada</th>
            <th>Saida</th>
            <th>Entrada</th>
            <th>Saida</th>
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



