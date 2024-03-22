<!-- MODAL ALTERA SENHA -->
<div class="modal fade" id="modalAlteraSenha" tabindex="-1" aria-labelledby="modalAlteraSenha2" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalAlteraSenha2">Alterar Senha</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
          <form id="formAlteraSenha">            


            <div class="row">
                <div class="col mx-4">
                    <label for="lastPassUser" class="form-label">Senha Atual</label>
                    <input name="lastPassUser" id="lastPassUser" class="form-control form-control-sm" type="password" autocomplete="off" aria-label=".form-control-sm example" required>
                </div>
            </div>

            <div class="row">
                <div class="col mx-4">
                    <label for="senhaUserAlter" class="form-label">Nova Senha</label>
                    <input name="senhaUserAlter" id="senhaUserAlter" class="form-control form-control-sm" type="password" autocomplete="off" aria-label=".form-control-sm example" required>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col mx-4">
                    <label for="senhaUserConfirm" class="form-label">Confirma</label>
                    <input name="senhaUserConfirm" id="senhaUserConfirm" class="form-control form-control-sm" type="password" autocomplete="off" aria-label=".form-control-sm example" required>
                </div>
            </div>


            <div class="row justify-content-center">
                <div class="col-auto">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary" onclick="alteraSenhaUsuario()">Alterar</button>
                </div>
            </div>

          </form>  
      </div>
    </div>
  </div>
</div>
<!-- MODAL ALTERA SENHA -->