<div id="showaction" class="main-action-show" style="display: none;">
            
            
    
    
    @if (strTotime($date) <= strToTime(date("Y-m-d") ) )
    
        @if (count($actionForDay) == 0) 
            <div class="main-action-show-not" >
                NIE BYŁO AKCJI CAŁODNIOWYCH
            </div>
        @else
            <div class="main-action-show-title" >
                AKCJE CAŁODNIOWE
            </div>
            @include(str_replace("css","html",Auth::User()->css) . '.Users.Main.showActionDays')
        
        @endif
        @if (count($actionSum) == 0) 
            <div class="main-action-show-not  " >
                NIE BYŁO AKCJI
            </div>
        @else
             <div class="main-action-show-title" >
                AKCJE
            </div>
            @include(str_replace("css","html",Auth::User()->css) . '.Users.Main.showActionSum')
        @endif
        @if (count($actionPlan) == 0) 
            <div class="main-action-show-not  " >
                NIE BYŁO AKCJI ZAPLANOWANYCH
            </div>
        @else
            <div class="main-action-show-title" >
                AKCJE ZAPLANOWANE
            </div>
            @include(str_replace("css","html",Auth::User()->css) . '.Users.Main.showActionPlaned')
        @endif
    @else
        @if (count($actionPlan) == 0) 
            <div class="main-action-show-not  " >
                NIE BYŁO AKCJI ZAPLANOWANYCH
            </div>
        @else
           <div class="main-action-show-title" >
                AKCJE ZAPLANOWANE
            </div>
            @include(str_replace("css","html",Auth::User()->css) . '.Users.Main.showActionPlaned')
        @endif
        @if (count($actionForDay) == 0) 
            <div class="main-action-show-not" >
                NIE BYŁO AKCJI CAŁODNIOWYCH
            </div>
        @else
            <div class="main-action-show-title" >
                AKCJE CAŁODNIOWE
            </div>
            @include(str_replace("css","html",Auth::User()->css) . '.Users.Main.showActionDays')
        
        @endif
        

    @endif
    
    <br><br>
</div>