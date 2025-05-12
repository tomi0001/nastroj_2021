@extends(str_replace("css","html",Auth::User()->css) . '.Layout.Search')

@section('content')





    @section ('title') 
    Wyszukiwanie
    @endsection

    @if (empty($arrayList)  )
             <div class="search-error">
            Ilość wyników  {{$count}}
       
        <br>
        
        <a href="javascript:history.back()"><button class="btn btn-lg btn-danger" >WSTECZ</button></a>
        </div>   
@else
        


        
      
        
        <div class="settings-title">
                        WYSZKUKAJ NASTRÓJ
        </div>
 
        <div class="search-mood-average-div" style=" padding: 10px; ">

<div style="margin-left: auto;margin-right: auto; ">

    <div class="search-mmod-average-title-date">
        
        <span class="search-mood-average-span font-mood-span">DATA: 
        Od
        @if ($dateFrom == "")
                początku
            @else
                {{$dateFrom}}
            @endif
        do
        @if ($dateTo == "")
                końca
            @else
                {{$dateTo}}
            @endif
        </span>

        <hr class="search-mood-average-hr">
        <span class="search-mood-average-span font-mood-span">GODZINA: 
        Od
        @if ($timeFrom == "")
                najmniejszej
            @else
                {{$timeFrom}}
            @endif
        do
        @if ($timeTo == "")
                największej
            @else
                {{$timeTo}}
            @endif
        </span>
        <hr class="search-mood-average-hr">
        
 
    </div>


</div></div>
<div  class="main-search-show-single-week">
        <div class="search-mood-sum-action">
                        <table class="table">
                        <thead >
                                <tr >
                                    
                                    <td class="search-table-center">
                                        Nazwa produktu
                                    </td>
                                    <td class="search-table-center">
                                        Substancje produktu
                                    </td>
                                    <td class="search-table-center">
                                        dawka
                                    </td>
                                    <td class="search-table-center">
                                        Ilość wzięć
                                    </td>
                                    <td class="search-table-center">
                                        ile kosztowało
                                    </td>

                                </tr>
                        </thead>
                                @for ($i=0;$i < count($arrayList);$i++)
                                    @if ($i% 2 == 0)
                                        <tr class="main-drugs-sum-table-1">
                                    @else
                                        <tr  class="main-drugs-sum-table-0">
                                    @endif

                               
                                    
                                    <td class="search-table-center" >
                                        <span class="font-mood-span" >{{$arrayList[$i]->name}}</span>
                                    </td>
                                    <td class="search-table-center" >
                                <span class="font-mood-span" >


                                    @foreach (\App\Models\Substances_product::showSubstance($arrayList[$i]->id) as $list2)

                                        [{{$list2->name}}]
                                        @if ($loop->index > 3)
                                            <a onclick ="showAllSubstance('{{route('ajax.showAllSubctance')}}')">.....</a>
                                            @break
                                        @endif
                                    @endforeach
                                    @if (count(\App\Models\Substances_product::showSubstance($arrayList[$i]->id)) == 0)
                                        <span class="warning">Nie było żadnych substancji</span>
                                    @endif

                                </span>
                                        <br>

                                    </td>
                                    <td class="search-table-center ">

                                        <span class="font-mood-span" >{{$arrayList[$i]->portions}} {{\App\Http\Services\Common::showDoseProduct($arrayList[$i]->type)}}</span>

                                    </td>
                                    <td class="search-table-center ">

                                        <span class="font-mood-span"  >{{$arrayList[$i]->count}} </span>

                                    </td>
                                    <td class="search-table-center">

                                        <span class="font-mood-span"  >{{$arrayList[$i]->price}} zł</span>

                                    </td>


                                    <td  ></td>
                                    <td></td>
                                </tr>

                                @endfor

                            </table>


        </div>
</div>
       
        <div class="d-flex justify-content-center">
            @php
                 $arrayList->appends(['sort'=>Request::get('sort')])
                        ->appends(['nameSubstance'=>Request::get('nameSubstance')])
                        ->appends(['nameProduct'=>Request::get('nameProduct')])
                        ->appends(['doseFromProduct'=>Request::get('doseFromProduct')])
                        ->appends(['doseToProduct'=>Request::get('doseToProduct')])
                        ->appends(['doseFromSubstance'=>Request::get('doseFromSubstance')])
                        ->appends(['doseToSubstance'=>Request::get('doseToSubstance')])
                        ->appends(['nameGroup'=>Request::get('nameGroup')])
                        ->appends(['doseFromGroup'=>Request::get('doseFromGroup')])
                        ->appends(['doseToGroup'=>Request::get('doseToGroup')])

                ->appends(['dateFrom'=>Request::get("dateFrom")])
                ->appends(['dateTo'=>Request::get("dateTo")])
                ->appends(['timeFrom'=>Request::get("timeFrom")])
                ->appends(['timeTo'=>Request::get("timeTo")])
                ->appends(["whatWork" => Request::get("whatWork")])
                ->appends(['ifWhatWork'=>Request::get("ifWhatWork")])
                ->appends(['sumDay'=>'on'])
                ->appends(['sort2'=>Request::get("sort2")])
                ->appends(['day1'=>Request::get("day1")])
                        ->appends(['day2'=>Request::get("day2")])
                        ->appends(['day3'=>Request::get("day3")])
                        ->appends(['day4'=>Request::get("day4")])
                        ->appends(['day5'=>Request::get("day5")])
                        ->appends(['day6'=>Request::get("day6")])
                        ->appends(['day7'=>Request::get("day7")])
                ->links();
            @endphp
            {{$arrayList}}
        </div>

    </div>


@endif


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />


@include(str_replace("css","html",Auth::User()->css) . '.Users.Settings.headJs')
@endsection