<table border="1" style="width: 100%; border-spacing: 0">
    <thead>
    <tr>
        <th>Thứ</th>
        @foreach($teams AS $team)
            <th>{{$team->name}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @for($th = 2; $th <= 7; $th++)
        @for($t = 1; $t <= 5; $t++)
            <tr class="tr{{$th % 2}}">
                @if($t == 1)
                    <td rowspan="5">TH{{$th}}</td>
                @endif
                @foreach($teams AS $team)
                    @if (isset($schedule->{'D'.$th}->{'O'.$t}) && isset($schedule->{'D'.$th}->{'O'.$t}->{$team->name}))
                        <td style="height: 30px" class="@php
                        if (strpos($schedule->{'D'.$th}->{'O'.$t}->{$team->name}->subject->name, 'Tin') !== false)
                        {
                            echo 'tin';
                        };
                        if (strpos($schedule->{'D'.$th}->{'O'.$t}->{$team->name}->subject->name, 'VănKT') !== false)
                        {
                            echo ' van';
                        };
                        if ($schedule->{'D'.$th}->{'O'.$t}->{$team->name}->isTeacherBusy) {
                            echo ' dp';
                        }
                        if ($schedule->{'D'.$th}->{'O'.$t}->{$team->name}->isStatic) {
                            echo ' stt';
                        }
                        @endphp">

                            <div>
                                <strong style="display: inline-block">{{$schedule->{'D'.$th}->{'O'.$t}->{$team->name}->subject->name}}</strong>
                            </div>
                            <span style="display: inline-block">
                            @if(isset($schedule->{'D'.$th}->{'O'.$t}->{$team->name}->teacher->name))
                                    {{$schedule->{'D'.$th}->{'O'.$t}->{$team->name}->teacher->name}}
                                @endif
                        </span>
                        </td>
                    @else
                        <td>-</td>
                    @endif
                @endforeach
            </tr>
        @endfor
    @endfor
    </tbody>
</table>
<style>
    .tr0 {
        background: #EEE;
    }

    .dp {
        background: darkred!important;
        color: #FFF;
    }

    .tin {
        background: orange;
        color: #FFF;
    }
    .stt {
        background: #EEE!important;
        color: #FFF;
    }
    .van {
        background: green;
    }
</style>