<div class="tab-pane fade" id="usuarios-kv-1" role="tabpanel" aria-labelledby="usuarios-tab">
	<div class="h3 text-center text-warning mb-2" style="margin-top: 25px;">Usuários</div>

	<div class="container" style="margin-bottom: 60px; font-size:12px;">



		<div class="card-body shadow-lg rounded scroll">
			<div class="table-responsive">
				<table class="table table-sm table-hover">
					<thead>
						<tr class="text-dark">
							<th scope="col"></th>
							<th scope="col">NOME</th>
							<th scope="col">EMAIL</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody id="listUsuarios">
					</tbody>
				</table>
			</div>
		</div>


		<p class="text-center mt-3">
			<button class="btn btn-primary" type="button" data-bs-toggle="modal"
				data-bs-target="#modalCriaUsuario">Adicionar usuário</button>
		</p>

		<!-- Modal -->
		<div class="modal fade" id="modalCriaUsuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
			aria-labelledby="modalCriaUsuarioLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="modalCriaUsuariosLabel">Adicionar novo usuário</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form class="mt-4" action="" id="form-add-usuario">

							<div class="row">

								<div class="col">
									<div class="form-group">
										<label for="nome_add_usuario">Nome</label>
										<input type="text" class="form-control" id="nome_add_usuario"
											name="nome_add_usuario" placeholder="Nome" required>
									</div>
								</div>

								<div class="col">
									<div class="form-group">
										<label for="nome_add_usuario">Sobrenome</label>
										<input type="text" class="form-control" id="sobrenome_add_usuario"
											name="sobrenome_add_usuario" placeholder="Sobrenome" required>
									</div>
								</div>

								<div class="col">
									<div class="form-group">
										<label for="cargo_add_usuario">Cargo</label>
										<input type="text" class="form-control" id="cargo_add_usuario"
											name="cargo_add_usuario" placeholder="Cargo" required>
									</div>
								</div>

								<div class="col">
									<div class="form-group">
										<label for="nome_add_usuario">Matrícula</label>
										<input type="text" class="form-control" id="matricula_add_usuario"
											name="matricula_add_usuario" placeholder="Matrícula" required>
									</div>
								</div>

							</div>

							<div class="row mt-2">

								<div class="col">
									<div class="form-group">
										<label for="nome_add_usuario">Email</label>
										<input type="email" class="form-control" id="email_add_usuario"
											name="email_add_usuario" placeholder="Email" required>
									</div>
								</div>

								<div class="col">
									<div class="form-group">
										<label for="nome_add_usuario">Senha</label>
										<input type="current-password" class="form-control" id="senha_add_usuario"
											name="senha_add_usuario" placeholder="Senha" required>
										<input type="number" class="form-control" id="user_id_add_usuario"
											name="user_id_add_usuario" value="<?php echo $user_id; ?>" hidden>
									</div>
								</div>
							</div>

							<div class="form-group form-check mt-3">
								<input type="checkbox" class="form-check-input" id="user_ativo_add_usuario"
									name="user_ativo_add_usuario" value="1" checked>
								<label class="form-check-label" for="user_ativo_add_usuario">Ativo</label>
							</div>
						</form>

						<div class="modal-footer">
							<button type="button" class="btn btn-primary" id="btn-add-novo-usuario"
								onclick="addNovoUsuario()">Cadastrar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>