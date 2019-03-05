@if($errors->has())
   @foreach ($errors->all() as $error)
      <div class="alert alert-danger">{{ $error }}</div>
  @endforeach
@endif

<h1>Players</h1>
<div class="row">
    <a class="btn" href="#" id="new-player">Create new player</a>
</div>
<div class="table-responsive">
    <table class="table table-striped">
    		<thead>
    			<tr>
    				<th>ID</th>
    				<th>Name</th>
    				<th>Email</th>
    				<th>Status</th>
    			</tr>
    		</thead>
    		<tbody id="players_table">
        	@foreach ($players as $player)
          	 <tr id="{{$player->id_players}}">
        			<td>{{$player->id_players}}</td>
        			<td>{{$player->name}}</td>
        			<td>{{$player->email}}</td>
        			<td>{{ $player->is_active == 1 ? "Active" : "Inactive" }}</td>
        		</tr>
        	@endforeach
        		</tbody>
        </table>
    </div>
</div>
<div class="row">
    <a class="btn" href="/">Go home!</a>
</div>
<script type="text/javascript">initNewPlayer();</script>