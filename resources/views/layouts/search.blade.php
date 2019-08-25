<form action="">
    <div class="input-group mb-3">
      <input type="text" name="search" class="form-control" placeholder="{{ __('nomenclature.search') }}" aria-label="{{ __('nomenclature.search') }}" aria-describedby="button-addon2" value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}">
      <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
          <i class="fa fa-search"></i>
        </button>
      </div>
    </div>
</form>