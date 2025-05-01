<div class="main-drugs-sum">
                    @if (count($listSubstance) > 0 )
                        <div class='main-drugs-sum-over'>
                            <table class="table">
                                @foreach ($listSubstance as $list)
                                    @if ($loop->index % 2 == 0)
                                        <tr class="main-drugs-sum-table-1">
                                    @else
                                        <tr  class="main-drugs-sum-table-0">
                                    @endif

                                            <td>{{$list->name}} </td>
                                        
                                        @if ($list->type == 4 or $list->type ==5 )
                                            <td>{{round($list->portions / $list->count,2)}}  {{\App\Http\Services\Common::showDoseProductSubstance($list->type)}}</td>
                                        @else
                                            <td>{{$list->portions}} {{\App\Http\Services\Common::showDoseProductSubstance($list->type)}}</td>
                                        @endif
                                        </tr>
                                @endforeach
                            </table>
                        </div>
                    @else
                        <div class="main-sum-error">
                            Nie było żadnych leków dla tego dnia
                        </div>
                    @endif
                
            </div>