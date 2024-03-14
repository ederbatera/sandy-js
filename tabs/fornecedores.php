<div class="tab-pane fade" id="tab-fornecedores" role="tabpanel" aria-labelledby="tab-fornecedores-tab">

<div class="row justify-content-between">

	 	<div class="col-3">
			<div class="input-group input-group-sm">
				<span class="input-group-text" id="inputGroup-find-sm">Filtrar</span>
				<input type="text" class="form-control" onblur="this.value = this.value.toUpperCase();" id="input-find-fornecedores" style="text-transform: uppercase;">
				<button class="btn btn-sm btn-outline-dark" type="button" id="button-addon2" onclick="findfornecedores()"><i class="fa-solid fa-magnifying-glass"></i></button>
			</div>	 		
	 	</div>
	 	<div class="col-auto ml-auto">
		 	<button class="btn btn-sm btn-outline-dark" type="button" data-bs-toggle="modal" data-bs-target="#modalAddFornecedor"><i class="fa-solid fa-person-circle-plus fa-xl"></i></button> 		
	 	</div>
	 </div>
	<div class="row mt-4 text-center justify-content-center">
		<div class="col-12 overflow-auto" style="height: 70vh">
			<table class="table table-success table-sm table-borderless table-striped table-responsive text-start" id="table-fornecedores">
			<!-- <table id="table-fornecedores"> -->
				<thead class="table-primary sticky-top" style="background-color: #41605890; z-index: 10;">
					<tr>
						<th scope="col-1">Código</th>
						<th scope="col-9">Razão Social</th>
						<th scope="col-1">Data de Cadastro</th>
						<th scope="col">Ver|Editar</th>
					</tr>
				</thead>
				<tbody id="tbody-list-fornecedores">
					<!-- Append JS -->
				</tbody>
			</table>
		</div>
	</div>
		
</div>