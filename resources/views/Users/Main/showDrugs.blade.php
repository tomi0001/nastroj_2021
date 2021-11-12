<div id="showdrugs"  style="display: none;" class="formAddMood borderdrugs">
              <div class='titleMoodShow drugs'>
                            LEKI
              </div>
    
    <table class="drugsShow">
        <thead class="titleTheadDrugs">
                <tr class="bold">
                    <td class=" drugsShow  showdrugs drugsTd"  >
                        nazwa produktu
                    </td>
                    <td class=" drugsShow  showdrugs drugsTd"  >
                        substancje produktu
                    </td>
                    <td class=" drugsShow drugsTd showdrugs">
                        dawka
                    </td>
                    <td class=" drugsShow drugsTd showdrugs">
                        godzina wzięcia
                    </td>
                    <td class=" drugsShow drugsTd showdrugs">
                        ile kosztowało
                    </td>

                    
                </tr>
                </thead>
                <tr>
                    <td colspan="7">
                        <br>
                    </td>
                </tr>
                @foreach ($listDrugs as $list)
                                    <tr>
                    <td class=" drugsShow drugsTd showdrugs"  >
                        {{$list->name}}
                    </td>
                    <td class=" drugsShow drugsTd showdrugs"  >

                        @foreach (\App\Models\Substances_product::showSubstance($list->products_id) as $list2)

                            [{{$list2->name}}] 
                            @if ($loop->index > 3)
                                <a onclick ="showAllSubstance('{{route('ajax.showAllSubctance')}}')">.....</a>
                                @break
                            @endif
                        @endforeach
                        @if (count(\App\Models\Substances_product::showSubstance($list->products_id)) == 0)
                            <span class="warning">Nie było żadnych substancji</span>
                        @endif
                    </td>
                    <td class=" drugsShow drugsTd showdrugs">
                        {{$list->portion}} mg
                    </td>
                    <td class=" drugsShow drugsTd showdrugs">
                        {{substr($list->date,11,-3)}}
                    </td>
                    <td class=" drugsShow drugsTd showdrugs">
                        {{$list->price}} zł
                    </td>


                    
                </tr>
                <tr>
                    <td colspan="7" class="moodButton">
                        <table  class="tableCenter"  >
                            <tr>
                                <td style="padding-right: 7px;">
                                   
                                        <button class="btn-drugs main" onclick="showDrugs("")">pokaż opis</button>
                                    
                                     
                                    
                                </td>
                                <td style="padding-right: 7px;">
                                   
                                        <button class="btn-drugs main" onclick="showDrugs("")">dodaj opis</button>
                                    
                                     
                                    
                                </td>
                                <td style="padding-right: 7px;">
                                   
                                        <button class="btn-drugs main" onclick="showDrugs("")">oblicz średnią</button>
                                    
                                     
                                    
                                </td>
                                <td style="padding-right: 7px;">
                                   
                                        <button class="danger" onclick="showDrugs("")">usuń wpis</button>
                                    
                                     
                                    
                                </td>
                                <td style="padding-right: 7px;">
                                   
                                        <button class="btn-drugs main" onclick="showDrugs("")">edytuj wpis</button>
                                    
                                     
                                    
                                </td>
                            </tr>
                        </table>
                    </td>
                    
                </tr>
                    
                @endforeach
    </table>
</div>