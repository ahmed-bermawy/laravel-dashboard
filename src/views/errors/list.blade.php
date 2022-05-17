@if($errors->any())
<ul class="alert alert-danger">
	@foreach($errors->all() as $error)
		<li>{{ $error }}</li>

	@endforeach
</ul>

@endif

@if(session()->has('success') )
	<h5 class="alert alert-success">{{ session('success') }}</h5>
@endif

@if(session()->has('failed') )
	<h5 class="alert alert-danger">{{ session('failed') }}</h5>
@endif



