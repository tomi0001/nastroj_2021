<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="main-mood-sum">
                    @if (($sumAll->sum_mood !== null)  )
                    <div class="level level{{\App\Http\Services\Common::setColor($sumAll->sum_mood)}}" >
                                Poziom nastroju {{(round($sumAll->sum_mood,3) == '-0') ? '0' : round($sumAll->sum_mood,3)}} dla całego dnia
                    </div>
                    <div class="level{{\App\Http\Services\Common::setColor(-$sumAll->sum_anxiety)}} level " >
                                Poziom lęku {{( round($sumAll->sum_anxiety,3)) == '-0' ? '0' : round($sumAll->sum_anxiety,3)}} dla całego dnia
                    </div>
                    <div class="level{{\App\Http\Services\Common::setColor(-$sumAll->sum_nervousness)}} level " >
                                Poziom napięcia {{( round($sumAll->sum_nervousness,3)) == '-0' ? '0': round($sumAll->sum_nervousness,3)}} dla całego dnia
                    </div>
                    <div class="level{{\App\Http\Services\Common::setColor($sumAll->sum_stimulation)}} level" >
                                Poziom pobudzenia {{( round($sumAll->sum_stimulation,3) == '-0' ? '0' : round($sumAll->sum_stimulation,3))}} dla całego dnia
                    </div>
                    @else
                        <div class="errorMainMessage">
                            Nie było żadnych nastroji dla tego dnia
                        </div>
                    @endif
                </div>
</div>
