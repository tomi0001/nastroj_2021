<select id='averageType{{$id}}' class='form-control' onchange="loadAverage('{{ route('ajax.sumAverage')}}',{{$id}})">
    <option value="" selected></option>
    @foreach ($productName as $list)
        <option value="0_{{$list->id_products}}" >dla Wspólnych substancji</option>
        <option value="1_{{$list->id_products}}" >dla {{$list->nameProducts}}</option>

    @endforeach
    
    @foreach ($allSubstance as $list)
        
        <option value="2_{{$list->id_substances}}" >dla {{$list->nameSubstances}}</option>

    @endforeach
</select>

<div id="sumAverage{{$id}}">

</div>