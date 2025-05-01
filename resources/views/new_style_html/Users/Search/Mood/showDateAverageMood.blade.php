{{$date}}

<div class="search-mood-average-date-div">
    <div class="search-mood-average-date-menu">
        @if (count($actionDay) == 0)
            <span class="search-mood-average-date-span">Nie było żadnych akcji całodniowych</span>
        @else

            <a onclick="showActionForAllDay()" class="search-mood-average-date-menu-2">pokaż akcje całodniowe</a>

        @endif
    </div>
    <div class="menuDate">
        @if (count($actionSum) == 0)
            <span class="search-mood-average-date-span">Nie było żadnych akcji</span>
        @else

            <a onclick="showActionForSum()" class="search-mood-average-date-menu-2" >pokaż akcje </a>

        @endif
    </div>
    <div class="menuDate">
        @if (count($listSubstance) == 0)
            <span class="search-mood-average-date-span">Nie było żadnych substancji</span>
        @else

            <a onclick="showSubstance()" class="search-mood-average-date-menu-2" >pokaż substancje </a>

        @endif
    </div>
</div>
    <div class="search-mood-average-date-actionday" style="display: none;">
        
        <table class="table">
                <thead >
                    <tr>
                        <td colspan="2" class="search-mood-title">
                            AKCJE CAŁODNIOWE
                        </td>
                    </tr>
                    
                    
                    
                </thead>
                                <thead>
                    <tr >
                        <td class="search-mood-center" style="width: 50%;" colspan="1" >
                            nazwa
                        </td>
                        
                        <td class="search-mood-center" style="width: 40%;">
                            godzina
                        </td>
                      

                        
                    </tr>
                    </thead>
                    
                
                    @foreach ($actionDay as $list)
                        <tr id="tractionId{{$list->id}}">
                            <td  class="search-mood-center">
                                <div class='positionAction leveAction{{\App\Http\Services\Common::setColorPleasure($list->level_pleasure)}}' id="editActionDay{{$list->id}}">{{$list->name}}
                        
                                </div>
                            </td>
         
                            <td  class="search-mood-center">
                                {{substr($list->date,11,-3)}}
                            </td>
                           
                        </tr>
                        
                        
                    @endforeach
                    
        </table>
    
    </div>


    <div class="search-mood-average-date-actionsum" style="display: none;">

        <table >
            <thead >
                <tr>
                    <td colspan="2" class="search-mood-title">
                        AKCJE 
                    </td>
                </tr>
                
                
                
            </thead>
                            <thead>
                <tr >
                    <td class="search-mood-center" style="width: 50%;" >
                        nazwa
                    </td>
                    <td class="search-mood-center" style="width: 40%;">
                        Łączna ilośc czasu dla całego dnia
                    </td>
                   

                    
                </tr>
                </thead>
                
               
                @foreach ($actionSum as $list)
                    <tr >
                        <td  class="search-mood-center">
                            <div class='positionAction leveAction{{\App\Http\Services\Common::setColorPleasure($list->level_pleasure)}}'>{{$list->name}}</div>
                        </td>
                        <td  class="search-mood-center">
                            @if ($list->sum == 0)
                            <span class="warning">Mniej niż minuta</span>
                            @else
                            {{\App\Http\Services\Common::calculateHourOne($list->sum * 60)}}
                            @endif
                        </td>
                       
                    </tr>
                    
                    
                @endforeach
                
        </table>
    </div>

    
    <div class="search-mood-average-date-substance" style="display: none;">

                <table class="table">
                    <thead>
                        <tr >
                        <td class="search-mood-center" style="width: 50%;" >
                            nazwa
                        </td>
                        <td class="search-mood-center" style="width: 40%;">
                            dawka
                        </td>
                    

                        
                     </tr>

                    </thead>
                            @foreach ($listSubstance as $list)
                                @if ($loop->index % 2 == 0)
                                    <tr class="main-drugs-sum-table-1">
                                @else
                                    <tr  class="main-drugs-sum-table-0">
                                @endif
                                        
                                <td  class="search-mood-center">{{$list->name}} </td>
                                <td  class="search-mood-center">
                                    @if ($list->type == 4 or $list->type ==5 )
                                        <div class='positionDrugsDose'>{{round($list->portions / $list->count,2)}}  {{\App\Http\Services\Common::showDoseProductSubstance($list->type)}}</div>
                                    @else
                                        <div class='positionDrugsDose'>{{$list->portions}} {{\App\Http\Services\Common::showDoseProductSubstance($list->type)}}</div>
                                    @endif
                                </td>
                                </tr>
                            @endforeach
                 

    </div>

