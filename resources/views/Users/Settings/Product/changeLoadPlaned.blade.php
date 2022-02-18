<script>

      $(document).ready(function () {
          
      $('select').selectize({
          sortField: 'text'
      });
     
      //$("input[name='pleasure']").prop("disabled",true);
    
  });  

</script>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap-glyphicons.css">
<table class="table">
    @foreach ($listPlaned as $list)
    <tr>
        <td  class="tdColorDrugs">
               pozycja {{$loop->index+1}}
        </td>
        <td>
            <select name="position{{$list->id}}" class="form-control">
                @foreach ($listProduct as $list2)
                    @if ($list2->id == $list->id)
                        <option value="{{$list2->id}}" selected>{{$list2->name}}</option>
                    @else
                        <option value="{{$list2->id}}" >{{$list2->name}}</option>
                    @endif
                @endforeach
            </select>
        </td>
        
        <td>
               <input type="text" name="portion" class="form-control" value="{{$list->portion}}">
        </td>
        <td  class="tdColorDrugs">
            <a href="#" class=" ">
                <div class="minusButton plusMinusButton"> <img width="40" src="{{asset('/image/icon_minus.png')}}"></div>
        </a>
        </td>
    </tr>
    
    @endforeach
</table>