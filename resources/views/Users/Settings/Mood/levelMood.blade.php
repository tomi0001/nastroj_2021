        <div class="titleMoodSettings">
                        POZIOMY NASTROJU
        </div>
<div class="bodyPage">
    <form method="get" id='formlevelMoodSubmit'>
        <table class="table">
            <tr>
                <td style='width: 5px;'>
                    {{$i++}}
                </td>
                <td class="tdColorMood">
                   Wartośc nastroju od do przy której czujesz myśli samobójcze i totalną depresję
                </td>
                <td>
                    <input type="text" name="valueMood-10From" class="form-control" value="{{$arrayLevel[0]["from"]}}">
                </td>
                <td class="tdColorMood">
                    Do
                </td>
                <td>
                    <input type="text" name="valueMood-10To" class="form-control" value="{{$arrayLevel[0]["to"]}}">
                </td>

            </tr>
            <tr>
                <td style='width: 5px;'>
                    {{$i++}}
                </td>
                <td class="tdColorMood">
                    Wartośc nastroju od do przy której czujesz myśli samobójcze i totalną depresję, ale trochę mniejsze
                </td>
                <td>
                    <input type="text" name="valueMood-9From" class="form-control" value="{{$arrayLevel[1]["from"]}}">
                </td>
                <td class="tdColorMood">
                    Do
                </td>
                <td>
                    <input type="text" name="valueMood-9To" class="form-control" value="{{$arrayLevel[1]["to"]}}">
                </td>

            </tr>
            <tr>
                <td style='width: 5px;'>
                    {{$i++}}
                </td>
                <td class="tdColorMood">
                    Wartośc nastroju od do przy której czujesz myśli rezygnacyjne i totalną depresję
                </td>
                <td>
                    <input type="text" name="valueMood-8From" class="form-control" value="{{$arrayLevel[2]["from"]}}">
                </td>
                <td class="tdColorMood">
                    Do
                </td>
                <td>
                    <input type="text" name="valueMood-8To" class="form-control" value="{{$arrayLevel[2]["to"]}}">
                </td>

            </tr>
                        <tr>
                            <td style='width: 5px;'>
                    {{$i++}}
                </td>
                <td class="tdColorMood">
                  Wartośc nastroju od do przy której czujesz myśli rezygnacyjne i totalną depresję, ale trochę mniejsze
                </td>
                <td>
                    <input type="text" name="valueMood-7From" class="form-control" value="{{$arrayLevel[3]["from"]}}">
                </td>
                <td class="tdColorMood">
                    Do
                </td>
                <td>
                    <input type="text" name="valueMood-7To" class="form-control" value="{{$arrayLevel[3]["to"]}}">
                </td>

                        </tr>
                        <tr>
                            <td style='width: 5px;'>
                    {{$i++}}
                </td>
                <td class="tdColorMood">
                  Wartośc nastroju od do przy której czujesz myśli rezygnacyjne i totalną depresję
                </td>
                <td>
                    <input type="text" name="valueMood-6From" class="form-control" value="{{$arrayLevel[4]["from"]}}">
                </td>
                <td class="tdColorMood">
                    Do
                </td>
                <td>
                    <input type="text" name="valueMood-6To" class="form-control" value="{{$arrayLevel[4]["to"]}}">
                </td>

                        </tr>

                        <tr>
                            <td style='width: 5px;'>
                    {{$i++}}
                </td>
                <td class="tdColorMood">
                   Wartośc nastroju od do przy której czujesz myśli rezygnacyjne i umiarkowną depresję
                </td>
                <td>
                    <input type="text" name="valueMood-5From" class="form-control" value="{{$arrayLevel[5]["from"]}}">
                </td>
                <td class="tdColorMood">
                    Do
                </td>
                <td>
                    <input type="text" name="valueMood-5To" class="form-control" value="{{$arrayLevel[5]["to"]}}">
                </td>

            </tr>
                        <tr>
                            <td style='width: 5px;'>
                    {{$i++}}
                </td>
                <td class="tdColorMood">
                 Wartośc nastroju od do przy której czujesz myśli lekką depresję
                </td>
                <td>
                    <input type="text" name="valueMood-4From" class="form-control" value="{{$arrayLevel[6]["from"]}}">
                </td>
                <td class="tdColorMood">
                    Do
                </td>
                <td>
                    <input type="text" name="valueMood-4To" class="form-control" value="{{$arrayLevel[6]["to"]}}">
                </td>

            </tr>
                        <tr>
                            <td style='width: 5px;'>
                    {{$i++}}
                </td>
                <td class="tdColorMood">
             Wartośc nastroju od do przy której czujesz lekkie obniżenie nastroju
                </td>
                <td>
                    <input type="text" name="valueMood-3From" class="form-control" value="{{$arrayLevel[7]["from"]}}">
                </td>
                <td class="tdColorMood">
                    Do
                </td>
                <td>
                    <input type="text" name="valueMood-3To" class="form-control" value="{{$arrayLevel[7]["to"]}}">
                </td>

            </tr>
                        <tr>
                            <td style='width: 5px;'>
                    {{$i++}}
                </td>
                <td class="tdColorMood">
             Wartośc nastroju od do przy której czujesz myśli chandre
                </td>
                <td>
                    <input type="text" name="valueMood-2From" class="form-control" value="{{$arrayLevel[8]["from"]}}">
                </td>
                <td class="tdColorMood">
                    Do
                </td>
                <td>
                    <input type="text" name="valueMood-2To" class="form-control" value="{{$arrayLevel[8]["to"]}}">
                </td>

            </tr>
                        <tr>
                            <td style='width: 5px;'>
                    {{$i++}}
                </td>
                <td class="tdColorMood">
  Wartośc nastroju od do przy której czujesz myśli lzejszą handrę
                </td>
                <td>
                    <input type="text" name="valueMood-1From" class="form-control" value="{{$arrayLevel[9]["from"]}}">
                </td>
                <td class="tdColorMood">
                    Do
                </td>
                <td>
                    <input type="text" name="valueMood-1To" class="form-control" value="{{$arrayLevel[9]["to"]}}">
                </td>

            </tr>
                        <tr>
                            <td style='width: 5px;'>
                    {{$i++}}
                </td>
                <td class="tdColorMood">
            Wartośc nastroju od do przy której czujesz się normalnie
                </td>
                <td>
                    <input type="text" name="valueMood0From" class="form-control" value="{{$arrayLevel[10]["from"]}}">
                </td>
                <td class="tdColorMood">
                    Do
                </td>
                <td>
                    <input type="text" name="valueMood0To" class="form-control" value="{{$arrayLevel[10]["to"]}}">
                </td>

            </tr>
                        <tr>
                            <td style='width: 5px;'>
                    {{$i++}}
                </td>
                <td class="tdColorMood">
              Wartośc nastroju od do przy której czujesz się trochę lepiej
                </td>
                <td>
                    <input type="text" name="valueMood1From" class="form-control" value="{{$arrayLevel[11]["from"]}}">
                </td>
                <td class="tdColorMood">
                    Do
                </td>
                <td>
                    <input type="text" name="valueMood1To" class="form-control" value="{{$arrayLevel[11]["to"]}}">
                </td>

            </tr>
                        <tr>
                            <td style='width: 5px;'>
                    {{$i++}}
                </td>
                <td class="tdColorMood">
            Wartośc nastroju od do przy której czujesz, że masz nastrój lekko podwyższony
                </td>
                <td>
                    <input type="text" name="valueMood2From" class="form-control" value="{{$arrayLevel[12]["from"]}}">
                </td>
                <td class="tdColorMood">
                    Do
                </td>
                <td>
                    <input type="text" name="valueMood2To" class="form-control" value="{{$arrayLevel[12]["to"]}}">
                </td>

            </tr>
                        <tr>
                            <td style='width: 5px;'>
                    {{$i++}}
                </td>
                <td class="tdColorMood">
           Wartośc nastroju od do przy której czujesz, że masz nastrój jeszcze bardziej podwyższony
                </td>
                <td>
                    <input type="text" name="valueMood3From" class="form-control" value="{{$arrayLevel[13]["from"]}}">
                </td>
                <td class="tdColorMood">
                    Do
                </td>
                <td>
                    <input type="text" name="valueMood3To" class="form-control" value="{{$arrayLevel[13]["to"]}}">
                </td>

            </tr>
                        <tr>
                            <td style='width: 5px;'>
                    {{$i++}}
                </td>
                <td class="tdColorMood">
       Wartośc nastroju od do przy której czujesz, że masz lekką hipomanię
                </td>
                <td>
                    <input type="text" name="valueMood4From" class="form-control" value="{{$arrayLevel[14]["from"]}}">
                </td>
                <td class="tdColorMood">
                    Do
                </td>
                <td>
                    <input type="text" name="valueMood4To" class="form-control" value="{{$arrayLevel[14]["to"]}}">
                </td>

            </tr>
                        <tr>
                            <td style='width: 5px;'>
                    {{$i++}}
                </td>
                <td class="tdColorMood">
           Wartośc nastroju od do przy której czujesz, że masz hipomanię
                </td>
                <td>
                    <input type="text" name="valueMood5From" class="form-control" value="{{$arrayLevel[15]["from"]}}">
                </td>
                <td class="tdColorMood">
                    Do
                </td>
                <td>
                    <input type="text" name="valueMood5To" class="form-control" value="{{$arrayLevel[15]["to"]}}">
                </td>

            </tr>
                        <tr>
                            <td style='width: 5px;'>
                    {{$i++}}
                </td>
                <td class="tdColorMood">
       Wartośc nastroju od do przy której czujesz, że masz większą hipomanię
                </td>
                <td>
                    <input type="text" name="valueMood6From" class="form-control" value="{{$arrayLevel[16]["from"]}}">
                </td>
                <td class="tdColorMood">
                    Do
                </td>
                <td>
                    <input type="text" name="valueMood6To" class="form-control" value="{{$arrayLevel[16]["to"]}}">
                </td>

            </tr>
                        <tr>
                            <td style='width: 5px;'>
                    {{$i++}}
                </td>
                <td class="tdColorMood">
    Wartośc nastroju od do przy której czujesz, że masz lekką manię
                </td>
                <td>
                    <input type="text" name="valueMood7From" class="form-control" value="{{$arrayLevel[17]["from"]}}">
                </td>
                <td class="tdColorMood">
                    Do
                </td>
                <td>
                    <input type="text" name="valueMood7To" class="form-control" value="{{$arrayLevel[17]["to"]}}">
                </td>

            </tr>
                                    <tr>
                                        <td style='width: 5px;'>
                    {{$i++}}
                </td>
                <td class="tdColorMood">
       Wartośc nastroju od do przy której czujesz, że masz manię
                </td>
                <td>
                    <input type="text" name="valueMood8From" class="form-control" value="{{$arrayLevel[18]["from"]}}">
                </td>
                <td class="tdColorMood">
                    Do
                </td>
                <td>
                    <input type="text" name="valueMood8To" class="form-control" value="{{$arrayLevel[18]["to"]}}">
                </td>

            </tr>
                                    <tr>
                                        <td style='width: 5px;'>
                    {{$i++}}
                </td>
                <td class="tdColorMood">
      Wartośc nastroju od do przy której czujesz, że masz silniejszą manię
                </td>
                <td>
                    <input type="text" name="valueMood9From" class="form-control" value="{{$arrayLevel[19]["from"]}}">
                </td>
                <td class="tdColorMood">
                    Do
                </td>
                <td>
                    <input type="text" name="valueMood9To" class="form-control" value="{{$arrayLevel[19]["to"]}}">
                </td>

            </tr>
                                    <tr>
                                        <td style='width: 5px;'>
                    {{$i++}}
                </td>
                <td class="tdColorMood">
       Wartośc nastroju od do przy której czujesz, że masz bardzo silną manię	

                </td>
                <td>
                    <input type="text" name="valueMood10From" class="form-control" value="{{$arrayLevel[20]["from"]}}">
                </td>
                <td class="tdColorMood">
                    Do
                </td>
                <td>
                    <input type="text" name="valueMood10To" class="form-control" value="{{$arrayLevel[20]["to"]}}">
                </td>

            </tr>
            <tr>
                <td colspan="5"  class="center">
                    <input type="button" class="btn-mood main mood" onclick="levelMoodSubmit()" value='EDYTUJ'>
                </td>
            </tr>
            <tr>
                <td colspan="5" class='center'>
                    <div id='levelMoodSubmit' class=' center ajaxMessage'>

                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>