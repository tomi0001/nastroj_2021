<div id="showdrugs"  style="display: none;" class="main-drugs-show">
              
            
@foreach ($listDrugs as $list)

          
                <div id="drugsClass{{$list->id}}" class="main-drugs-show-single">
                    <div class="main-drugs-show-single-left">
                        <span class="font-mood-span">nazwa: </span>  {{$list->name}} <br>
                        <span class="font-mood-span">dawka: </span> {{$list->portions}} {{\App\Http\Services\Common::showDoseProduct($list->type)}} <br>
                        <span class="font-mood-span">godzina wzięcia: </span> {{substr($list->date,11,-3)}} <br>
                        <span class="font-mood-span">ile kosztowało: </span>  {{$list->price}} zł <br>
                          <br>
                   
                    </div>
                    <div class="main-drugs-show-single-center">
                                    <div class="main-mood-show-single-button">
                                         @if ((\App\Models\Usee::ifDescriptionDrugs($list->id,Auth::User()->id) ) > 0)
                                            <button class="btn btn-warning btn-lg" onclick="showDescriptionDrugs('{{ route('ajax.showDescriptionDrugs')}}',{{$list->id}})">pokaż opis</button>
                                        @else
                                            <button type="button" class="disable btn btn-lg btn-outline-dark "  disabled>nie było opisu</button>
                                        @endif
                                    </div>
                                        
                                    <div class="main-mood-show-single-button">
                                        <button class="btn btn-warning btn-lg" onclick="addDescriptionDrugs({{$list->id}})">dodaj opis</button>
                                    </div>
                                        
                                    <div class="main-mood-show-single-button">
                                        <button class="btn btn-success btn-lg" onclick="showAverage({{$list->id}},'{{ route('ajax.showAverage')}}')">oblicz średnią</button>
                                    </div>
                                        
                                    <div class="main-mood-show-single-button">
                                        <button class="btn btn-danger btn-lg" onclick="deleteDrugs('{{route("ajax.deleteDrugs")}}',{{$list->id}})">usuń produkt</button>
                                            
                                    </div>
                                    <div class="main-mood-show-single-button">
                                        <button class="btn btn-success btn-lg" onclick="editDrugs({{$list->id}})">edytuj wpis</button>
                                            
                                    </div>
                                    <div class="main-mood-show-single-button">
                                        <button class="btn btn-success btn-lg" onclick="showSubstanceProduct({{$list->id}})">pokaż substancje</button>
                                            
                                    </div>

                                    
                    </div>
                    <div class="main-drugs-show-single-right">
                        <div  class="main-mood-show-hidden descriptionShowMood{{$list->id}}">

                            <div id="messageDescriptionshowDrugs{{$list->id}}" class="main-mood-show-description" style="display: none;"></div>
                            <div id="showAverage{{$list->id}}"   style="display: none;"></div>
                            <div id="messagedrugsShow{{$list->id}}" class="main-mood-show-drugs"  style="display: none;"></div>
                            <div id="descriptionAdd{{$list->id}}" class="main-mood-show-description-edit" style="display: none;">
                                <textarea id="descriptionDrugsFormEdit{{$list->id}}" class="main-mood-show-description-edit-form"></textarea><br>
                                <button class="btn btn-warning btn-lg" onclick="addDescriptionDrugsSubmit('{{route('ajax.addDescriptionDrugs')}}',{{$list->id}})">Dodaj</button>
                                <div id="descriptionDrugsForm{{$list->id}}"></div>
                            </div>
                            <div id="editDrugs{{$list->id}}" class="main-drugs-edit" style="display: none;">
                                <div class="main-mood-edit-2">
                                    <table class="table">
                                        <tr>
                                            <td class="main-drugs-edit-td"><span class="font-mood-span">produkt: </span> </td>
                                            <td> 
                                                <select id='nameProductEdit{{$list->id}}' class="form-control"  >
                                                    <option value="" class="form-control"></option>
                                                    @foreach (\App\Models\Product::selectProduct() as $listDrugsEdit)
                                                        @if ($list->products_id == $listDrugsEdit->id)
                                                            <option value="{{$listDrugsEdit->id}}" class="form-control" selected>{{$listDrugsEdit->name}}</option>
                                                        @else
                                                            <option value="{{$listDrugsEdit->id}}" class="form-control">{{$listDrugsEdit->name}}</option>
                                                        @endif
                                                        
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="main-drugs-edit-td"><span class="font-mood-span">dawka: </span>  </td><td> <input type="number" id="doseEdit{{$list->id}}" step="0.01" value="{{$list->portions}}" class="form-control"> </td>
                                        </tr>                                            
                                        <tr>
                                            <td class="main-drugs-edit-td">
                                            <span class="font-mood-span">data wzięcia: </span>  </td><td> <input type="date" id="dateDrugsEdit{{$list->id}}" value="{{substr($list->date,0,10)}}" class="form-control"> </td>
                                        </tr>
                                        <tr>
                                            <td class="main-drugs-edit-td">
                                            <span class="font-mood-span">godzina wzięcia: </span>  </td><td>  <input type="time" id="timeDrugsEdit{{$list->id}}" value="{{substr($list->date,11,-3)}}" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"  class="main-mood-edit">
                                            <button class="btn btn-warning btn-lg" onclick="updateDrugs('{{route('ajax.updateDrugs')}}',{{$list->id}})">modyfikuj</button>
                                            <div id="messageUpdateDrugs{{$list->id}}"></div></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                           
                            <div id="substanceDrugsShow{{$list->id}}" class="main-mood-show-drugs" style="display: none;">

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

                                                                    @foreach (\App\Models\Substances_product::showSubstance($list->products_id) as $list2)
                                                                    @if ($loop->index % 2 == 0)
                                                            <tr class="main-drugs-sum-table-1">
                                                @else
                                                            <tr  class="main-drugs-sum-table-0">
                                                @endif
                                                @php
                                                                            $tmp = \App\Models\Usee::showDosePruduct($list->id,$list2->id,Auth::User()->id);
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
                                                                    
                                                                    @if (count(\App\Models\Substances_product::showSubstance($list->products_id)) == 0)
                                                                        <span class="warning">Nie było żadnych substancji</span>
                                                                    @endif
                                        </table>
                                                                    </div>
                                                                </div>



                            </div>

                                                           
                                                            

                </div>
                </div>
            </div>
           
             
             <div class="main-drugs-show-single-br"></div>
     
            @endforeach
</div>