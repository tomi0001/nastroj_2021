{{$date}}

<div class="menuAverageDate">
    <div class="menuDate">
        @if (count($actionDay) == 0)
            <span class="disabledAverageDate">Nie było żadnych akcji całodniowych</span>
        @else

            <a onclick="showActionForAllDay()" class="menuAverageDate">pokaż akcje całodniowe</a>

        @endif
    </div>
    <div class="menuDate">
        @if (count($actionSum) == 0)
            <span class="disabledAverageDate">Nie było żadnych akcji</span>
        @else

            <a onclick="showActionForSum()" class="menuAverageDate" >pokaż akcje </a>

        @endif
    </div>
    <div class="menuDate">
        @if (count($listSubstance) == 0)
            <span class="disabledAverageDate">Nie było żadnych substancji</span>
        @else

            <a onclick="showSubstance()" class="menuAverageDate" >pokaż substancje </a>

        @endif
    </div>
</div>
    <div class="showAverageDateActionDay" style="display: none;">
        
        <table >
                <thead >
                    <tr>
                        <td colspan="5" class="center boldTitle">
                            AKCJE CAŁODNIOWE
                        </td>
                    </tr>
                    
                    
                    
                </thead>
                                <thead class="titleTheadAction">
                    <tr class="bold">
                        <td class=" showAction center" style="width: 50%; border-right-style: hidden;" colspan="1" >
                            nazwa
                        </td>
                        
                        <td class=" showAction center" style="width: 40%;">
                            godzina
                        </td>
                      

                        
                    </tr>
                    </thead>
                    
                
                    @foreach ($actionDay as $list)
                        <tr id="tractionId{{$list->id}}">
                            <td  class=" showAction tdAction center">
                                <div class='positionAction leveAction{{\App\Http\Services\Common::setColorPleasure($list->level_pleasure)}}' id="editActionDay{{$list->id}}">{{$list->name}}
                        
                                </div>
                            </td>
         
                            <td  class=" showAction center tdAction ">
                                {{substr($list->date,11,-3)}}
                            </td>
                           
                        </tr>
                        
                        
                    @endforeach
                    
        </table>
    
    </div>


    <div class="showAverageDateSumAction" style="display: none;">

        <table >
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
                   

                    
                </tr>
                </thead>
                
               
                @foreach ($actionSum as $list)
                    <tr >
                        <td  class=" showAction tdAction center">
                            <div class='positionAction leveAction{{\App\Http\Services\Common::setColorPleasure($list->level_pleasure)}}'>{{$list->name}}</div>
                        </td>
                        <td  class=" showAction center tdAction ">
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

    
    <div class="showAverageDateListSubstance" style="display: none;">

                <div class="sumDrugsDateAverage">
                   
                        <div class='sumDrugsAt'>
                            @foreach ($listSubstance as $list)
                                        
                                    <div class='positionDrugs'>{{$list->name}} </div>
                                    
                                    @if ($list->type == 4 or $list->type ==5 )
                                        <div class='positionDrugsDose'>{{round($list->portions / $list->count,2)}}  {{\App\Http\Services\Common::showDoseProductSubstance($list->type)}}</div>
                                    @else
                                        <div class='positionDrugsDose'>{{$list->portions}} {{\App\Http\Services\Common::showDoseProductSubstance($list->type)}}</div>
                                    @endif
                                
                            @endforeach
                        </div>
                  
                </div>

    </div>

