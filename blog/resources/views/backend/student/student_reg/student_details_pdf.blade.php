<!DOCTYPE html>
<html>
<head>
	<title>Student Detail Info</title>
	<style type="text/css">
		table{
			border-collapse: collapse;
		}
		h2 h3{
			margin: 0;
			padding: 0;
		}
		.table{
			width: 100%;
			margin-bottom: 1rem;
			background-color: transparent;
		}
		.table th,
		.table td{
			padding: 0.75rem;
			vertical-align: top;
			border-top: 1px solid #dee2e6;
		}
		.table thead th{
			vertical-align: bottom;
			border-bottom: 2px solid #dee2e6;
		}
		.table tbody+tbody{
			border-top: 2px solid #dee2e6;
		}
		.table .table{
			background-color: #fff;
		}
		.table-bordered{
			border: 1px solid #dee2e6;
		}
		.table-bordered th,
		.table-bordered td{
			border: 1px solid #dee2e6;
		}
		.table-bordered thead th,
		.table-bordered thead td{
			border-bottom-width: 2px;
		}
		.text-center{
			text-align: center;
		}
		.text-right{
			text-align: right;
		}
		table tr td{
			padding: 5px;
		}
		.table-bordered thead th,.table-bordered th,.table-bordered th{
			border:1px solid black !important;
		}
		.table-bordered thead th{
			background-color: #cacaca;
		}


	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<table width="80%">
					<tr>
						<td width="33%" class="text-center"> <img src="" style="height: 100px;width:100px"> </td>
						<td>
							<h4><strong>name</strong></h4>
							<h4><strong>name</strong></h4>
							<h4><strong>name</strong></h4>
						</td>
						<td class="text-center"><img src="" style="height: 100px;width:100px"></td>
					</tr>
				</table>
			</div>
			<div class="col-md-12 text-center">
				<h5 style="font-weight: bold;padding-top: -25px">Student Details Information</h5>
			</div>
			<div class="col-md-12">
				<table border="1" width="100%">
					<tbody>
						<tr>
							<td style="width: 50%">Student Name</td>
							<td>{{ $details->student->name }}</td>
						</tr>
						<tr>
							<td style="width: 50%">Student Name</td>
							<td>shohag</td>
						</tr>
						<tr>
							<td style="width: 50%">Student Name</td>
							<td>shohag</td>
						</tr>
						<tr>
							<td style="width: 50%">Student Name</td>
							<td>shohag</td>
						</tr>
						<tr>
							<td style="width: 50%">Student Name</td>
							<td>shohag</td>
						</tr>
						<tr>
							<td style="width: 50%">Student Name</td>
							<td>shohag</td>
						</tr>
						<tr>
							<td style="width: 50%">Student Name</td>
							<td>shohag</td>
						</tr>
						<tr>
							<td style="width: 50%">Student Name</td>
							<td>shohag</td>
						</tr>
					</tbody>
				</table>
				<i style="font-size: 10px; float: right;">Print Date:{{date("d M y")}}</i>
			</div>
		</div><br/>
		<div class="col-md-12">
			<table border="0" width="100%">
				<tbody>
					<tr>
						<td style="width: 30%"></td>
						<td style="width: 30%"></td>
						<td style="width: 40%; text-align: center;">
							<hr style="border: solid 1px; width: 60%; color: #000; margin-bottom: 0px">
							<p style="text-align: center;">Principal/Headmaster</p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

</body>
</html>