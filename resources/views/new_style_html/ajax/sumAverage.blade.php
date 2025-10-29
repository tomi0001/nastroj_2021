<div class="main-drugs-average">
    


    
    @for ($i=0;$i < count($listAverage);$i++)
        <div class="main-drugs-average-div">
            {{$listAverage[$i]["dateStart"]}} - {{$listAverage[$i]["dateEnd"]}} <br>
            Dawka = {{$listAverage[$i]["portions"]}} {{\App\Http\Services\Common::showDoseProduct($listAverage[$i]["type"])}}<br>
            <div class="main-drugs-average-how {{\App\Http\Services\Common::showColorTypeHow($listAverage[$i]["how"])}}"> ilośc wzięć = {{($listAverage[$i]["how"])}} </div> 
            @php
                $diff = \App\Http\Services\Common::calculateHourAverage(date("Y-m-d",strtotime($listAverage[$i]["dateStart"]) - 8400),$listAverage[$i]["dateEnd"]);
            @endphp
           
          
                ilośc dni {{$diff}}
           
            
            
             <br>
        </div>
        @if (($i !=(count($listAverage) - 1  ) )    and ( strtotime($listAverage[$i]["dateStart"])  - strtotime($listAverage[$i+1]["dateEnd"]) ) >   ( 86400)  and \App\Http\Services\Common::ifChangeTimeWinterOne($listAverage[$i]["dateStart"]) == false )
        
          
       
            @php
                $daySub = \App\Http\Services\Common::calculateHourAverage(($listAverage[$i]["dateStart"]), ($listAverage[$i+1]["dateEnd"]))
            @endphp
          
                <div class="main-drugs-average-line">przerwa dni {{$daySub-1}}</div>
            
            <br>
        
          
        @endif
    @endfor
    
    
</div>