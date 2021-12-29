<table class="actionShowIdMood">
    <thead>
        <tr>
            <td class="titleAction">
                Nazwa akcji
            </td>
            <td class="titleAction">
                Minut wykonania
            </td>
        </tr>
    </thead>
@foreach ($listAction as $list)
<tr>
    <td> <div class='positionAction leveAction{{$list->level_pleasure}}'>{{$list->name}}</div> </td>
    <td> 
        @if ($list->sum == 0 )
        <span class="warning">Mniej niż minuta</span>
        @else
        {{$list->sum}}  
        @endif
    </td>
    
</tr>
@endforeach
</table>