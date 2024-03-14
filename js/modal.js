// NÃO INCLUIDO NO INDEX.PHP

//import { fetchData } from './funcionarios.js'; // Importando a função fetchData
      


const openModalViewFuncionario = (id)=>{

    const myModal = new bootstrap.Modal('#modalViewFuncionario', {
        keyboard: false
      })

       $.post('../assets/_get_funcionario.php', {"id" : id}).done(function( funcionario) { 

      var direitoCesta  = funcionario.direito_cesta == 1 ? 'checked' : ''; 
      var opcaoCesta    = funcionario.opcao_cesta == 1 ?   'checked' : ''; 
      var ativo         = funcionario.ativo == 1 ?         'checked' : '';
      var celular       = funcionario.celular == null ? '' : funcionario.celular ;
      var img           = funcionario.img != null ? funcionario.img : 'null.jpg';
      var obs = funcionario.obs != null ? funcionario.obs : '';
      if(funcionario.saldo != null && funcionario.saldo > 0){ 
          var saldoText   = 'Disponível ('+funcionario.saldo+')' 
          var saldoColor  = 'primary'
          var button      = '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><a href="#" class="text-decoration-none text-white fw-bold" onclick="removeSaldo(\''+funcionario.id+'\',\''+funcionario.nome+'\',\'true\')">X</a></span>'
        }
      else{
        var saldoText = 'Indisponível' 
        var saldoColor = 'danger'
        var button      = '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary"><a href="#" class="text-decoration-none text-white fw-bold" onclick="adicionaSaldo(\''+funcionario.id+'\',\''+funcionario.nome+'\',\'true\')">+</a></span>' 
        }


      $('#formFuncionario-imgPerfil').html('<img src="../img/perfil/'+img+'" class="img-thumbnail rounded float-end mb-1" alt="...">');
      $('#formFuncionario-img-id').val(funcionario.id);
    
            $('#modalViewFuncionarioLabel').html(funcionario.matricula+' '+funcionario.nome)    
            $('#modalBodyViewFuncionario').html(
              '<form class="form form-sm row g-3" id="form-edit-funcionario">'+
                '<div class="row mb-3">'+
                    '<div class="col-2">'+
                      '<label for="matricula" class="form-label">Matrícula</label>'+
                      '<input type="number" class="form-control form-control-sm" name="matricula" value="'+funcionario.matricula+'" readonly="readonly">'+
                      '<input type="number" class="form-control form-control-sm" name="id" value="'+funcionario.id+'" hidden>'+
                    '</div>'+
                    '<div class="col-4">'+
                      '<label for="name" class="form-label">Nome</label>'+
                      '<input type="text" class="form-control form-control-sm" name="nome" value="'+funcionario.nome+'" readonly="readonly">'+
                    '</div>'+
                    '<div class="col-3">'+
                      '<label for="folha" class="form-label">Folha</label>'+
                      '<input type="text" class="form-control form-control-sm" name="folha" value="'+funcionario.folha+'" readonly="readonly">'+
                    '</div>'+
                    '<div class="col-3">'+
                    '<label for="vinculo" class="form-label">Vínculo</label>'+
                    '<input type="text" class="form-control form-control-sm" name="vinculo" value="'+funcionario.vinculo+'" readonly="readonly">'+
                  '</div>'+
              '</div>'+

                '<div class="row mb-3">'+
                  '<div class="col-auto">'+
                    '<label for="secretaria" class="form-label">Secretaria</label>'+
                    '<input type="text" class="form-control form-control-sm" name="secretaria" value="'+funcionario.secretaria+'" readonly="readonly">'+
                  '</div>'+
                  '<div class="col">'+
                    '<label for="local" class="form-label">Local</label>'+
                    '<input type="text" class="form-control form-control-sm" name="local" value="'+funcionario.local_trabalho+'" readonly="readonly">'+
                  '</div>'+
                  '<div class="col">'+
                    '<label for="lotacao" class="form-label">Lotação</label>'+
                    '<input type="text" class="form-control form-control-sm" name="lotacao" value="'+funcionario.lotacao+'" readonly="readonly">'+
                  '</div>'+
                  '<div class="col">'+
                  '<label for="cargo" class="form-label">Cargo</label>'+
                  '<input type="text" class="form-control form-control-sm" name="cargo" value="'+funcionario.cargo+'" readonly="readonly">'+
                '</div>'+
                '</div>'+

                '<div class="row mb-3">'+
                '<div class="col-3">'+
                  '<label for="email" class="form-label">E-mail</label>'+
                  '<input type="email" class="form-control form-control-sm" name="email" value="'+funcionario.email+'" readonly="readonly">'+
                '</div>'+
                '<div class="col-3">'+
                  '<label for="celular" class="form-label">Celular</label>'+
                  '<input type="tel" class="form-control form-control-sm" name="celular" data-mask="(00) 00000-0000" value="'+celular+'" onkeyup="handlePhone(event)" readonly="readonly">'+
                '</div>'+
                '<div class="col-2">'+
                  '<label for="cartão" class="form-label">Cartão</label>'+
                  '<input type="password" class="form-control form-control-sm" name="cartao" data-mask="0000000" value="'+funcionario.cartao+'" readonly="readonly">'+
                '</div>'+
                '<div class="col-2">'+
                  '<label for="saldo" class="form-label">Crédito|Cesta</label>'+
                  '<span class="badge bg-'+saldoColor+' fw-bold fs-6 p-2 position-relative">'+saldoText+button+'</span>'+

                '</div>'+
              '</div>'+
              

              '<div class="row mb-3 justify-content-start">'+
                '<div class="col-12">'+
                  '<label for="obs" class="form-label">Observações</label>'+
                  '<textarea class="form-control form-control-sm lh-1 js--trumbowyg" name="obs" rows=6 readonly="readonly">'+obs+'</textarea>'+
                '</div>'+
              '</div>'+

                '<div class="row mb-3 justify-content-start">'+
                  '<div class="col-auto">'+
                    '<div class="form-check form-switch">'+
                      '<input class="form-check-input" type="checkbox" name="direito"' +direitoCesta+' onclick="return false;">'+
                      '<label class="form-check-label" for="direito">Possui direito a cesta</label>'+
                    '</div>'+
                  '</div>'+
                  '<div class="col-auto">'+
                    '<div class="form-check form-switch">'+
                      '<input class="form-check-input" type="checkbox" name="opcao"' +opcaoCesta+' onclick="return false;">'+
                      '<label class="form-check-label" for="opcao">Optante por receber cesta</label>'+
                    '</div>'+
                  '</div>'+
                  '<div class="col-auto">'+
                    '<div class="form-check form-switch">'+
                      '<input class="form-check-input" type="checkbox" name="ativo"' +ativo+' onclick="return false;">'+
                      '<label class="form-check-label" for="ativo">Ativo</label>'+
                    '</div>'+
                  '</div>'+                
                '</div>'+

              '</form>'
        );
        });

        myModal.show();
}


// const openModalEditFuncionario = (id)=>{

//     const myModal = new bootstrap.Modal('#modalViewFuncionario', {
//         keyboard: false
//       })

//       $('#modalViewFuncionarioLabel').html(id)
//       $('#modalBodyViewFuncionario').html("Editando")

//       myModal.show()
// }


// const openModalViewFornecedor = (id)=>{

//   const myModal = new bootstrap.Modal('#modalViewFornecedor', {
//       keyboard: false
//     })

//   //  $('#modalViewFuncionarioLabel').html(id)
//   //  $('#modalBodyViewFuncionario').html("Editando")

//     myModal.show()
// }

