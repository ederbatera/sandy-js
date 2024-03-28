<div class="tab-pane fade text-dark" id="tab-usuarios" role="tabpanel" aria-labelledby="tab-usuarios-tab">

	<div class="container" style="margin-bottom: 60px; margin-top: 90px; font-size:12px;">



		<div class="card-body shadow-lg rounded scroll">
			<div class="table-responsive">
				<table class="table table-sm table-hover">
					<thead>
						<tr class="text-dark">
							<th scope="col"></th>
							<th scope="col">Nome</th>
							<th scope="col">E-mail</th>
							<th scope="col">Data do Cadastro</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody class="fs-6" id="listUsuarios">
					</tbody>
				</table>
			</div>
		</div>


		<p class="text-end mt-3">
			<button class="btn btn-primary" type="button" data-bs-toggle="modal"
				data-bs-target="#modalCriaUsuario">Adicionar usuário</button>
		</p>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="modalCriaUsuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
		aria-labelledby="modalCriaUsuarioLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5 text-dark" id="modalCriaUsuariosLabel">Adicionar novo usuário</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form action="" id="form-add-usuario">
						<div class="row">

							<div class="col">
								<div class="form-group">
									<label>Nome</label>
									<input type="text" class="form-control" id="nome_add_usuario"
										name="nome_add_usuario" placeholder="Nome" required>
								</div>
							</div>

							<div class="col">
								<div class="form-group">
									<label>Sobrenome</label>
									<input type="text" class="form-control" id="sobrenome_add_usuario"
										name="sobrenome_add_usuario" placeholder="Sobrenome" required>
								</div>
							</div>

							<div class="col">
								<div class="form-group">
									<label>Cargo</label>
									<input type="text" class="form-control" id="cargo_add_usuario"
										name="cargo_add_usuario" placeholder="Cargo" required>
								</div>
							</div>

							<div class="col">
								<div class="form-group">
									<label>Matrícula</label>
									<input type="text" class="form-control" id="matricula_add_usuario"
										name="matricula_add_usuario" placeholder="Matrícula" required>
								</div>
							</div>

						</div>

						<div class="row mt-2">

							<div class="col">
								<div class="form-group">
									<label>Email</label>
									<input type="email" class="form-control" id="email_add_usuario"
										name="email_add_usuario" placeholder="Email" required>
								</div>
							</div>

							<div class="col">
								<div class="form-group">
									<label>Senha</label>
									<input type="password" class="form-control" id="senha_add_usuario"
										name="senha_add_usuario" placeholder="Senha" required>
									<input type="number" class="form-control" id="user_id_add_usuario"
										name="user_id_add_usuario" value="<?php echo $user_id; ?>" hidden>
								</div>
							</div>
						</div>
						<div class="row mt-2 mb-4">
							<div class="col">
								<div class="form-group form-check mt-4">
									<div class="form-check form-switch">
										<input class="form-check-input" type="checkbox" role="switch"
											id="user_ativo_add_usuario" name="user_ativo_add_usuario" value="1" checked>
										<label class="form-check-label">Ativo</label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<label>Permissão</label>
									<select class="form-select" name="permissao_add_usuario">
										<option value="1">Entregador</option>
										<option value="2">Administrador</option>
										<option value="3">Super administrador</option>
									</select>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary" id="btn-add-novo-usuario">Cadastrar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Modal Edição de Perfil-->
<div class="modal fade text-dark" id="modalChangePerfil" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
	aria-labelledby="modalCriaUsuarioLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title text-dark fs-5" id="modalCriaUsuariosLabel">Alteração de Perfil</h1>
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
								<input type="number" id="id_altera_usuario" name="id_altera_usuario" value="" required
									hidden>
								<input type="number" id="id_user_change_altera_usuario"
									name="id_user_change_altera_usuario" value="" required hidden>
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
								<label for="senha_altera_usuario">Senha (Deixe em branco para não alterar)</label>
								<input type="current-password" class="form-control" id="senha_altera_usuario"
									name="senha_altera_usuario" placeholder="Senha" value="">
							</div>
						</div>
					</div>

					<div class="form-group form-check mt-3">
						<!-- <input type="checkbox" class="form-check-input" id="ativo_altera_usuario" name="ativo_altera_usuario" value="1">
								<label class="form-check-label" for="ativo_altera_usuario">Ativo</label> -->
						<div class="form-check form-switch">
							<input class="form-check-input" type="checkbox" role="switch" id="ativo_altera_usuario"
								name="ativo_altera_usuario" value="1">
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