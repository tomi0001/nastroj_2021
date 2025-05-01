
<table class="table" >
    <thead>
        <tr>
            <td class="main-action-positionActionTitle1" style="width: 60%;">
                Nazwa akcji
            </td>
            <td class="main-action-positionActionTitle2" style="width: 40%;">
                Minut wykonania
            </td>
        </tr>
    </thead>
@foreach ($listAction as $list)
<tr>
    <td style="width: 60%;" class="main-action-positionAction  leveAction{{\App\Http\Services\Common::setColorPleasure($list->level_pleasure)}}">{{$list->name}}</td>
    <td style="width: 40%;" class="main-action-positionAction  leveAction{{\App\Http\Services\Common::setColorPleasure($list->level_pleasure)}}"> 
        @if ($list->sum == 0 )
        <span class="warning">Mniej niż minuta</span>
        @else
        {{\App\Http\Services\Common::calculateHourOne($list->sum * 60)}}  
        @endif
    </td>
    
</tr>
@endforeach
</table>
