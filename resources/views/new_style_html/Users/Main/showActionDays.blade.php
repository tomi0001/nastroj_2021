
        <table class="table main-action-table">
          
                            <thead>
                <tr class="main-action-tr-bold">
                    <td class="  main-center" style="width: 50%; border-right-style: hidden;" colspan="1" >
                        nazwa
                    </td>
                    <td colspan="2">
                        
                    </td>
                    <td class="  main-center" style="width: 40%;">
                        godzina
                    </td>
                    <td class="  main-center" style="width: 10%;">
                        poziom przyjemności
                    </td>

                    
                </tr>
                </thead>
                
               
                @foreach ($actionForDay as $list)
                    <tr id="tractionId{{$list->id}}">
                        <td  class="main-center">
                            <div class='main-action-position leveAction{{\App\Http\Services\Common::setColorPleasure($list->level_pleasure)}}' id="editActionDay{{$list->id}}">{{$list->name}}
                       
                            </div>
                        </td>
                        <td class=" main-center">
                            <div>
                                <a id="deleteActionDayButton{{$list->id}}" onclick="deleteActionDay('{{route('ajax.deleteActionDay')}}',{{$list->id}})"><button class="btn btn-danger btn-lg">USUŃ</button></a>
                                <a id="updateActionDayButton{{$list->id}}" onclick="updateActionDay('{{route('ajax.updateActionDay')}}',{{$list->id}})" style="display: none;"><button class="btn btn-primary btn-lg">UAKTUALNIJ</button></a>
                            </div>
                        </td>
                        <td class="main-center">
                            <div>
                                <a  id="cancelActionDayButton{{$list->id}}" onclick="cancelActionDay('{{route('ajax.cancelActionDay')}}',{{$list->id}})" style="display: none;"><button class="btn btn-info btn-lg">ANULUJ</button></a>
                                <a  id="editActionDayButton{{$list->id}}" onclick="editActionDay('{{route('ajax.editActionDay')}}',{{$list->id}},{{$list->idAction}})" ><button class="btn btn-primary btn-lg">EDYTUJ</button></a>
                            </div>
                        </td>
                        <td  class="main-center  ">
                            {{substr($list->date,11,-3)}}
                        </td>
                        <td  class=" main-center">
                            {{$list->level_pleasure}}
                        </td>
                    </tr>
                    
                    
                @endforeach
                
        </table>
    