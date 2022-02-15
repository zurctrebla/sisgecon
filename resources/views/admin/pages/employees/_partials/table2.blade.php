




@foreach ($employee->points->chunk(4) as $chunk)    {{-- linha --}}
    <tr>
        @foreach ($chunk as $key => $point)     {{-- coluna --}}
            {{ date('d/m/Y', strtotime($point->register)) }}
        @endforeach
    </tr>
@endforeach


<table class="table table-bordered">
    <thead>
      <tr>

        @foreach ($collection as $item)

            <th scope="col">            colunas       </th>

        @endforeach

      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        @foreach ($collection as $item)

        <td>            linhas        </td>

        @endforeach
      </tr>
    </tbody>
  </table>
