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
                    <td style="width: 50%; border-right-style: hidden;"   class="font-color-action-td">
                        nazwa
                    </td>
                    <td  style="width: 40%;"   class="font-color-action-td">
                        Łączna ilośc czasu dla całego dnia
                    </td>
                    <td  style="width: 40%;"   class="font-color-action-td">
                        poziom przyjemności
                    </td>

                    
                </tr>
                </thead>
                
               
                @foreach ($actionSum as $list)
                    <tr >
                        <td  >
                            <div class='positionAction leveAction{{\App\Http\Services\Common::setColorPleasure($list->level_pleasure)}}'>{{$list->name}}</div>
                        </td>
                        <td    class="font-color-action-td">
                             <div class="position-action-td">
                            @if ($list->sum == 0)
                            <span >Mniej niż minuta</span>
                            @else
                            {{\App\Http\Services\Common::calculateHourOne($list->sum * 60)}}
                            @endif
                            </div>
                        </td>
                        <td   class="font-color-action-td">
                             <div class="position-action-td">
                            {{$list->level_pleasure}}
                            </div>
                        </td>
                    </tr>
                    
                    
                @endforeach
                
        </table>
</div>