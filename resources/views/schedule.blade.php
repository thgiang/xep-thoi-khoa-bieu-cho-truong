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
                    <td style="height: 30px" @php if (strpos($schedule[$team->name]['TH'.$th]['T'.$t]->subject_name, 'Tin') !== false){echo 'class="tin"';};@endphp>
                        <div>
                            <strong style="display: inline-block">{{$schedule[$team->name]['TH'.$th]['T'.$t]->subject_name}}</strong>
                        </div>
                        <span style="display: inline-block">{{$schedule[$team->name]['TH'.$th]['T'.$t]->teacher_name}}</span>
                    </td>
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
    .tin {
        background: orange;
        color: #FFF;
    }
</style>