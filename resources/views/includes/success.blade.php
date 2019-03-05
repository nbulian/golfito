<div class="alert alert-success">
  <strong>Done!</strong> Final results!.
</div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Name</th>
                    <th>Points</th>
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
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<a class="btn" href="/">Go home!</a>