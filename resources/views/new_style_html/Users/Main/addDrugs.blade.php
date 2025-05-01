 @include(str_replace("css","html",Auth::User()->css) . '.Layout.SelectSearch')

<div class=" main-mood-form-add" id="drugs" style="display: none;">
    <br>
    <div class="row">
    <div class='col-md-0 col-lg-2 col-sm-0 col-xs-0'>
        
    </div>
    <div class='col-md-12 col-lg-8 col-sm-12 col-xs-12 '>
        
            <div>
                
                <div class='row '>
                    
                    <div class='col-lg-1 col-md-1 col-xs-0 col-sm-0 '>
                    </div>    
                    <div class='col-lg-10 col-md-10 col-xs-10 col-sm-10'>
                        <form method='get' id="formAddDrugs">
                            <table class='table '>
                                <tr>
                                    <td >
                                        Nazwa produktu
                                    </td>
                                    <td >
                                        <select name='nameProduct' class="form-control" id="select-state" onchange="loadTypePortion('{{route('ajax.loadTypePortion')}}')">
                                            <option value="" class="form-control"></option>
                                            @foreach (\App\Models\Product::selectProduct() as $listProduct)
                                                <option value="{{$listProduct->id}}" class="form-control">{{$listProduct->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td  >
                                        Nazwa zaplanowanej dawki
                                    </td>
                                    <td >
                                         <select name='namePlaned' class="form-control" id="select-state" onchange="valueDose(1)">
                                            <option value="" class="form-control"></option>
                                            @foreach (\App\Models\Planned_drug::selectDose(Auth::User()->id) as $listDose)
                                                <option value="{{$listDose->id}}" class="form-control">{{$listDose->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan='2' style='padding-top: 35px; ' >
                                        Godzina wzięcia
                                    </td>
                                    <td >
                                        <input type='date' name='date' class='form-control'>
                                    </td>
                                </tr>
                                <tr>
                                    <td >
                                         <input type='time' name='time' class='form-control'>
                                    </td>
                                </tr>
                                
                                
                                <tr>
                                    <td >
                                        Dawka
                                    </td>
                                    <td>
                                        <div style='float: left; width: 65%;'>
                                        <input type='number' step="0.01"    name='dose' class='form-control'   min='0' max='1000000'  onkeypress="return submitEnter(event,'{{ route('users.drugsAdd')}}','addDrugs')">
                                        </div>
                                        <div id='typePortion' style='float: left; padding-left: 6%; padding-top: 1%;'></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td  style='padding-top: 9%; ' >
                                        opis spożycia
                                    </td>
                                    <td>
                                        <textarea name='description' class='form-control' rows='7'></textarea>
                                    </td>
                                </tr>


                                <tr>
                                    <td colspan="2" class="main-mood-table-center">
                                        <input type="button" id="buttonDrugsAdd" onclick="addDrugs('{{ route('users.drugsAdd')}}')" class="btn btn-lg btn-success " value="Dodaj lek" >
                                    </td>
                                </tr>    
                                <tr>
                                    <td colspan="2" class="main-mood-table-center">
                                        <div  id="formResultDrugs"></div>
                                    </td>
                                </tr>

                            </table>
                        </form>
                    </div>
                
                </div>

            </div>
        
    </div>
    <div class='col-md-1 col-lg-2'>
        
    </div>
    </div>
</div>