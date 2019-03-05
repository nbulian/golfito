@if($errors->has())
   @foreach ($errors->all() as $error)
      <div class="alert alert-danger">{{ $error }}</div>
  @endforeach
@endif

<h1>New player</h1>
<div class="row">
    <div class="col-md-12">
        <form id="form_players_step1">
          <input type="hidden" value="{{ Session::token() }}" name="_token"/>
            <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Enter name of the player" value="{{ old('name') }}">
            </div> 
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="text" class="form-control" name="email" id="email" placeholder="Enter email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
              <label for="is_active">Status:</label>
              <select class="form-control" name="is_active">
                <option value="1" {{ old('is_active') == 1 ? "selected" : null }} >Active</option>
                <option value="0" {{ old('is_active') == 0 ? "selected" : null }} >Inactive</option>
              </select>
            </div>
            <button type="button" class="btn btn-primary" id="create-player">Create</button>
            <a class="btn" href="/">Go home!</a>
        </form>
    </div>
</div>
<script type="text/javascript">initCreatePlayer();</script>