@extends('Layout.Search')

@section('content')



@section ('title') 
Wyszukiwanie
@endsection

    @if ($count == 0 )
        <div class="countSearch error">
            Ilość wyników  {{$count}}
        </div>
        <br>
        <div class='center'>
        <a href="javascript:history.back()"><button class="btn-mood mood" >WSTECZ</button></a>
        </div>   
    @else
        <div class="countSearch notError">
              Ilość wyników  {{$count}}
          </div>


        <br> 
        @for ($i=0;$i < count($percent);$i++)
            {{$percent[$i]["percent"]}} / 
        @endfor
        <br>
        @foreach ($arrayList as $list)
                {{$list->longMood}}
        @endforeach
        <div class='tableSearchMood'>
            <div class="titleSearchResult titleSearchResultMood">WYSZUKIWANIE</div>
            <table class='moodShow'>
                <thead class="titleTheadMood">
                <tr class="bold">
                    <td class="start showMood" style=" border-right-style: hidden;" >
                        Start
                    </td>
                    <td class="end showMood">
                        Koniec
                    </td>
                    <td class="sizeTableMood showMood">
                        Nastrój
                    </td>
                    <td class="sizeTableMood showMood">
                        Lęk
                    </td>
                    <td class="sizeTableMood showMood">
                        napięcie /<br>rozdrażnienie
                    </td>
                    <td class="sizeTableMood showMood">
                        Pobudzenie
                    </td>
                    <td class="center showMood" style="width: 17%;">
                        Ilośc wybudzeń /<br> Epizodów psychotycznych
                    </td>
                    
                </tr>
                </thead>
                @foreach ($arrayList as $list)
                <tr>
                    <td class="showMood start" colspan="2" style="width: 55%;">
                        <span class="left">{{date("H:i",strtotime($list->date_start) )}}</span>
                        <span class="right">{{date("H:i",strtotime($list->date_end) )}}</span>
                        <br>
                        <div class="cell{{\App\Http\Services\Common::setColor($list->level_mood)}} level" style="width: {{$percent[array_search($list->id,array_column($percent, 'id'))]["percent"]}}%">&nbsp;</div>
                        <div style="text-align: center; width: 70%;">
                        <span class="HourMood">{{\App\Http\Services\Common::calculateHour($list->date_start,$list->date_end)}}</span>
                        </div>
                    </td>
                    <td>
                        
                    </td>
                </tr>
                @endforeach
            </table>
        </div>

    
    @endif


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

@endsection