<div class="sumAverage">
    


    
    @for ($i=0;$i < count($listAverage);$i++)
        <div class="averageDiv">
            {{$listAverage[$i]["dateStart"]}} - {{$listAverage[$i]["dateEnd"]}} <br>
            Dawka = {{$listAverage[$i]["portion"]}} <br>
            ilośc wzięć = {{$listAverage[$i]["how"]}} <br>
            ilośc dni {{\App\Http\Services\Common::calculateHour(date("Y-m-d",strtotime($listAverage[$i]["dateStart"]) - 8400),$listAverage[$i]["dateEnd"])}} <br>
        </div>
        
    
    @endfor
    
    
</div>