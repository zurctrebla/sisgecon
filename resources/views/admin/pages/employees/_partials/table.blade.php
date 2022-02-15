


@foreach ($employee->points->chunk(4) as $chunk)

    <tr>
        @foreach ($chunk as $key => $point)

        <td>
            index {{ $loop->index }}
            count {{ $loop->count }}
            {{ date('d/m/Y H:i:s', strtotime($point->register)) }}
        </td>

        @endforeach
    </tr>

    {{-- @foreach ($users as $user)
        @continue($user->type == 1)

        <li>{{ $user->name }}</li>

        @break($user->number == 5)
    @endforeach --}}

@endforeach
