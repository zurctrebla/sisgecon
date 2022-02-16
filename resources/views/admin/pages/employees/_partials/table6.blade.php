

@foreach ($dados as $key => $dado)
    @for ($i = 0; $i < $dado->count(); $i++)
        <tr>
            <td>
                <a href="" data-toggle="modal" data-target="#exampleModal{{ $dado[$i]->id }}">
                    {{ $dado[$i]->data_ocorrencia ?? '' }}
                </a>
            </td>

            @if ($i == 0)
                <td style="color:rgb(0, 167, 0);">{{ $dado[$i]->hora_ocorrencia ?? '' }}</td>
            @endif

            @if ($i == 1)
                <td style="color:#f00;">{{ $dado[$i]->hora_ocorrencia ?? '' }}</td>
            @endif

            @if ($i == 2)
            <td style="color:rgb(0, 167, 0);">{{ $dado[$i]->hora_ocorrencia ?? '' }}</td>
            @endif

            @if ($i == 3)
                <td style="color:#f00;">{{ $dado[$i]->hora_ocorrencia ?? '' }}</td>
            @endif

            @if ($i > 3)
                <td></td>
            @endif

        </tr>
    @endfor
@endforeach
