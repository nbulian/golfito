<h1>Ranking of {{ date('M', mktime(0, 0, 0, $month, 1)) }} '{{ date('y', mktime(0, 0, 0, 1, 1, $year)) }}</h1>
@if ( $ranking ) 
<p>In case of tie in *Points*, the winner will be defined by a greater number of events *Won* and if the tie persists, it will be defined by the person who executes the least amount of *Shots*.</p>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Name</th>
                    <th>Points</th>
                    <th>Played</th>
                    <th>Shots</th>
                    <th>Single</th>
                    <th>Two</th>
                    <th>Successful</th>
                    <!--<th>Won</th>-->
                    <!--<th>Tie</th>-->
                    <!--<th>Lost</th>-->
                </tr>
            </thead>
        <tbody>
        @foreach ($ranking as $row)
            @php ($i++)
            @if ( $last_score != $row->points)
                @php ($last_score = $row->points)
                @php ($rank = $i)
            @endif
            <tr>
            <td>{{ $rank }}</td>
            <td>{{ $row->name }}</td>
            <td><strong>{{ $row->points }}</strong></td>
            <td>{{ $row->played }}</td>
            <td>{{ $row->shots }}</td>
            <td>{{ $row->single }}</td>
            <td>{{ $row->two }}</td>
            <td>{{ $row->successful }}</td>
            <!--<td>{{ $row->won }}</td>-->
            <!--<td>{{ $row->tie }}</td>-->
            <!--<td>{{ $row->lost }}</td>-->
          </tr>
          @endforeach
        </tbody>
    </table>
</div>
@else
<h2>There wasn't any competition this month.</h2>
@endif

@if ( $ranking_cup ) 
<h1>Ranking of last cup played in {{ date('M', mktime(0, 0, 0, $month, 1)) }} '{{ date('y', mktime(0, 0, 0, 1, 1, $year)) }}</h1>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Name</th>
                <th>Points</th>
                <th>Played</th>
                <th>Shots</th>
                <th>Single</th>
                <th>Two</th>
                <th>Successful</th>
                <!--<th>Won</th>-->
                <!--<th>Tie</th>-->
                <!--<th>Lost</th>-->
            </tr>
        </thead>
        <tbody>
        @foreach ($ranking_cup as $row)
            @php ($a++)
            @if ( $last_score != $row->points)
                @php ($last_score = $row->points)
                @php ($rank = $a)
            @endif
            <tr>
            <td>{{ $rank }}</td>
            <td>{{ $row->name }}</td>
            <td><strong>{{ $row->points }}</strong></td>
            <td>{{ $row->played }}</td>
            <td>{{ $row->shots }}</td>
            <td>{{ $row->single }}</td>
            <td>{{ $row->two }}</td>
            <td>{{ $row->successful }}</td>
            <!--<td>{{ $row->won }}</td>-->
            <!--<td>{{ $row->tie }}</td>-->
            <!--<td>{{ $row->lost }}</td>-->
          </tr>
          @endforeach
        </tbody>
    </table>
</div>
@else
<h2>There wasn't any cup this month.</h2>
@endif

@foreach ($dates as $date)
    <a class="btn" href="dashboard?year={{ $date['year'] }}&month={{ $date['month'] }}">{{ date('F', mktime(0, 0, 0, $date['month'], 1)) }} '
    {{ date('y', mktime(0, 0, 0, 1, 1, $date['year'])) }}</a>
@endforeach
