@if (4 == $employee->points->count() >=2 )

    {{$employee->points->count()}}

@else

@endif

@foreach ($employee->points->chunk(4) as $chunk)
    @php
        $item1 = $item2 = $item3 = $item4 = $total = $hours = $minutes = 0;
    @endphp
    <tr>
        @foreach ($chunk as $key => $point)
            @if ($loop->first)
                <td>
                    <strong>
                        {{ date('d/m/Y', strtotime($point->register)) }}
                    </strong>
                </td>
            @endif
            <td>
                {{ date('d/m/Y H:i:s', strtotime($point->register)) }}
            </td>
            @if ($loop->remaining  == 3)
                @php
                    $item1 = $point->register;
                @endphp
            @endif
            @if ($loop->remaining  == 2)
                @php
                    $item2 = $point->register;
                @endphp
            @endif
            @if ($loop->remaining == 1)
                @php
                    $item3 = $point->register;
                @endphp
            @endif
            @if (($loop->remaining == 0))
                @php
                    $item4 = $point->register;
                @endphp
            @endif
            @if ($loop->last)
                @if ($loop->count == 1)
                    <td></td>
                    <td></td>
                    <td></td>
                @endif
                @if ($loop->count == 2)
                    <td></td>
                    <td></td>
                @endif
                @if ($loop->count == 3)
                    <td></td>
                @endif
            @endif
        @endforeach
    </tr>
@endforeach
