<div class="search-mood-action-sum">
        <table class="table">
            <thead >
                <tr>
                    <td colspan="3" class="search-mood-title">
                        AKCJE 
                    </td>
                </tr>
                
                
                
            </thead>
                            <thead >
                <tr >
                    <td style="width: 50%; border-right-style: hidden;" >
                        nazwa
                    </td>
                    <td style="width: 40%;">
                        Łączna ilośc czasu dla całego dnia
                    </td>
                    <td  style="width: 40%;">
                        poziom przyjemności
                    </td>

                    
                </tr>
                </thead>
                
               
                @foreach ($actionSum[$i] as $list)
                    <tr >
                        <td  >
                            <div class='positionAction leveAction{{\App\Http\Services\Common::setColorPleasure($list->level_pleasure)}}'>{{$list->name}}</div>
                        </td>
                        <td  >
                            @if ($list->sum == 0)
                            <span >Mniej niż minuta</span>
                            @else
                            {{\App\Http\Services\Common::calculateHourOne($list->sum * 60)}}
                            @endif
                        </td>
                        <td >
                            {{$list->level_pleasure}}
                        </td>
                    </tr>
                    
                    
                @endforeach
                
        </table>
</div>