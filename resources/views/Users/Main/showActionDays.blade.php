
        <table class="actionShow showAction">
            <thead >
                <tr>
                    <td colspan="3" class="center boldTitle">
                        AKCJE CAŁODNIOWE
                    </td>
                </tr>
                
                
                
            </thead>
                            <thead class="titleTheadAction">
                <tr class="bold">
                    <td class=" showAction center" style="width: 50%; border-right-style: hidden;" >
                        nazwa
                    </td>
                    <td class=" showAction center" style="width: 40%;">
                        godzina
                    </td>
                    <td class="sizeTableMood showAction center" style="width: 10%;">
                        poziom przyjemności
                    </td>

                    
                </tr>
                </thead>
                
               
                @foreach ($actionForDay as $list)
                    <tr >
                        <td  class=" showAction tdAction center">
                            <div class='positionAction leveAction{{$list->level_pleasure}}'>{{$list->name}}</div>
                        </td>
                        <td  class=" showAction center tdAction ">
                            {{substr($list->date,11,-3)}}
                        </td>
                        <td  class=" showAction center">
                            {{$list->level_pleasure}}
                        </td>
                    </tr>
                    
                    
                @endforeach
                
        </table>
    