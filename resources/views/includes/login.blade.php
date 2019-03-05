<header><header>

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <br><br><br>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Mini Golf League</h3>
            </div>
            <div class="panel-body">
                <form action="{{ route('authenticate') }}" method="post" role="form">
                    <input type="hidden" value="{{ Session::token() }}" name="_token"/>
                    
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="password" type="password" value="">
                        </div>
                        <!--
                        <div class="checkbox">
                            <label>
                                <input name="remember" type="checkbox" value="Remember Me">Remember Me
                            </label>
                        </div>
                        -->
                        <!-- Change this to a button or input when using this as a form -->
                        <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                    </fieldset>
                </form>
            </div>
            <div class="panel-footer">Golfito Tour {{ date('Y') }}</div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <table class="table table-hover" style="background-image: url('white-wall.jpg');opacity: 0.70;">
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
</div>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel-body">
            <h3 class="panel-title" style="color: white;">HALL OF FAME</h3>
            <p style="color: white;">Diego - 7 / SEP / 2017</p>
        </div>
    </div>
</div>