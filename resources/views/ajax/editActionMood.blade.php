                                      <form id="formUpdateAction{{$idMood}}">
                                        <div class='scroll' >
                                            <div id="parentsAction{{$idMood}}">
                                                <div >
                                                    <input type="text" id="hideActions{{$idMood}}" class='form-control'  >
                                                </div>
                                            
                                                 @foreach (\App\Models\Action::selectAction(Auth::User()->id)  as $list)
                                                 <div class="rowPercent">
                                                     @if ($val = \App\Models\Moods_action::selectValueActionForMood($idMood,Auth::User()->id,$list->id) )
                                                        @if ($val->percent_executing == NULL)
                                                        <script>

                                                               window.onload=selectedActionMainSetValue({{$list->id}},{{$loop->index}},null,{{$idMood}});


                                                       </script>
                                                        @else
                                                        <script>

                                                               window.onload=selectedActionMainSetValue({{$list->id}},{{$loop->index}},{{$val->percent_executing}},{{$idMood}});


                                                        </script>
                                                        @endif
                                                         
                                                     @endif
                                                    <div class='actionMain actionMain{{$idMood}}'  id='divAction_{{$list->id}}_{{$idMood}}' onclick='selectedActionMainValue({{$list->id}},{{$loop->index}},{{$idMood}})'>{{$list->name}}</div>
                                                    <div class="hiddenPercentExecuting centerPercent" id='divActionPercent_{{$list->id}}_{{$idMood}}'>
                                                        <div style="display: inline-block; width: 40%;"><input type="number" class="percentExecuting form-control form-control-lg " title="procent wykonania" placeholder="procent wyk" id="percentExe_{{$loop->index}}" name="percentExe{{$idMood}}[]" min="1" max="100"></div>
                                                        <input type="hidden"  id='idAction' name="idActionss[]" value='NULL'>
                                                    </div>
                                                 </div>
                                                 @endforeach
                                            </div>

                                            <div id="formResult"></div>
                                                dddsff
                                            </div>
                                      </form>
<script>
   
   
   
   
   
   
    $(document).ready(function(){
    
        
        
     jQuery.expr[':'].contains = function(a, i, m) {
  return jQuery(a).text().toUpperCase()
      .indexOf(m[3].toUpperCase()) >= 0;
};
    $("#hideActions{{$idMood}}").keyup( function(e) {
      if ($("#hideActions{{$idMood}}").val() == "") {
          $('.actionMain{{$idMood}}').show();
          return;
      }
        $('.actionMain{{$idMood}}').hide();
        var val = $.trim($("#hideActions{{$idMood}}").val());
        val = ".actionMain{{$idMood}}:contains("+val+")";
        $( val ).show();
      
    });
    $( ".message{{$idMood}}" ).prop( "disabled", true );
});




</script>