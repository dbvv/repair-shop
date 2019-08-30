<form action="">
    <div class="input-group mb-3">
      <input type="text" name="search" class="form-control" placeholder="{{ __('nomenclature.search') }}" aria-label="{{ __('nomenclature.search') }}" aria-describedby="button-addon2" value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}">
      <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
          <i class="fa fa-search"></i>
        </button>
      </div>
    </div>
    @if(isset($completed))
      <label for="completed">
        <input type="radio" id="completed" name="completed" value="on" {{ isset($_GET['completed']) && $_GET['completed'] === 'on' ? 'checked="checked"' : '' }}>
        {{__('order.completed')}}
      </label>
      <label for="notcompleted">
        <input type="radio" id="notcompleted" name="completed" value="off" {{ isset($_GET['completed']) && $_GET['completed'] === 'off' ? 'checked="checked"' : '' }}>
        {{__('order.not-completed')}}
      </label>
    @endif
</form>