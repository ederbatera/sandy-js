<div class="tab-pane fade" id="tab-cestas" role="tabpanel" aria-labelledby="tab-cestas-tab">
		<form id="userForm">
		<div class="row text-center justify-content-center">
			<div class="col-12 overflow-auto" style="height: 78vh">			
				<table class="table table-info table-sm table-borderless table-responsive table-hover text-start user-select-none" id="userTable">
				<thead class="table-primary sticky-top" style="background-color: #41605890; z-index: 10;">
					<tr class="">
					<th>Nome</th>
					<th>Matrícula</th>
          <th>Lotação</th>
          <th>Local</th>
          <th>Cargo</th>
					<th>Saldo <input class="form-check-input" id="checkBoxSaldoAll" type="checkbox"></th>
					</tr>
				</thead>
				<tbody class="height-150 font-size-12">
					<!-- Os campos de cada usuário serão adicionados aqui -->
				</tbody>
				</table>
			</div>
		</div>
    <div class="row justify-content-between mt-2">
      <!-- <div class="col"><button class="btn btn-danger" type="button" onclick="setSaldoAll()"> Carregar </button></div> -->
      <div class="col-auto">Total: <span class="badge bg-success fw-bold fs-6" id="usersAll">...</span></div>
      <div class="col-auto"> Com direito: <span class="badge bg-success fw-bold fs-6" id="usersWithRights">...</span></div>
      <div class="col-auto"> Optantes: <span class="badge bg-success fw-bold fs-6" id="usersWithOption">...</span></div>
      <div class="col-auto me-auto"> Selecionados: <span class="badge bg-success fw-bold fs-6" id="selectedUserCount">...</span></div>
      <div class="col-auto align-self-end"><input class="btn btn-sm btn-primary" type="submit" value="SALVAR"></div>
    </div>

	</form>
		
</div>