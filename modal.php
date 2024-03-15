
<div class="modal fade" id="modalViewFuncionario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalViewFuncionarioLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content border border-primary" style="background-color: #00FFFF">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalViewFuncionarioLabel"><div id="modalTitleNameFuncionario"></div></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="row">
              <div class="col-9">
                <div id="modalBodyViewFuncionario"></div>
                <div class="text-end" id="btn-form-funcionario">
                  <button class="btn btn-primary" onclick="lockFormFuncionario(false)">Editar</button>                  
                </div>
                </div>
                <div class="col-3">
                  <div class="border border-primary p-1 rounded">
                      <form id="form-change-img" enctype="multipart/form-data" method="post" action="">
                      <span id="formFuncionario-imgPerfil"><img src="../img/perfil/null.jpg" class="img-thumbnail rounded float-end mb-1" alt="..."></span>
                      <div class="row justify-content-between align-items-center">
                          <div class="col-auto">
                            <!-- <div id="res-post-img" class="fs-5"></div> -->
                          </div>
                          <div class="col-auto">
                            <label for="formFuncionario-img-change" class="btn btn-sm btn-primary m-1"><i class="fa-solid fa-upload"></i></label>
                            <input type="file" class="form-control" id="formFuncionario-img-change" name="formFuncionario-img-change" onchange="sendImgPerfil()">                      
                            <input type="hidden" id="formFuncionario-img-id" name="formFuncionario-img-id" value="">
                            <button type="button" class="btn btn-sm btn-danger m-1" onclick="deleteImgPerfil()"><i class="fa fa-trash-alt"></i></button>                        
                          </div>
                      </div>
                      </form>
                  </div>
                  <div id="res-post-img" class="fs-5 text-center"></div>
              </div>
            </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalAddFuncionario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAddFuncionarioLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content border border-primary" style="background-color: #00FFFF">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Adicionar novo funcionário</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form -->
        <form class="form form-sm row g-3" id="formAddFuncionario" action="/"> 
          
          <div class="row mb-3">
              <div class="col-2">
                <label for="formFuncionario-matricula" class="form-label">Matrícula</label>
                <input type="number" class="form-control form-control-sm" name="matricula" required>
              </div>
              
              <div class="col-4">
                <label for="formFuncionario-name" class="form-label">Nome</label>
                <input type="text" class="form-control form-control-sm" name="nome" required>
              </div>
              
              <div class="col-3">
                <label for="formFuncionario-folha" class="form-label">Folha</label>
                <input type="text" class="form-control form-control-sm" name="folha" required>
              </div>
            
            <div class="col-3">
              <label for="formFuncionario-vinculo" class="form-label">Vínculo</label>
              <input type="text" class="form-control form-control-sm" name="vinculo" required>
            </div>
          </div>
        
          <div class="row mb-3">
            <div class="col-auto">
              <label for="formFuncionario-secretaria" class="form-label">Secretaria</label>
              <input type="text" class="form-control form-control-sm" name="secretaria" required>
            </div>
            
            <div class="col">
              <label for="formFuncionario-local" class="form-label">Local</label>
              <input type="text" class="form-control form-control-sm" name="local" required> 
            </div>
            
            <div class="col">
              <label for="formFuncionario-lotacao" class="form-label">Lotação</label>
              <input type="text" class="form-control form-control-sm" name="lotacao" required>
            </div>
            
            <div class="col">
              <label for="formFuncionario-cargo" class="form-label">Cargo</label>
              <input type="text" class="form-control form-control-sm" name="cargo" required>
            </div>
          </div>
          
          <div class="row mb-3">
            <div class="col-3">
              <label for="formFuncionario-email" class="form-label">E-mail</label>
              <input type="email" class="form-control form-control-sm" name="email">
            </div>
            
            <div class="col-2">
              <label for="formFuncionario-celular" class="form-label">Celular</label>
              <input type="tel" class="form-control form-control-sm" name="celular" data-mask="(00) 00000-0000" onkeyup="handlePhone(event)" autocomplete="off" maxlength="15">
            </div>
            
            <div class="col-2">
              <label for="formFuncionario-cartão" class="form-label">Cartão</label>
              <input type="password" class="form-control form-control-sm" name="cartao" data-mask="0000000" autocomplete="off" maxlength="7">
            </div>
          </div>
          
          <div class="row mb-3 justify-content-start">
            <div class="col-12">
              <label for="formFuncionario-obs" class="form-label">Observações</label>
              <textarea class="form-control form-control-sm lh-1" name="obs" rows="6"></textarea>
            </div>
          </div>
          
          <div class="row mb-3 justify-content-start">
            <div class="col-auto">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="direito" checked>
                <label class="form-check-label" for="formFuncionario-direito">Possui direito a cesta</label>
              </div>
            </div>
          
            <div class="col-auto">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="opcao" checked>
                <label class="form-check-label" for="formFuncionario-opcao">Optante por receber cesta</label>
              </div>
            </div>
            
            <!-- <div class="col-auto">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="ativo" checked>
                <label class="form-check-label" for="formFuncionario-ativo">Ativo</label>
              </div>
            </div> -->
          </div>
          
          <div class="row justify-content-end">
            <div class="col-auto">
              <!-- <a id="btn-addFuncionario" class="btn btn-success btn-sm" onclick="addFuncionario()">Salvar</a> -->
              <button type="submit" class="btn btn-success">Salvar</button>
            </div>
          </div>
        
        </form>
        <!-- Form -->
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="modalAddFornecedor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAddFornecedorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content border border-primary" style="background-color: #00FFFF">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Adicionar novo fornecedor</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <!-- Form -->
            Adicionar Fornecedor
            <!-- Form -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalViewFornecedor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalViewFornecedorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border border-primary" style="background-color: #00FFFF">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Adicionar novo fornecedor</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body id="modalBodyViewFornecedor">
            <!-- Form -->
            Ver Fornecedor
            <!-- Form -->
            </div>
        </div>
    </div>
</div>