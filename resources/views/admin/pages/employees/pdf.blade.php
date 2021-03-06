<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Funcionário <strong>{{ $employee->name ?? '' }}</strong></title>
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
        height: 100px;
    }

    .esquerdo {
        width: 50%;
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
        width: 50%;
        /* height: 150px; */
        float: left;
        margin-left: 20px;
        padding-left: 10px;
        padding-top: 8px;
        vertical-align: middle;
    }

    /* .meio {
        border-top: 1px solid rgb(241, 241, 241);
        background-color: rgb(248, 248, 248);
        height: 130px;
    } */

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

    table,
    td,
    th {
        border: 1px solid #ddd;
        text-align: left;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        padding: 15px;
    }

</style>

<body>
    <div hidden class="header">
        <div class="esquerdo">
            <div class="linha">
                <b>Funcionário:</b> {{ $employee->name ?? '' }}
            </div>
            <div class="linha">
                <b>Documento:</b> {{ $employee->document->doc_no ?? '' }}
            </div>
        </div>
        <div class="borda"></div>
        <div class="direito">
            <div class="linha">
                <b>Setor:</b> {{ $employee->employee->sector->name ?? '' }}
            </div>
            <div class="linha">
                <b>Função:</b> {{ $employee->employee->function ?? '' }}
            </div>
        </div>
    </div>
    <table>
        <tr>
            <th style="width:120px;">Data</th>
            <th style="width:120px; text-align:center;">Horário</th>
            <th style="width:120px; text-align:center;">Status</th>
            <th scope="col">Motivo</th>
        </tr>

        @foreach ($dados as $key => $dado)
            <tr>
                <th colspan="4" style="color:rgb(0, 110, 255);">{{ date('d/m/Y', strtotime($key)) }}</th>
            </tr>
            @for ($i = 0; $i < $dado->count(); $i++)
                <tr>
                    <td></td>
                    <td>
                        {{ $dado[$i]->hour ?? '' }}
                    </td>
                    @if ($i == 0)
                        <td style="color:rgb(0, 167, 0);">ENTRADA</td>
                    @endif
                    @if ($i == 1)
                        <td style="color:#f00;">SAÍDA</td>
                    @endif
                    @if ($i == 2)
                        <td style="color:rgb(0, 167, 0);">ENTRADA</td>
                    @endif
                    @if ($i == 3)
                        <td style="color:#f00;">SAÍDA</td>
                    @endif
                    @if ($i > 3)
                        <td></td>
                    @endif
                    <td>
                        {{ $dado[$i]->reason ?? '' }}
                    </td>
                </tr>
            @endfor

                @if (($dado[2] ?? '') && ($dado[3] ?? ''))
                    @php
                        $date_1t = date_diff(date_create($dado[0]->hour), date_create($dado[1]->hour))->format("%H:%I:%S") ;
                        $date_2t = date_diff(date_create($dado[2]->hour), date_create($dado[3]->hour))->format("%H:%I:%S") ;

                        $h =  strtotime($date_1t);
                        $h2 = strtotime($date_2t);

                        $minutos = date("i", $h2);
                        $segundos = date("s", $h2);
                        $hora = date("H", $h2);

                        $temp = strtotime("+$minutos minutes", $h);
                        $temp = strtotime("+$segundos seconds", $temp);
                        $temp = strtotime("+$hora hours", $temp);

                    @endphp

                    <tr>
                        <td></td>
                    <td>
                        {{ date('H:i:s', $temp) }}
                    </td>
                    <td style="color:rgb(0,0,255);">HORAS</td>
                    </tr>

                @elseif ( ($dado[0] ?? '') && ($dado[1] ?? ''))

                    <tr>
                        <td></td>
                    <td>
                        {{ date_diff(date_create($dado[0]->hour), date_create($dado[1]->hour))->format("%H:%I:%S")  }}
                    </td>
                    <td style="color:rgb(0,0,255);">HORAS</td>
                    </tr>

                @endif

            </tr>
        @endforeach


    </table>
    <div hidden class="meio" style="clear:both;">
        <div class="paciente">

        </div>
    </div>
    <div class="texto" style="clear:both;">
        <div class="titulo_texto" style="text-align: center">
            <b> </b>
        </div>
    </div>


</body>

</html>
