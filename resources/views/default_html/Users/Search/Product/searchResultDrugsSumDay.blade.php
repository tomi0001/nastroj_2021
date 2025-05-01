@extends(str_replace("css","html",Auth::User()->css) . '.Layout.Search')

@section('content')



@section ('title')
    Wyszukiwanie
@endsection

@if ($count == 0 )
    <div class="countSearch error">
        Ilość wyników  {{$count}}
    </div>
    <br>
    <div class='center'>
        <a href="javascript:history.back()"><button class="btn-mood mood" >WSTECZ</button></a>
    </div>
@else
    <div class="countSearch notError">
        Ilość wyników  {{$count}}
    </div>


    <br>

    <div class='tableSearchMood' id="ajaxData">
        <div class="titleSearchResult titleSearchResultMood">WYSZUKIWANIE</div>
        <div class="drugsSearchResult">
            <div class="dayDrugs" style="min-height: 90px; padding: 10px; ">
                <div style="margin-left: auto;margin-right: auto; ">
                <div class="dateSumDay">
                    <div class="titleSearchSumDay">
                        <span class="titleSearchSumDay">DATA</span>
                    </div>
                    <span class="fontSearchSumDay">
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
                </div>
                <div class="dateSumDay">
                    <div class="titleSearchSumDay">
                        <span class="titleSearchSumDay">GODZINA</span>
                    </div>
                    <span class="fontSearchSumDay">
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
                </div>
                <div class="dateSumDay">
                    <div class="titleSearchSumDay">
                        <span class="titleSearchSumDay">DAWKA</span>
                    </div>
                    <span class="fontSearchSumDay">
                    Od
                    @if ($doseFrom == "")
                            najmniejszej
                        @else
                            {{$doseFrom}}
                        @endif
                    do
                    @if ($doseTo == "")
                            największej
                        @else
                            {{$doseTo}}
                        @endif
                    </span>
                </div>
                
                </div>
            </div>
       



           
                    <table style="width: 100%;">

                        <thead >
                        <tr class="bold">
                            <td style="width: 3%;"></td>
                            <td style="width: 2%;">

                            </td>
                            <td class="sizeTableMood showDrugs titleTheadDrugs" style=" width: 25%;" >
                                Nazwa produktu
                            </td>
                            <td class="sizeTableMood showDrugs titleTheadDrugs" style="width: 32%;">
                                Substancje produktu
                            </td>
                            <td class="sizeTableMood showDrugs titleTheadDrugs" style="width: 10%;">
                                dawka
                            </td>
                            <td class="sizeTableMood showDrugs titleTheadDrugs" style="width: 10%;">
                                Ilość wzięć
                            </td>
                            <td class="sizeTableMood showDrugs titleTheadDrugs" style="width: 12%;">
                                ile kosztowało
                            </td>

                            <td >

                            </td>
                            <td style="width: 3%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        </tr>
                        </thead>


                        @for ($i=0;$i < count($arrayList);$i++)


                        <tr>
                            <td></td>
                            <td ></td>
                            <td class="showDrugs start sizeTableMood" >
                                <span class="fontMood" >{{$arrayList[$i]->name}}</span>
                            </td>
                            <td class="showDrugs start sizeTableMood" >
                           <span class="fontMood" >


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
                            <td class="sizeTableMood showDrugs ">

                                <span class="fontMood" >{{$arrayList[$i]->portions}} {{\App\Http\Services\Common::showDoseProduct($arrayList[$i]->type)}}</span>

                            </td>
                            <td class="sizeTableMood showDrugs ">

                                <span class="fontMood"  >{{$arrayList[$i]->count}} </span>

                            </td>
                            <td class="sizeTableMood showDrugs ">

                                <span class="fontMood"  >{{$arrayList[$i]->price}} zł</span>

                            </td>


                            <td  ></td>
                            <td></td>
                        </tr>

                        @endfor

                    </table>




       
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

@endsection
