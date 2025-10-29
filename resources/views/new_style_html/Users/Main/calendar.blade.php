
<div id="calendar">

	<table  align=center class='main-calendar'>
	  <tr>
	    <td colspan=7><div align=center><span class="main-calendar-month">{{$text_month}} {{$year}}</span></div></td>
	  </tr>
	  <tr>
	    <td><div align=center><span class="main-calendar-span">Pon</span></div></td>
	    <td><div align=center><span class="main-calendar-span">Wto</span></div></td>
	    <td><div align=center><span class="main-calendar-span">śro</span></div></td>
	    <td><div align=center><span class="main-calendar-span">Czwa</span></div></td>
	    <td><div align=center><span class="main-calendar-span">Pią</span></div></td>
	    <td><div align=center><span class="main-calendar-span">Sob</span></div></td>
	    <td><div align=center><span class="main-calendar-span">Nie</span></div></td>
	  </tr>
	  <tbody>

@php
$tmp = -10;
@endphp
  @while ( $day2 <= $how_day_month) 

    <tr class='main-calendar-tr '>
    
    @for ($cols=0;$cols < 7;$cols++) 
    <td class='main-calendar-td'>
      @if ($day2 <= $how_day_month ) 

	
	
        @if ($day1 >= $day_week )

            @if ( $day2 == $day3 ) 
                <div  align=center id='day_{{$day2}}' class="main-calendar-cell-active"><span class="active">{{$day2}}</span></div>


            @else
     
                <div onmouseover='calendarOn("day_{{$day2}}")' onmouseout='calendarOff("day_{{$day2}}")' align=center id='day_{{$day2}}' 
                class="cell{{$color[$day2-1]}} cell main-calendar-cell-border  "
                 onclick="LoadPage('{{route('users.main')}}/{{$year}}/{{$month}}/{{$day2}}')">
                  <a  class="main-calendar-span-active " href="{{route('users.main')}}/{{$year}}/{{$month}}/{{$day2}}  ">{{$day2}} 
                    <div class='howAction'> {{empty($listPlanedAction[$day2-1])? '' :  $listPlanedAction[$day2-1]->how  }}</div>
                  </a>
                </div>
                
            @endif
            </td>
            @php
                
                $day2++;
            @endphp
            
       
        
        
       
        @endif
	@php 
        $day1++;
	@endphp
	
      @endif
        
    @endfor
    </tr>

  @endwhile
  <tr>

</table>
</div>
<br>


<div class=" center main-menu-month">
  
  <div class="main-menu-month-one">
      <button class="btn btn-primary main-button-month mainHref" onclick=location.href="{{ route('users.main')}}/{{$back[0]}}/{{$back[1]}}/1/">Miesiąc Wstecz</button>
  </div>
  <div class="main-menu-month-one">
          <button class="btn btn-success main-button-month mainHref" onclick=location.href="{{ route('users.main')}}/{{$back_year[0]}}/{{$back_year[1]}}/1/">Rok Wstecz</button>
  </div>
  <div class="main-menu-month-one">
      <button class="btn btn-success main-button-month mainHref" onclick=location.href="{{ route('users.main')}}/{{$next_year[0]}}/{{$next_year[1]}}/1/">Rok Dalej</button>
      
  </div>
  <div class="main-menu-month-one">
      <button class="btn btn-primary  main-button-month  mainHref" onclick=location.href="{{ route('users.main')}}/{{$next[0]}}/{{$next[1]}}/1/">miesiąc Dalej</button>
      
      
  </div>
  
</div>


    
