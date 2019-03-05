@if($errors->has())
   @foreach ($errors->all() as $error)
      <div class="alert alert-danger">{{ $error }}</div>
  @endforeach
@endif

<h1>New competition!</h1>
<div class="row">
    <div class="col-md-12">
        <form id="form_step1">
          <input type="hidden" value="{{ Session::token() }}" name="_token"/>
            <div class="form-group">
              <label for="type">Select tournamet type:</label>
              <select class="form-control" name="type">
                <option>Select option</option>
                <option value="2" {{ old('type') == 2 ? "selected" : null }} >Relampago</option>
                <option value="1" {{ old('type') == 1 ? "selected" : null }} >Master</option>
              </select>
            </div> 
            <div class="form-group">
              <label for="shots">Shots:</label>
              <select class="form-control" name="shots">
                <!--<option value="0">Undefined</option>-->
                <option value="3" selected="selected">3</option>
                <!--<option value="5">5</option>-->
              </select>
            </div>
            <label for="participants">Select participants:</label>
            <div class="form-group">
              @foreach ($players as $player)
                  <label class="btn btn-primary"><input type="checkbox" value="{{ $player->id_players }}" name="participants[]">{{ $player->name }}</label>
              @endforeach
            </div>
            <button type="button" class="btn" id="step1">Go to step 2</button>
            <a class="btn" href="/">Go home!</a>
        </form>
    </div>
</div>
<script type="text/javascript">initSetp1();</script>