<div class="tab-pane fade" id="tab-fornecedores" role="tabpanel" aria-labelledby="tab-fornecedores-tab">

	<div class="row justify-content-end">
		<div class="col-auto">
			<button class="btn btn-sm btn-primary " type="button" data-bs-toggle="modal" data-bs-target="#modalCriaFornecedor"><i class="fa-solid fa-truck-fast"></i> Novo	Fornecedor</button>
		</div>
	</div>
	<div class="row mt-4 text-center justify-content-center">
		<div class="col-12 overflow-auto" style="height: 60vh">
			<table class="table table-success table-sm table-borderless table-responsive table-hover text-start"
				id="table-fornecedores">
				<thead class="table-primary sticky-top" style="background-color: #41605890; z-index: 10;">
					<tr>
						<th scope="col-1">Código</th>
						<th scope="col-9">Razão Social</th>
						<th scope="col-1">Data de Cadastro</th>
						<th scope="col-1">Estoques</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody class="table-persona" id="tbody-list-fornecedores">
					<!-- Append JS -->
				</tbody>
			</table>
		</div>
	</div>

</div>

<!-- Modal -->
<div class="modal fade" id="modalCriaFornecedor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
	aria-labelledby="modalCriaFornecedorLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5 text-dark" id="modalCriaFornecedorLabel">Adicionar Fornecedor
				</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="#" id="form-add-fornecedor">
					<div class="row">
						
						<div class="col-2">
							<div class="form-group">
								<input type="text" class="form-control" name="codigo" placeholder="Código" data-mask="000000" required>
							</div>
						</div>
						<div class="col-10">
							<div class="form-group">
								<input type="text" class="form-control" name="razao" placeholder="Razão Social" required>
								<input type="number" name="id_usuario" value="<?php echo $user_id; ?>" hidden>
							</div>
						</div>
					</div>

					<div class="modal-footer mt-4">
						<button type="submit" class="btn btn-primary">Cadastrar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>