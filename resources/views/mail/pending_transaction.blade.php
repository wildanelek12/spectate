<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo.adminkit.io/pages-blank.html" />

    <title>@yield('title', 'home')</title>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Choose your prefered color scheme -->
    <link href="{{ asset('admin_assets/css/light.css') }}" rel="stylesheet">
    <style>
        .dataTables_empty {
            display: none;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
	<!-- END SETTINGS -->
</head>
<!--
  HOW TO USE: 
  data-theme: default (default), dark, light, colored
  data-layout: fluid (default), boxed
  data-sidebar-position: left (default), right
  data-sidebar-layout: default (default), compact
-->

<body data-theme="default" data-layout="fluid">
	<div class="wrapper">
		<div class="main">
			<main class="content">
				<div class="container-fluid ">

					<h1 class="h3 mb-3">Invoice</h1>

					<div class="row">
						<div class="col-6">
							<div class="card">
								<div class="card-body m-sm-3 m-md-5">
									<div class="mb-4">
										Hello <strong>User</strong>,
										<br />
										Transaksi anda sebesar <strong>Rp.200.0000</strong> untuk tiket masuk spectate telah masuk, silahkan lakukan pembayaran
									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="text-muted">Invoice No.</div>
											<strong>741037024</strong>
										</div>
										<div class="col-md-6 text-md-end">
											<div class="text-muted">Payment Date</div>
											<strong>October 2, 2018 - 03:45 pm</strong>
										</div>
									</div>

									<hr class="my-4" />

									<div class="row mb-4">
										<div class="col-md-6">
											<div class="text-muted">Pembeli</div>
											<strong>
												Charles Hall
											</strong>
											<p>
												0895390169168 <br>
												<a href="#">
													chris.wood@gmail.com
												</a>
											</p>
										</div>
										<div class="col-md-6 text-md-end">
											<div class="text-muted">Pembayaran</div>
											<strong>
												Tiket Spectate
											</strong>
											<p>
												<a href="#">
													spectate.bemftum2022@gmail.com
												</a>
											</p>
										</div>
									</div>

									<table class="table table-sm">
										<thead>
											<tr>
												<th>Description</th>
												<th>Quantity</th>
												<th class="text-end">Amount</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>AdminKit Demo Theme Customization</td>
												<td>2</td>
												<td class="text-end">$150.00</td>
											</tr>
											<tr>
												<td>Monthly Subscription </td>
												<td>3</td>
												<td class="text-end">$25.00</td>
											</tr>
											<tr>
												<td>Additional Service</td>
												<td>1</td>
												<td class="text-end">$100.00</td>
											</tr>
											<tr>
												<th>&nbsp;</th>
												<th>Subtotal </th>
												<th class="text-end">$275.00</th>
											</tr>
											<tr>
												<th>&nbsp;</th>
												<th>Shipping </th>
												<th class="text-end">$8.00</th>
											</tr>
											<tr>
												<th>&nbsp;</th>
												<th>Total </th>
												<th class="text-end">$268.85</th>
											</tr>
										</tbody>
									</table>

									<div class="text-center">
										<p class="text-sm">
											<strong>Extra note:</strong>
											Please send all items at the same time to the shipping address.
											Thanks in advance.
										</p>

										<a href="#" class="btn btn-primary">
											Print this receipt
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

</body>

</html>