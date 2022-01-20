@extends('master')
@section('content')

{{-- Used to create the board. Uses the data attribute --}}
<table>
    <caption>LET'S GO!</caption>
    @for ($i = 0; $i< BOARD_SIZE; $i++) 
    <tr>
        @for ($j = 0; $j < BOARD_SIZE; $j++) 
        <td data-x="{{ $i }}" data-y="{{ $j }}" data-imgpath="{{PATH_PIC}}" id="{{ $i . $j }}"></td>
        @endfor
    </tr>
    @endfor
</table>

@endsection