<!doctype html>
<html lang="en">
	<head>
		<?php
			$this->load->view('client/includes/header');
		?>
	</head>

	<body>
	<div class="spinner-box" style="display:none;">
		<svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
		</svg>  
	</div>

		<!-- Main Content Wrapper -->
		<div class="main-content d-flex flex-column">
			<?= isset($content)? $content : ""; ?>

			<?php
				$this->load->view('client/includes/footer');
			?>
		</div>
		<!-- End Main Content Wrapper -->
	</body>
</html>