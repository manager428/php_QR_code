	<main id="main">
		<div id="preloader"></div>
		<!-- ======= Services Section ======= -->
		<section id="services" class="services">
			<div class="container" data-aos="">

				<div class="section-title">
					<h3 class="qr-title">COMMUNITY PASS</h3>
				</div>

				<div class="row mt-1">
				</div>
			</div>
			<div class="card-body collapse show QRencodorCardBody" aria-labelledby="QRencodorCard" data-parent="#utilitiestab">

				<div class="row">
					<div class="col-md-6 mt-3">
						<div class="thumbnail">
							<div class="card">
								<div class="card-title"><i class="fas fa-qrcode" style="font-size: 18px;"></i> Complete todos los datos para crear código QR</div>
								<div class="card-body">
									<form>
										<div class="form-group">
											<div class="row">

												<div class="col-md-6 mt-3">
													<label class="mb-0">Entrada (De click en el calendario)</label>
													<input type="text" class="form-control datetimepicker check_in form-control" name="check_in">
												</div>

												<div class="col-md-6 mt-3">
													<label class="mb-0">Salida (De click en el calendario)</label>
													<input type="text" class="form-control datetimepicker check_out" name="check_out">
												</div>

												<div class="col-md-12 mt-3">
													<label class="mb-0">Nombre(s) invitado(s)</label>
													<input type="text" class="form-control full_name" name="full_name" placeholder="Escriba nombre(s) completo(s)">
												</div>

												<div class="col-md-12 mt-3">
													<label class="mb-0">Número de personas</label>
													<input type="text" class="form-control number_pax" id="number_pax" name="number_pax" placeholder="Confirmar número de visitantes">
												</div>

												<div class="col-md-12 mt-3">
													<label class="mb-0">Placas</label>
													<input type="text" class="form-control car_plate" name="car_plate" placeholder="Escribir aquí">
												</div>

												<div class="col-md-12 mt-3">
													<label class="mb-0">Modelo de vehiculo</label>
													<input type="text" class="form-control car_model" name="car_model" placeholder="Escribir aquí">
												</div>

												<div class="col-md-12 mt-3">
													<label class="mb-0">Visita tipo o motivo:</label>
													<!--Error correction capability-->
													<select class="form-control visit_reason" name="visit_reason">
														<option value="Familiar">Familiar</option>
														<option value="Amistad">Amistad</option>
														<option value="Plomero">Plomero</option>
														<option value="Electricista">Electricista</option>
														<option value="Jardinero">Jardinero</option>
														<option value="Servicio doméstico">Servicio doméstico</option>
														<option value="Mtto. General">Mtto. General</option>
														<option value="Servicio de comida">Servicio de comida</option>
														<option value="Otro">Otro</option>
													</select>
												</div>
												<div class="col-md-12 mt-3">
													<label class="mb-0">Dirección a donde se dirige</label>
													<input type="text" class="form-control address" name="address" placeholder="Calle, número de casa, privada, torre, número de edificio">
												</div>

												<div class="col-md-12 mt-3">
													<label class="mb-0">Nombre del anfitrión</label>
													<input type="text" class="form-control hostname" name="hostname" placeholder="Usuario que genera el código">
												</div>

												<div class="col-md-12 mt-3 text-center">
													<div class="alert alert-success qre-success"></div>

													<div class="alert alert-danger qre-danger"></div>
												</div>

												<div class="col-md-12 mt-4 text-center">
													<button type="button" class="btn btn-primary qr-creator">Generar código QR</button>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6 mt-3">
						<div class="thumbnail">
							<div class="card">
								<div class="card-title"><i class="fas fa-qrcode" style="font-size: 18px;"></i> Previsualizar y Descargar</div>
								<div class="card-body">
									<form>
										<div class="form-group">
											<div class="row">
												<div class="col-md-12 text-center">
													<div class="alert alert-success qre-success"></div>

													<div class="alert alert-danger qre-danger"></div>
												</div>
												<div class="col-md-12 text-center">
													<div class="qr-wrapper">
														<img src="<?= base_url() ?>assets/img/empty.png" class="qr-img" name="qr-img" style="max-width:250px;" />
													</div>
												</div>

												<div class="col-md-12 mt-4 text-center">
													<a href="images/easyWhois.png" class="btn btn-primary qr_download" download>Descargar QR</a>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
			
		</section><!-- End Services Section -->

	</main><!-- End #main -->