<div class="main-drugs-average-hour">
    <div class="main-drugs-average-hour-one">
        Godz od <input type="time" id="hourFrom{{$id}}" placeholder="Od początku" class="form-control">
    </div>
    
    <div class="main-drugs-average-hour-one">
        Godz do <input type="time" id="hourTo{{$id}}" placeholder="do końca" class="form-control">
    </div>
    wybierz substancje 
</div>

<select id='averageType{{$id}}' class='form-control' onchange="loadAverage('{{ route('ajax.sumAverage')}}',{{$id}})">
    <option value="" selected></option>
    <optgroup label="Produkty">
    @foreach ($productName as $list)
      
        <option value="1_{{$list->id_products}}" >dla {{$list->nameProducts}}</option>
      
    @endforeach
    </optgroup>
    <optgroup label="Substancje">
    @foreach ($allSubstance as $list)
      
        <option value="2_{{$list->id_substances}}" >dla {{$list->nameSubstances}}</option>
      
    @endforeach
    </optgroup>
    @if ($Equivalent != null) 
      <optgroup label="Benzodiazepiny">
        <option value="3_{{$Equivalent}}" >Równoważnik diazepamu 10 mg</option>
      </optgroup>
    @endif
</select>

<div id="sumAverage{{$id}}">

</div>