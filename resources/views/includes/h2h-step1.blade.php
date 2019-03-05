@if($errors->has())
   @foreach ($errors->all() as $error)
      <div class="alert alert-danger">{{ $error }}</div>
  @endforeach
@endif

<h1>Players comparison!</h1>
<div class="row">
    <div class="col-md-12">
        <form id="form_h2h-step1">
          <input type="hidden" value="{{ Session::token() }}" name="_token"/>
            <label for="participants">Select players:</label>
            <div class="form-group">
              @foreach ($players as $player)
                  <label class="btn btn-primary"><input type="checkbox" value="{{ $player->id_players }}" name="participants[]">{{ $player->name }}</label>
              @endforeach
            </div>
            <button type="button" class="btn" id="h2h-step2">Go to step 2</button>
            <a class="btn" href="/">Go home!</a>
        </form>
    </div>
</div>
<script type="text/javascript">initH2hSetp1();</script>