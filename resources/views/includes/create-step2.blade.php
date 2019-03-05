@if($errors->has())
   @foreach ($errors->all() as $error)
      <div class="alert alert-danger">{{ $error }}</div>
  @endforeach
@endif

<div class="row">
    <div class="col-md-12">
        <h1>Tournamet: {{ $tournamet }}</h1>
        <h3>Shots: {{ $shots }}</h3>
    </div>
</div>

<h2>Fill in the final score!</h2>
<form id="form_step2">
  <input type="hidden" value="{{ Session::token() }}" name="_token"/>
  <input type="hidden" value="{{ $type }}" name="type"/>
  <input type="hidden" value="{{ $shots }}" name="shots"/>
     <div class="list-group">
        @foreach ($players as $player)
            @if(in_array($player->id_players, $participants))
                <div class="row list-group-item">
                    <div class="col-md-3">
                        <input type="hidden" value="{{ $player->id_players }}" name="player_{{ $player->id_players }}"/>
                        <h2>{{ $player->name }}</h2>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                          <label for="single_{{ $player->id_players }}">Single:</label>
                          <select class="form-control" id="single_{{ $player->id_players }}" name="single_{{ $player->id_players }}">
                            <option>0</option>
                            <option>1</option>
                            <option>2</option>
                          </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                          <label for="two_{{ $player->id_players }}">Two:</label>
                          <select class="form-control" id="two_{{ $player->id_players }}" name="two_{{ $player->id_players }}">
                            <option>0</option>
                            <option>1</option>
                          </select>
                        </div>
                    </div>
                    <!--
                    <div class="col-md-3">
                        <div class="form-group">
                          <label for="three_{{ $player->id_players }}">Three:</label>
                          <select class="form-control" id="three_{{ $player->id_players }}" name="three_{{ $player->id_players }}" disabled="disabled">
                            <option>0</option>
                            <option>1</option>
                          </select>
                        </div>
                    </div>
                    -->
                </div>
            @endif
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary" id="step2">Submit!</button>
            <a class="btn" href="javascript:void(0);" onclick="$('#create').trigger('click');return false">Go back!</a>
        </div>
    </div>
</form>
<script type="text/javascript">initSetp2();</script>