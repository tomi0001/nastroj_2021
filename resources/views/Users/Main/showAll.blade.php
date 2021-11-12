<div id="allMoodDrugsAction">
        <div class="row">

            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="sumMood">
                    @if (!empty($sumAll) )
                    <div class="level level{{\App\Http\Services\Common::setColor($sumAll->sum_mood)}}" style="height: 20%; padding-top: 3px;">
                                Poziom nastroju {{round($sumAll->sum_mood,2)}} dla całego dnia
                    </div>
                    <div class="level{{\App\Http\Services\Common::setColor(-$sumAll->sum_anxiety)}} level " style="height: 20%; padding-top: 3px;">
                                Poziom lęku {{( round($sumAll->sum_anxiety,2))}} dla całego dnia
                    </div>
                    <div class="level{{\App\Http\Services\Common::setColor(-$sumAll->sum_nervousness)}} level " style="height: 20%; padding-top: 3px;">
                                Poziom napięcia {{( round($sumAll->sum_nervousness,2))}} dla całego dnia
                    </div>
                    <div class="level{{\App\Http\Services\Common::setColor($sumAll->sum_stimulation)}} level" style="height: 20%; padding-top: 3px;">
                                Poziom pobudzenia {{( round($sumAll->sum_stimulation,2))}} dla całego dnia
                    </div>
                    @else
                        <div class="errorMainMessage">
                            Nie było żadnych nastroji dla tego dnia
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="sumDrugs">
                    @if (count($listDrugs) > 0 )
                        <div class='sumDrugsAt'>
                            @foreach ($listSubstance as $list)
                                <div class='positionDrugs'>{{$list->name}}</div>
                            @endforeach
                        </div>
                    @else
                        <div class="errorMainMessage">
                            Nie było żadnych leków dla tego dnia
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
                             <div class="sumMood">
                    <div class="level level9" style="height: 20%; padding-top: 3px;">
                                Poziom nastroju 1
                    </div>
                    <div class="level3 level " style="height: 20%; padding-top: 3px;">
                                Poziom lęku 1
                    </div>
                    <div class="level-3 level " style="height: 20%; padding-top: 3px;">
                                Poziom lę 1
                    </div>
                    <div class="level-4 level" style="height: 20%; padding-top: 3px;">
                                Poziom lęku 1
                    </div>
                </div>
            </div>
 

         
        </div>
</div>
<br>