@foreach ($employee->sheets as $sheet)
    <td>
        <strong>
            {{ date('d/m/Y', strtotime($sheet->date)) }}
        </strong>
    </td>
    <td>
        {{ date('H:i:s', strtotime($sheet->register_1)) }}
    </td>
    <td>
        {{ date('H:i:s', strtotime($sheet->register_2)) }}
    </td>
    <td>
        {{ date('H:i:s', strtotime($sheet->register_3)) }}
    </td>
    <td>
        {{ date('H:i:s', strtotime($sheet->register_4)) }}
    </td>
    <td>
        {{ date('H:i:s', strtotime($sheet->sum)) }}
    </td>
@endforeach
