@if ($message = Session::get('success'))
  <div class="bg-blue-100 border border-blue-500 text-blue-700 px-4 py-3" role="alert">
    <!-- <p class="font-bold">Informational message</p> -->
    <p class="text-sm">{{ $message }}</p>
  </div>
@endif



@if ($message = Session::get('error'))

<div class="alert alert-danger alert-block">

	<button type="button" class="close" data-dismiss="alert">×</button>

        <strong>{{ $message }}</strong>

</div>

@endif



@if ($message = Session::get('warning'))

<div class="alert alert-warning alert-block">

	<button type="button" class="close" data-dismiss="alert">×</button>

	<strong>{{ $message }}</strong>

</div>

@endif



@if ($message = Session::get('info'))

<div class="alert alert-info alert-block">

	<button type="button" class="close" data-dismiss="alert">×</button>

	<strong>{{ $message }}</strong>

</div>

@endif



@if ($errors->any())

<div class="alert alert-danger">

	<button type="button" class="close" data-dismiss="alert">×</button>

	Please check the form below for errors

</div>

@endif

