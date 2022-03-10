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
      
        <div class='tableSearchMood' id="ajaxData">
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
                    <td class="center showMood" style="width: 35%;">
                        Epizodów psychotycznych
                    </td>
                    
                </tr>
                </thead>
                @for ($i=0;$i < count($arrayList);$i++)
                
                @if ($i == 0 or $arrayList[$i]->datEnd != $arrayList[$i-1]->datEnd)
                <tr>
                    <td colspan="7" style="padding: 10px; padding-top: 30px;">
                        <div class="dayMood">
                             Dzień  {{$arrayList[$i]->datEnd}}
                        </div>
                    </td>
                </tr>
                
                @endif
                <tr>
                    <td class="showMood start" colspan="2" style="width: 50%;">
                        <span class="left">{{date("H:i",strtotime($arrayList[$i]->date_start) )}}</span>
                        <span class="right">{{date("H:i",strtotime($arrayList[$i]->date_end) )}}</span>
                        <br>
                        <div class="cell{{\App\Http\Services\Common::setColor($arrayList[$i]->level_mood)}} level" style="width: {{$percent[array_search($arrayList[$i]->id,array_column($percent, 'id'))]["percent"]}}%">&nbsp;</div>
                        <div style="text-align: center; width: 70%;">
                        <span class="HourMood">{{\App\Http\Services\Common::calculateHour($arrayList[$i]->date_start,$arrayList[$i]->date_end)}}</span>
                        </div>
                    </td>
                    <td class="sizeTableMood showMood ">
                        
                            <span class="fontMood" >{{$arrayList[$i]->level_mood}}</span>
                       
                    </td>
                    <td class="sizeTableMood showMood ">
                            <span class="fontMood"  >{{$arrayList[$i]->level_anxiety}}</span>
                        
                    </td>
                    <td class="sizeTableMood showMood ">
                        
                            <span class="fontMood"  >{{$arrayList[$i]->level_nervousness}}</span>
                        
                    </td>
                    <td class="sizeTableMood showMood ">
                        
                            <span class="fontMood"  >{{$arrayList[$i]->level_stimulation}}</span>
                        
                    </td>
                    <td class="sizeTableMood showMood ">
                        
                            @if ($arrayList[$i]->epizodes_psychotik != 0)
                                    <span class="MessageError" >{{$arrayList[$i]->epizodes_psychotik}} epizodów psychotycznych</span>
                            @else
                                   <span  > Brak </span>
                            @endif
                        
                    </td>
                    
                </tr>
                <tr class='moodClass{{$arrayList[$i]->id}}'>
                    <td colspan="7" class="moodButton">
                       
                        <div >
                           
                                   <div class="divButton">
                                        @if (!empty(\App\Models\Usee::ifExistUsee($arrayList[$i]->date_start,$arrayList[$i]->date_end,Auth::User()->id) ))
                                            <button class="btn-mood drugs" onclick="showDrugs('{{ route('ajax.showDrugs')}}',{{$arrayList[$i]->id}})">pokaż leki</button>
                                        @else
                                            <button type="button" class="disable "  disabled>nie było leków</button>
                                        @endif
                                   </div>

                                   <div class="divButton">
                                        @if (!empty(\App\Models\Moods_action::ifExistAction($arrayList[$i]->id) ))
                                            <button class="btn-mood action" onclick="showAction('{{ route('ajax.showAction')}}',{{$arrayList[$i]->id}})">pokaż akcje</button>
                                        @else
                                            <button type="button" class="disable "  disabled>nie było akcji</button>
                                        @endif
                                   </div>
                                   <div class="divButton">

                                        @if ((\App\Models\Mood::showDescription($arrayList[$i]->id)->what_work != "" ))
                                            <button class="btn-mood  mood" onclick="showDescritionMood('{{route("ajax.showMoodDescription")}}',{{$arrayList[$i]->id}})">pokaż  opis</button>
                                        @else
                                            <button type="button" class="disable "  disabled>nie było opisu</button>
                                        @endif
                                    </div>
                       
                                
                        </div>
                     
                        
                    </td>
                </tr>
                @endfor
                <tr>
                    <td colspan="7" class=" ">
                        @php 
                        $arrayList->appends(['sort'=>Request::get('sort')])
                        ->appends(['moodFrom'=>Request::get("moodFrom")])
                        ->appends(['moodTo'=>Request::get("moodTo")])
                        ->appends(['anxientyFrom'=>Request::get("anxientyFrom")])
                        ->appends(['anxientyTo'=>Request::get("anxientyTo")])
                        ->appends(['voltageFrom'=>Request::get("voltageFrom")])
                        ->appends(['voltageTo'=>Request::get("voltageTo")])
                        ->appends(['stimulationFrom'=>Request::get("stimulationFrom")])
                        ->appends(['stimulationTo'=>Request::get("stimulationTo")])
                        ->appends(['dateFrom'=>Request::get("dateFrom")])
                        ->appends(['dateTo'=>Request::get("dateTo")])
                        ->appends(['timeFrom'=>Request::get("timeFrom")])
                        ->appends(['timeTo'=>Request::get("timeTo")])
                        ->appends(['longMoodHourFrom'=>Request::get("longMoodHourFrom")])
                        ->appends(['longMoodMinutesFrom'=>Request::get("longMoodMinutesFrom")])
                        ->appends(['longMoodHourTo'=>Request::get("longMoodHourTo")])
                        ->appends(['longMoodMinutesTo'=>Request::get("longMoodMinutesTo")])
                        ->appends(["action" => Request::get("action")])
                        ->appends(["actionFrom" => Request::get("actionFrom")])
                        ->appends(["actionTo" => Request::get("actionTo")])
                        ->appends(["whatWork" => Request::get("whatWork")])
                        ->appends(['epizodesFrom'=>Request::get("epizodesFrom")])
                        ->appends(['epizodesTo'=>Request::get("epizodesTo")])
                        ->appends(['ifWhatWork'=>Request::get("ifWhatWork")])
                        ->appends(['ifAction'=>Request::get("ifAction")])
                        ->appends(['sort2'=>Request::get("sort2")])
                        ->links();
                        @endphp
                        {{$arrayList}}

                    </td>
            </tr>
            </table>
        </div>

    
    @endif



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

@endsection