<table class="table main-action-table">
          
                            <thead>
                <tr class="main-action-tr-bold">
                    <td class=" main-center" style="width: 50%;  border-right-style: hidden;" >
                        nazwa
                    </td>
                    <td class="main-center" style="width: 20%;">
                        godzina
                    </td>
                    <td class="main-center" style="width: 20%;">
                        Długość
                    </td>
                    <td class="main-center" style="width: 10%;">
                        poziom przyjemności
                    </td>

                    
                </tr>
                </thead>
                
               
                @foreach ($actionPlan as $list)
                    <tr >
                        <td  class="main-center">
                            <div class='main-action-position leveAction{{\App\Http\Services\Common::setColorPleasure($list->level_pleasure)}}'>{{$list->name}}</div>
                            @if ($list->what_work != "")
                                 <div class="descriptionAction">{{$list->what_work}}</div>
                            @endif
                            
                            
                        </td>
                        <td  class="main-center">
                            <a onclick="atHourActonPlan('{{ route('ajax.atHourActonPlan')}}',{{$list->id}})" style='cursor:pointer;'>{{substr($list->date,11,-3)}}</a>
                            <div id='actionPlan{{$list->id}}'></div>
                        </td>
                        <td  class=" main-center">
                            @if ($list->longer == "")
                                0 minut
                            @else
                            {{$list->longer}} minut
                            @endif
                        </td>
                        <td  class="main-center">
                            {{$list->level_pleasure}}
                        </td>
                    </tr>
            
                    
                    
                @endforeach
                
        </table>
    