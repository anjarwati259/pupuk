<!DOCTYPE html>
<html>
<head>
	<title>get totak sum using jquery</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</head>
<body>
	<hr>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<label class="control-label col-md-2">Amount 1:</label>
				<div class="col-md-4">
					<input type="text" class="form-control input-sm text-right amount" name="">
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-8">
				<label class="control-label col-md-2">Amount 1:</label>
				<div class="col-md-4">
					<input type="text" class="form-control input-sm text-right amount" name="">
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-8">
				<label class="control-label col-md-2">Amount 1:</label>
				<div class="col-md-4">
					<input type="text" class="form-control input-sm text-right amount" name="">
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-8">
				<label class="control-label col-md-2">Amount 1:</label>
				<div class="col-md-4">
					<input type="text" class="form-control input-sm text-right" name="" value="10">
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-8">
				<label class="control-label col-md-2">Total:</label>
				<div class="col-md-4">
					<input type="text" class="form-control input-sm text-right " readonly id="total_amount">
				</div>
			</div>
		</div>
		<br>
	</div>
	<br>
</body>
<script type="text/javascript">
	$(function(){
		//mask
		$('.amount').mask('#,###.##',{reverse : true});

		var total_amount = function(){
			var sum=0;
			$('.amount').each(function(){
				var num = $(this).val().replace(',','');
				if(num != 0){
					sum += parseFloat(num);
				}
			});
			$('#total_amount').val(sum);
		}
		$('.amount').keyup(function(){
			total_amount();
		});
	});
</script>
</html>