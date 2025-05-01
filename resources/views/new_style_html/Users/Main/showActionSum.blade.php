
        <table class="table main-action-table">
         
                            <thead>
                <tr class="main-action-tr-bold">
                    <td class="main-center" style="width: 50%; border-right-style: hidden;" >
                        nazwa
                    </td>
                    <td class="main-center" style="width: 40%;">
                        Łączna ilośc czasu dla całego dnia
                    </td>
                    <td class="main-center" style="width: 40%;">
                        poziom przyjemności
                    </td>

                    
                </tr>
                </thead>
                
               
                @foreach ($actionSum as $list)
                    <tr >
                        <td  class=" main-center">
                            <div class='main-action-position leveAction{{\App\Http\Services\Common::setColorPleasure($list->level_pleasure)}}'>{{$list->name}}</div>
                        </td>
                        <td  class="main-center">
                            @if ($list->sum == 0)
                            <span class="main-action-warning">Mniej niż minuta</span>
                            @else
                            {{\App\Http\Services\Common::calculateHourOne($list->sum * 60)}}
                            @endif
                        </td>
                        <td class="main-center">
                            {{$list->level_pleasure}}
                        </td>
                    </tr>
                    
                    
                @endforeach
                
        </table>
    