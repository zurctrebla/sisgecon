




@foreach ($user->points->chunk(4) as $chunk)    {{-- linha --}}
    <tr>
        @foreach ($chunk as $key => $point)     {{-- coluna --}}

        @endforeach
    </tr>
@endforeach
