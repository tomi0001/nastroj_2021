
        <table class="actionShow showAction">
            <thead >
                <tr>
                    <td colspan="3" class="center boldTitle">
                        AKCJE 
                    </td>
                </tr>
                
                
                
            </thead>
                            <thead class="titleTheadAction">
                <tr class="bold">
                    <td class=" showAction center" style="width: 50%; border-right-style: hidden;" >
                        nazwa
                    </td>
                    <td class=" showAction center" style="width: 40%;">
                        Łączna ilośc czasu dla całego dnia
                    </td>
                    <td class="sizeTableMood showAction center" style="width: 40%;">
                        poziom przyjemności
                    </td>

                    
                </tr>
                </thead>
                
               
                @foreach ($actionSum as $list)
                    <tr >
                        <td  class=" showAction tdAction center">
                            <div class='positionAction leveAction{{$list->level_pleasure}}'>{{$list->name}}</div>
                        </td>
                        <td  class=" showAction center tdAction ">
                            {{\App\Http\Services\Common::calculateHourOne($list->sum * 60)}}
                        </td>
                        <td class="sizeTableMood showAction center">
                            {{$list->level_pleasure}}
                        </td>
                    </tr>
                    
                    
                @endforeach
                
        </table>
    