<div class="tab-pane fade" id="tab-estoque" role="tabpanel" aria-labelledby="tab-estoque-tab">

	<div class="row justify-content-end">
		<div class="col-auto">
			<button class="btn btn-sm btn-primary " type="button" data-bs-toggle="modal" data-bs-target="#modalCriaEstoque"><i class="fa-solid fa-cart-plus"></i>	Novo Estoque</button>
		</div>
	</div>

	<div class="row mt-4 text-center justify-content-center">
		<div class="col-12 overflow-auto" style="height: 60vh">
			<table class="table table-success table-sm table-borderless table-responsive table-hover text-start"
				id="table-funcionarios">
				<!-- <table id="table-funcionarios"> -->
				<thead class="table-primary sticky-top" style="background-color: #41605890; z-index: 10;">
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Quantidade</th>
						<th scope="col">Fornecedor</th>
						<th scope="col">Usuário criador</th>
						<th scope="col">Data de cadastro</th>
						<th scope="col">Atualizado</th>
					</tr>
				</thead>
				<tbody class="table-persona fs-6" id="tbody-list-estoques">
					<!-- Append JS -->
				</tbody>
			</table>
		</div>
	</div>
</div>


	<!-- Modal -->
	<div class="modal fade" id="modalCriaEstoque" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
		aria-labelledby="modalCriaEstoqueLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5 text-dark" id="modalCriaEstoquesLabel">Adicionar Estoque de Cestas Básicas</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form action="#" id="form-add-estoque">
						<div class="row">
							<div class="col">
								<div class="form-group">
										<label>Fornecedor</label>
										<select class="form-select" id="fornecedor_add_estoque" name="codigo_fornecedor">
											<!-- <option value="1">Entregador</option>
											<option value="2">Administrador</option>
											<option value="3">Super administrador</option> -->
										</select>
									</div>
							</div>
							<div class="col">
								<div class="form-group">
									<label>Quantidade</label>
									<input type="text" class="form-control" name="quantidade" placeholder="Quantidade" data-mask="0000" required>
									<input type="number" name="id_usuario" value="<?php echo $user_id; ?>" hidden>
								</div>
							</div>
						</div>

						<div class="modal-footer mt-4">
							<button type="submit" class="btn btn-primary">Cadastrar</button>
						</div>
					</form>
					<div id="modal_cria_estoque_alert"></div>
				</div>
			</div>
		</div>
	</div>