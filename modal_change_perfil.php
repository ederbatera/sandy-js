		<!-- Modal Edição de Perfil-->
		<div class="modal fade" id="modalChangePerfil" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
			aria-labelledby="modalCriaUsuarioLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="modalCriaUsuariosLabel">Alteração de Perfil</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form class="mt-4" action="" id="form-alter-perfil">

							<div class="row">

								<div class="col">
									<div class="form-group">
										<label for="nome_altera_usuario">Nome</label>
										<input type="text" class="form-control" id="nome_altera_usuario"
											name="nome_altera_usuario" placeholder="Nome" value="" required>
											<input type="number" id="id_altera_usuario" name="id_altera_usuario" value="" required hidden>
											<input type="number" id="id_user_change_altera_usuario" name="id_user_change_altera_usuario" value="" required hidden>
									</div>
								</div>

								<div class="col">
									<div class="form-group">
										<label for="cargo_altera_usuario">Cargo</label>
										<input type="text" class="form-control" id="cargo_altera_usuario"
											name="cargo_altera_usuario" placeholder="Cargo" value="" required>
									</div>
								</div>

								<div class="col">
									<div class="form-group">
										<label for="matricula_altera_usuario">Matrícula</label>
										<input type="text" class="form-control" id="matricula_altera_usuario"
											name="matricula_altera_usuario" placeholder="Matrícula" value="" required>
									</div>
								</div>

							</div>

							<div class="row mt-2 mb-2">

								<div class="col">
									<div class="form-group">
										<label for="email_altera_usuario">Email</label>
										<input type="email" class="form-control" id="email_altera_usuario"
											name="email_altera_usuario" placeholder="Email" value="" required>
									</div>
								</div>

								<div class="col">
									<div class="form-group">
										<label for="senha_altera_usuario">Senha (Blank does not change)</label>
										<input type="current-password" class="form-control" id="senha_altera_usuario"
											name="senha_altera_usuario" placeholder="Senha" value="">
									</div>
								</div>
							</div>

							<div class="form-group form-check mt-3">
								<!-- <input type="checkbox" class="form-check-input" id="ativo_altera_usuario" name="ativo_altera_usuario" value="1">
								<label class="form-check-label" for="ativo_altera_usuario">Ativo</label> -->
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" role="switch" id="ativo_altera_usuario" name="ativo_altera_usuario" value="1">
									<label class="form-check-label" for="">Status</label>
								</div>
							</div>
						</form>

						<div class="modal-footer">
							<button type="button" class="btn btn-primary" onclick="alteraPerfil()">Salvar</button>
						</div>
					</div>
				</div>
			</div>
		</div>