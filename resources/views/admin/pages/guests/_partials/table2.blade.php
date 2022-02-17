

@foreach ($dados as $key => $dado)            
    <tr>
        <td>
            {{ date('d/m/Y', strtotime($key)) }}
        </td>
        @for ($i = 0; $i < $dado->count(); $i++)                    
            <td>
                <a href="" data-toggle="modal" data-target="#exampleModal{{ $dado[$i]->id }}">
                    {{ $dado[$i]->hour ?? '' }}
                </a>
            </td>
            
            @include('admin.pages.employees._partials.modal')
    
        @endfor    
    </tr>            
@endforeach