
@foreach ($dados as $key => $dado)
    <th colspan="4" style="color:rgb(0, 110, 255);">{{ date('d/m/Y',strtotime($key)) }}</th>
        <tr>
            @for ($i = 0; $i < $dado->count(); $i++)
                <tr>
                    <td></td>
                    <td>
                        <a href="" data-toggle="modal" data-target="#exampleModal{{ $dado[$i]->id }}">
                            {{ $dado[$i]->hour ?? '' }}
                        </a>
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
                @include('admin.pages.employees._partials.modal')
            @endfor

                @if ( ($dado[2] ?? '') && ($dado[3] ?? ''))
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

                    <td></td>
                    <td>
                        {{ date('H:i:s', $temp) }}
                    </td>
                    <td style="color:rgb(0,0,255);">HORAS</td>

                @elseif ( ($dado[0] ?? '') && ($dado[1] ?? ''))

                    <td></td>
                    <td>
                        {{ date_diff(date_create($dado[0]->hour), date_create($dado[1]->hour))->format("%H:%I:%S")  }}
                    </td>
                    <td style="color:rgb(0,0,255);">HORAS</td>

                @endif

        </tr>
@endforeach
