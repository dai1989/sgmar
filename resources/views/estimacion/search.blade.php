{!! Form::open(array('url'=>'estimacion', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search')) !!}

<div class="form-group">
	<div class="input-group">
		<input type="text" class="form-control datepicker" name="searchText"  placeholder="Buscar..." value="{{$searchText}}">
		<span class="input-group-btn">
			<button class="btn btn-primary">Buscar</button>
		</span>
	</div>
</div>

{{Form::close()}}
