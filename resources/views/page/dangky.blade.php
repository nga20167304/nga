@extends('master')

@section('content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Đăng kí</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="{{route('trang-chu')}}">Home</a> / <span>Đăng kí</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<div class="container">
		<div id="content">
			
			<form action="{{route('signup')}}" method="post" class="beta-form-checkout">
			{!! csrf_field() !!}
				<div class="row">
					<div class="col-sm-3"></div>
					@if(count($errors)>0)
						<div class="alert alert-danger">
							@foreach($errors->all() as $err)
								{{$err}}
							@endforeach
						</div>
					@endif
					@if(Session::has('success')) <div class="alert alert-success">{{Session::get('success')}}</div>
					@endif
					<div class="col-sm-6">
						<h4>Đăng kí</h4>
						<div class="space20">&nbsp;</div>

						<div class="form-block">
							<label for="your_last_name">Fullname*</label>
							<input type="text" id="your_last_name" name="fullname" required>
						</div>

						<div class="form-block">
							<label for="adress">Address*</label>
							<input type="text" id="adress" value="Street Address" name="address" required>
						</div>

						<div class="form-block">
							<label for="email">Email address*</label>
							<input type="email" id="email"  name="emai" required>
						</div>

						<div class="form-block">
							<label for="phone">Phone*</label>
							<input type="text" id="phone"  name="phone" required>
						</div>
						<div class="form-block">
							<label for="phone">Password*</label>
							<input type="password" id="password"  name="password" required>
						</div>
						<div class="form-block">
							<label for="phone">Re password*</label>
							<input type="password" id="re_password"  name="re_password" required>
						</div>
						<div class="form-block">
							<button type="submit" class="btn btn-primary">Register</button>
						</div>
					</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
		</div> <!-- #content -->
    </div> <!-- .container -->
@endsection