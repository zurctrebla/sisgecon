
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
        </tr>
@endforeach
