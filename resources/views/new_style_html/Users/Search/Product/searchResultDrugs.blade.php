@extends(str_replace("css","html",Auth::User()->css) . '.Layout.Search')

@section('content')



@section ('title') 
    Wyszukiwanie
@endsection 

@if ($count == 0 )
       <div class="search-error">
            Ilość wyników  {{$count}}
       
        <br>
        
        <a href="javascript:history.back()"><button class="btn btn-lg btn-danger" >WSTECZ</button></a>
        </div>   
    @else
        


        
      
        
        <div class="settings-title">
                        WYSZKUKAJ NASTRÓJ
        </div>
        <div class="search-result">
              Ilość wyników  {{$count}}
          </div>
          <br> 

  

    <div class="main-mood-show">
        

        @for ($i=0;$i < count($arrayList);$i++)

            @if ($i == 0 or $arrayList[$i]->dat != $arrayList[$i-1]->dat)
                            <div class="search-mood-day">Dzień  {{$arrayList[$i]->dat}}
                        
                        
                        @switch ($arrayList[$i]->dayweek)
                        
                        

                            @case (0)
                                Poniedziałek
                                @break
                            @case (1)
                                Wtorek
                                @break
                            @case (2)
                                Środa
                                @break
                            @case (3)
                                Czwartek
                                @break
                            @case (4)
                                Piątek
                                @break
                            @case (5)
                                Sobota
                                @break
                            @case (6)
                                Niedziela
                                @break
                            
                        @endswitch
                     
                    
                    
                    </div>  
                    <div class="search-mood-day-2">
                    <div class="main-mood-show-single-button-all-day">
                                        @if (count(\App\Models\Usee::listSubstnace($arrayList[$i]->dat, Auth::User()->id,Auth::User()->start_day)) > 0)
                                            <button class="btn btn-success btn-lg" onclick="showDaySubstance('{{ route('search.allSubstanceDay')}}','{{$arrayList[$i]->dat}}')">Substancje dla danego dnia</button>
                                        @else
                                            <button type="button" class="disable btn btn-lg btn-outline-dark"  disabled>nie było substancji</button>
                                        @endif
                                    </div>
                                        
                                    <div class="main-mood-show-single-button-all-day">
                                        @if ((\App\Models\Mood::ifActionForDayMood($arrayList[$i]->dat, Auth::User()->id,Auth::User()->start_day)) > 0)
                                            <button class="btn btn-primary btn-lg" onclick="showDayAction('{{ route('search.allActionDay')}}','{{$arrayList[$i]->dat}}')">pokaż akcje</button>
                                        @else
                                            <button type="button" class="disable btn btn-lg btn-outline-dark"  disabled>nie było akcji</button>
                                        @endif
                                    </div>
                                        
                                    <div class="main-mood-show-single-button-all-day">
                                        @if ((\App\Models\Mood::ifExistDateMoodSingle($arrayList[$i]->dat, Auth::User()->id,Auth::User()->start_day)) > 0)
                                            <button class="btn btn-warning btn-lg" onclick="showDayMood('{{route('search.allDayMood')}}','{{$arrayList[$i]->dat}}')">nastrój dla całego dnia</button>
                                        @else
                                            <button type="button" class="disable btn btn-lg btn-outline-dark"  disabled>nie było nastroji</button>
                                        @endif
                                    
                                    </div>
                                    <div class="main-mood-show-single-button-all-day">
                                        
                                        <a target="_blank" href="{{route("users.main")}}/{{str_replace("-","/",$arrayList[$i]->dat)}}"><button class="btn btn-warning btn-lg" >idź do dnia</button></a>
                                        
                                    
                                    </div>

                         


        







                    </div>
                        <div class="search-all-day">
                            <div id="dayMood{{$arrayList[$i]->dat}}" style="display: none;" class="search-mood-day-all">

                            </div>
                            <div  id="daySubstance{{$arrayList[$i]->dat}}" style=" display: none;" class="search-substance-day-all">
                                
                            </div>
                            
                            <div  id="dayAction{{$arrayList[$i]->dat}}"  style="display: none; " class="search-day-action-all">
                                
                            </div>
                        </div>
                    <div style="clear: both;"></div>
                
                   

                        @endif
                        <div  class="main-mood-show-single">

                   
                 
                        
<div class='showAjaxDay'>
    <div id="dayMood{{$arrayList[$i]->datEnd}}" style="display: none; float: left; margin-right: 10px;">

    </div>
    <div  id="daySubstance{{$arrayList[$i]->datEnd}}" style="float: left; display: none; margin-right: 10px;">
        
    </div>
    <div style="clear: both;"></div>
    <div  id="dayAction{{$arrayList[$i]->datEnd}}" class='divActionSum' style="float: left; display: none; margin-right: 10px; ">
        
    </div>
</div>







<div class="main-mood-show-single-left">
<span class="font-mood-span">nazwa:  {{$arrayList[$i]->name}} </span> <br>
                        <span class="font-mood-span">dawka: {{$arrayList[$i]->portions}} {{\App\Http\Services\Common::showDoseProduct($arrayList[$i]->type)}} </span>  <br>
                        <span class="font-mood-span">godzina wzięcia:  {{substr($arrayList[$i]->date,11,-3)}} </span><br>
                        <span class="font-mood-span">ile kosztowało:  {{$arrayList[$i]->price}} zł </span> <br>
</div>
<div class="main-mood-show-single-center">
    
                
            <div class="main-mood-show-single-button">
                @if ((\App\Models\Usee::ifDescriptionDrugs($arrayList[$i]->id_usees,Auth::User()->id) ) > 0)
                    <button class="btn btn-warning btn-lg" onclick="showDescriptionDrugs('{{ route('ajax.showDescriptionDrugs')}}','{{$arrayList[$i]->id_usees}}')">pokaż  opis</button>
                @else
                    <button type="button" class="disable btn btn-lg btn-outline-dark"  disabled>nie było opisu</button>
                @endif
            </div>
             <div class="main-mood-show-single-button">
                                        <button class="btn btn-success btn-lg" onclick="showSubstanceProduct({{$arrayList[$i]->id_usees}})">pokaż substancje</button>
                                            
            </div>
                
            
</div>                    
<div class="main-mood-show-single-right">
<div  class="main-mood-show-hidden descriptionShowMood{{$arrayList[$i]->id}}">

    <div id="messageDescriptionshowMood{{$arrayList[$i]->id_usees}}" class="main-mood-show-description" style="display: none;"></div>

                    <div id="substanceDrugsShow{{$arrayList[$i]->id_usees}}" class="main-mood-show-drugs" style="display: none;">

                                           <div class="main-drugs-ajax">
                    
                                 <div class='main-drugs-ajax-over'>

                                        <table class="table">
                                        <thead>
                                            <tr>
                                                <td class="titleDrugs" style=" width: 45%;">
                                                    Nazwa produktu
                                                </td>
                                                <td class="titleDrugs" style=" width: 35%;">
                                                    dawka
                                                </td>

                                            </tr>
                                        </thead>

                                                                    @foreach (\App\Models\Substances_product::showSubstance($arrayList[$i]->id) as $list2)
                                                                    @if ($loop->index % 2 == 0)
                                                            <tr class="main-drugs-sum-table-1">
                                                @else
                                                            <tr  class="main-drugs-sum-table-0">
                                                @endif
                                                @php
                                                                            $tmp = \App\Models\Usee::showDosePruduct($arrayList[$i]->id_usees,$list2->id,Auth::User()->id);
                                                                        @endphp
                                                <td> {{$list2->name}} </td>
                                            <td> 
                                            {{$tmp->doseProduct}}  =  {{\App\Http\Services\Common::showDoseProduct($tmp->type)}}
                                            </td>
                                        
                                        </tr>
                                                                    
                                        @if (\App\Models\Substance::checkEquivalent($list2->id,Auth::User()->id) != "" )
                                                                            <span class="equivalent"> Równowaznik diazepamu 10 mg =    {{\App\Models\Product::showEquivalent($list2->id,Auth::User()->id,$tmp->doseProduct)->equivalent}} {{\App\Http\Services\Common::showDoseProduct($tmp->type)}} </span>
                                                                            <br>
                                                                            <br>
                                                                            @endif       
                                                                        
                                                                                                
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                    @endforeach
                                                                    
                                                                    @if (count(\App\Models\Substances_product::showSubstance($arrayList[$i]->id)) == 0)
                                                                        <span class="warning">Nie było żadnych substancji</span>
                                                                    @endif
                                        </table>
                                                                    </div>
                                                                </div>



                     </div>

</div>

</div>


</div>  
<div class="main-mood-show-single-br"></div>
       

        @endfor
        <div class="d-flex justify-content-center">
             <form method="GET" action="{{ url()->current() }}">

                            @foreach(request()->except('page') as $key => $value)
                                @if(is_array($value))
                                    @foreach($value as $v)
                                        <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                                    @endforeach
                                @else
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endif
                            @endforeach

                            <select name="page" onchange="this.form.submit()" class="form-select w-auto d-inline-block">
                                @for($i = 1; $i <= $arrayList->lastPage(); $i++)
                                    <option value="{{ $i }}" {{ $i == $arrayList->currentPage() ? 'selected' : '' }}>
                                        Strona {{ $i }}
                                    </option>
                                @endfor
                            </select>

                        </form>
        </div>

    </div>


@endif



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

@endsection
