const url = '../../assets/_get_funcionarios.php'; // Substitua 'URL_DA_API' pela URL da sua API
const tableBody = document.getElementById('tbody-list-funcionarios');
const searchInput = document.getElementById('search-input-funcionarios');
const pagination = document.getElementById('pagination-table-funcionarios');
const itemsPerPage = 20;
let currentPage = 1;
var __FUNCIONARIOS = [];

// Suponha que você alterou a variável 'data'
// __FUNCIONARIOS.push({
//   id: 999,
//   matricula: 1234,
//   nome: "Novo Usuário"
// });

// Atualize a tabela com os novos dados
// populateTable(getCurrentPageData());





//document.addEventListener("DOMContentLoaded", async function() {
// (async ()=>{
// async function intiFuncionarios() {


async function fetchData() {
  try {
    const response = await fetch(url);
    __FUNCIONARIOS = await response.json();
    //sessionStorage.setItem("__FUNCIONARIOS", JSON.stringify(__FUNCIONARIOS) );
    populateTable(getCurrentPageData());
    renderPagination();
  } catch (error) {
    console.error('Erro ao buscar dados:', error);
  }
}



function populateTable(__FUNCIONARIOS) {
  tableBody.innerHTML = '';

  __FUNCIONARIOS.forEach(item => {


    var saldo = item.saldo > 0 ? '<a href="#" class="text-decoration-none fw-bold" onclick="removeSaldo(\'' + item.id + '\',\'' + item.nome + '\')"><i class="fa-solid fa-box fa-bounce text-success" data-tooltip="Remover saldo"></i></a>' : '<a href="#" class="text-decoration-none fw-bold" onclick="adicionaSaldo(\'' + item.id + '\',\'' + item.nome + '\')"><i class="fa-solid fa-box text-danger" data-tooltip="Adicionar saldo"></i></a>';
    const row = document.createElement('tr');

    const nomeCell = document.createElement('td');
    //nomeCell.textContent = item.nome;
    const nomeFa = document.createElement('i');
    nomeFa.classList.add('text-primary', 'me-1', 'fa-regular', 'fa-id-card', 'fa-xl');
    item.cartao ? nomeCell.append(nomeFa, " ", item.nome) : nomeCell.append(item.nome)
    //nomeCell.appendChild(' '+item.nome);
    row.appendChild(nomeCell);

    const matriculaCell = document.createElement('td');
    matriculaCell.textContent = item.matricula;
    row.appendChild(matriculaCell);

    const vinculoCell = document.createElement('td');
    vinculoCell.textContent = item.vinculo;
    row.appendChild(vinculoCell);

    const lotacaoCell = document.createElement('td');
    lotacaoCell.textContent = item.lotacao;
    row.appendChild(lotacaoCell);

    const localCell = document.createElement('td');
    localCell.textContent = item.local;
    row.appendChild(localCell);

    const cargoCell = document.createElement('td');
    cargoCell.textContent = item.cargo;
    row.appendChild(cargoCell);

    const folhaCell = document.createElement('td');
    folhaCell.textContent = item.folha;
    row.appendChild(folhaCell);

    const secretariaCell = document.createElement('td');
    secretariaCell.textContent = item.secretaria;
    row.appendChild(secretariaCell);

    const direitoCell = document.createElement('td');
    //direitoCell.textContent = item.direito;
    direitoCell.classList.add('text-center', 'fs-5');
    const direitoCellIcon = document.createElement('i')
    item.direito_cesta == 1 ? direitoCellIcon.classList.add('fa-regular', 'fa-circle-check', 'text-primary') : direitoCellIcon.classList.add('fa-regular', 'fa-circle-xmark', 'text-danger')
    direitoCell.appendChild(direitoCellIcon)
    row.appendChild(direitoCell);

    const opcaoCell = document.createElement('td');
    //opcaoCell.textContent = item.opcao;
    opcaoCell.classList.add('text-center', 'fs-5');
    const opcaoCellIcon = document.createElement('i')
    item.opcao_cesta == 1 ? opcaoCellIcon.classList.add('fa-regular', 'fa-circle-check', 'text-primary') : opcaoCellIcon.classList.add('fa-regular', 'fa-circle-xmark', 'text-danger')
    opcaoCell.appendChild(opcaoCellIcon)
    row.appendChild(opcaoCell);

    // const ativoCell = document.createElement('td');
    // //ativoCell.textContent = item.ativo;
    // ativoCell.classList.add('text-center', 'fs-5');
    // const ativoCellIcon = document.createElement('i');
    // item.ativo == 1 ? ativoCellIcon.classList.add('fa-regular', 'fa-circle-check', 'text-primary') : ativoCellIcon.classList.add('fa-regular', 'fa-circle-xmark', 'text-danger')
    // ativoCell.appendChild(ativoCellIcon)
    // row.appendChild(ativoCell);

    const saldoCell = document.createElement('td');
    //saldoCell.textContent = item.saldo;
    saldoCell.setAttribute('data-tooltip', 'Alterar saldo')
    saldoCell.classList.add('text-center', 'fs-5')
    const saldoCellButton = document.createElement('a')
    const saldoCellFa = document.createElement('i')
    item.saldo > 0 ? saldoCellFa.classList.add('fa-solid', 'fa-box', 'fa-bounce', 'text-success') : saldoCellFa.classList.add('fa-solid', 'fa-box', 'text-danger')
    saldoCellButton.appendChild(saldoCellFa)
    saldoCell.appendChild(saldoCellButton)
    saldoCellButton.addEventListener('click', () => {
      item.saldo > 0 ? removeSaldo(item.id, item.nome) : adicionaSaldo(item.id, item.nome)
    });
    saldoCell.classList.add('text-center', 'fs-5');
    row.appendChild(saldoCell);

    // ADICIONANDO OS BOTÕES
    const editButtonCell = document.createElement('td');
    editButtonCell.classList.add('text-center', 'fs-5')
    const editButton = document.createElement('a');
    const editButtonFa = document.createElement('i')
    //editButton.textContent = '<i class="fa-solid fa-arrow-up-right-from-square"></i>';    
    editButton.classList.add('text-decoration-none', 'hover-black');
    editButtonFa.classList.add('fa-solid', 'fa-arrow-up-right-from-square');

    editButton.addEventListener('click', () => {
      openModalViewFuncionario(item);
    });
    editButton.appendChild(editButtonFa);
    editButtonCell.appendChild(editButton);
    row.appendChild(editButtonCell);


    row.classList.add('fw-semibold', 'lh-1')
    tableBody.appendChild(row);
  });
}





function filterData() {
  const searchTerm = searchInput.value.toLowerCase();
  const filteredData = __FUNCIONARIOS.filter(item => {
    //return Object.values(item).some(value => {
    return Object.entries(item).some(([key, value]) => {
      // Verifica se a chave é "cartao" ou "celular" e a ignora
      if (key === 'cartao' || key === 'celular' || key === 'id' || key === 'email') {
        return false;
      }
      if (typeof value === 'string') {
        return value.toLowerCase().includes(searchTerm);
      } else if (typeof value === 'number') {
        return value.toString().includes(searchTerm);
      }
      return false;
    });
  });





  // Atualiza a paginação considerando os dados filtrados
  renderPagination(filteredData.length);

  // Mantém a página atual se estiver dentro dos limites
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  if (currentPage > totalPages) {
    currentPage = totalPages;
  }

  populateTable(getCurrentPageData(filteredData));
}





function getCurrentPageData(filteredData) {
  const dataToUse = filteredData || __FUNCIONARIOS;
  const startIndex = (currentPage - 1) * itemsPerPage;
  const endIndex = startIndex + itemsPerPage;
  return dataToUse.slice(startIndex, endIndex);
}




function renderPagination(totalItems) {
  const totalPages = Math.ceil((totalItems || __FUNCIONARIOS.length) / itemsPerPage);
  pagination.innerHTML = '';
  // const collun = document.createElement('div');
  // collun.classList.add('col-1');





  const firstCol = document.createElement('div');
  firstCol.classList.add('col-auto');
  const first = document.createElement('button');
  first.textContent = 'Primeira';
  first.addEventListener('click', () => {
    currentPage = 1;
    filterData();
  });
  //first.classList.add('btn', 'btn-sm', 'btn-primary');
  first.classList.add('custom-btn', 'btn-2')
  firstCol.appendChild(first);
  pagination.appendChild(firstCol);





  const previousCol = document.createElement('div');
  previousCol.classList.add('col-auto');
  const previous = document.createElement('button');
  previous.textContent = '< Anterior';
  previous.addEventListener('click', () => {
    if (currentPage > 1) {
      currentPage--;
      filterData();
    }
  });
  //previous.classList.add('btn', 'btn-sm', 'btn-primary');
  previous.classList.add('custom-btn', 'btn-2')
  previousCol.appendChild(previous);
  pagination.appendChild(previousCol);





  // for (let i = 1; i <= totalPages; i++) {
  //   const li = document.createElement('div');
  //   li.textContent = i;
  //   li.addEventListener('click', () => {
  //     currentPage = i;
  //     filterData();
  //   });
  //   li.classList.add('col-1', 'btn', 'btn-sm', 'btn-primary');
  //   pagination.appendChild(li);
  // }




  const nextCol = document.createElement('div');
  nextCol.classList.add('col-auto');
  const next = document.createElement('button');
  next.textContent = 'Próxima >';
  next.addEventListener('click', () => {
    if (currentPage < totalPages) {
      currentPage++;
      filterData();
    }
  });
  //next.classList.add('btn', 'btn-sm', 'btn-primary');
  next.classList.add('custom-btn', 'btn-2')
  nextCol.appendChild(next)
  pagination.appendChild(nextCol);





  const lastCol = document.createElement('div');
  lastCol.classList.add('col-auto');
  const last = document.createElement('button');
  last.textContent = 'Última';
  last.addEventListener('click', () => {
    currentPage = totalPages;
    filterData();
  });
  //last.classList.add('btn', 'btn-sm', 'btn-primary');
  last.classList.add('custom-btn', 'btn-2')
  lastCol.appendChild(last)
  pagination.appendChild(lastCol);






  // const infoCol = document.createElement('div');
  // infoCol.classList.add('col-auto');
  // const info = document.createElement('span');
  // info.textContent = `Listando ${itemsPerPage * (currentPage - 1) + 1} à ${Math.min(itemsPerPage * currentPage, totalItems || __FUNCIONARIOS.length)} de ${totalItems || __FUNCIONARIOS.length} resultados`;
  const info = `Listando ${itemsPerPage * (currentPage - 1) + 1} à ${Math.min(itemsPerPage * currentPage, totalItems || __FUNCIONARIOS.length)} de ${totalItems || __FUNCIONARIOS.length} resultados`;
  $('#paginationInfo').html(info)
  // info.classList.add('text-white', 'fw-bold', 'fs-6', 'font-monospace');
  // infoCol.appendChild(info)
  // pagination.appendChild(infoCol);


}

/* *************************************************************************************** */

const adicionaSaldo = (userid, username, modal = false) => {
  Swal.fire({
    title: 'Adicionar',
    html: 'Adicionar saldo à ' + username + '?',
    // icon: 'question',
    showCancelButton: true,
    confirmButtonText: 'Adicionar',
    cancelButtonText: 'Cancelar',
    // cancelButtonColor: 'red',
    // confirmButtonColor: 'blue',
    allowOutsideClick: false,
    allowEscapeKey: false,
    allowEnterKey: false,
    stopKeydownPropagation: false,
    //footer: 'Esta operação não poderá ser desfeita.',
    //showLoaderOnConfirm: true,
  }).then((result) => {
    if (result.isConfirmed) {
      $.post("../assets/_saldo.php", { "operacao": "adicionar", "userid": userid })
        .done(function (retorno) {
          // var retorno = JSON.parse(data);
          if (!retorno.error) {

            Swal.fire({
              icon: 'success',
              title: 'Sucesso!',
              html: retorno.message,
              showConfirmButton: false,
              timer: 1000
            });
            if (modal) {

              //$('#modalViewFuncionario').modal('hide');
              //openModalViewFuncionario(userid);
            }
            fetchData();
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Ops',
              html: retorno.message,
              showConfirmButton: true,
              timer: 2000
            })
          }

        });
    }
    // else if (result.dismiss === Swal.DismissReason.cancel) {
    //       Swal.fire({
    //           title: 'Cancelado!',
    //           icon: 'error',
    //           showConfirmButton:false,
    //           showCancelButton:false,
    //           timer: '2000',
    //           timerProgressBar:true

    //       })
    //   }
  })
}



const removeSaldo = (userid, username, modal = false) => {
  Swal.fire({
    title: 'Remover',
    html: 'Remover saldo de:<br>' + username + '?',
    // icon: 'question',
    showCancelButton: true,
    confirmButtonText: 'Remover',
    cancelButtonText: 'Cancelar',
    // cancelButtonColor: 'red',
    // confirmButtonColor: 'blue',
    allowOutsideClick: false,
    allowEscapeKey: false,
    allowEnterKey: false,
    stopKeydownPropagation: false,
    //footer: 'Esta operação não poderá ser desfeita.',
    //showLoaderOnConfirm: true,
  }).then((result) => {
    if (result.isConfirmed) {
      $.post("../assets/_saldo.php", { "operacao": "remover", "userid": userid })
        .done(function (retorno) {
          // var retorno = JSON.parse(data);
          if (!retorno.error) {
            Swal.fire({
              icon: 'success',
              title: 'Sucesso!',
              html: retorno.message,
              showConfirmButton: false,
              timer: 2000
            });
            if (modal) {
              $('#modalViewFuncionario').modal('hide');
              //openModalViewFuncionario(userid);
            }
            fetchData();
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Ops',
              html: retorno.message,
              showConfirmButton: true,
              timer: 2000
            })
          }

        });
    }
    // else if (result.dismiss === Swal.DismissReason.cancel) {
    //       Swal.fire({
    //           title: 'Cancelado!',
    //           icon: 'error',
    //           showConfirmButton:false,
    //           showCancelButton:false,
    //           timer: '2000',
    //           timerProgressBar:true

    //       })
    //   }
  })
}
/********************************************************************************* */










searchInput.addEventListener('input', filterData);
//await fetchData();
fetchData();
//  });
// })();
// }

// intiFuncionarios();


const openModalViewFuncionario = (funcionario) => {

  const myModal = new bootstrap.Modal('#modalViewFuncionario', {
    keyboard: false
  })

  // const funcionario =  $.post('../assets/_get_funcionario.php', {"id" : id}).done(function( funcionario) { 



  var direitoCesta = funcionario.direito_cesta == 1 ? 'checked' : '';
  var opcaoCesta = funcionario.opcao_cesta == 1 ? 'checked' : '';
  var ativo = funcionario.ativo == 1 ? 'checked' : '';
  var celular = funcionario.celular == null ? '' : funcionario.celular;
  var img = funcionario.img != null ? funcionario.img : 'null.jpg';
  var obs = funcionario.obs != null ? funcionario.obs : '';
  var vinculos = ['ESTATUTARIO', 'COMISSIONADO', 'SUBSTITUTO', 'APOSENTADO', 'PENSIONISTA']
  var secretarias = ['ADMINISTRACAO', 'AGRICULTURA E MEIO AMBIENTE', 'ASSISTENCIA SOCIAL', 'DESENVOLVIMENTO E TURISMO', 'EDUCACAO E CULTURA', 'ESPORTES E LAZER', 'HABITACAO', 'OBRAS', 'SAUDE', 'VIAS PUBLICAS']

  if (funcionario.saldo != null && funcionario.saldo > 0) {
    var saldoText = 'Disponível'
    var saldoColor = 'primary'
    var button = '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><a href="#" class="text-decoration-none text-white fw-bold" onclick="removeSaldo(\'' + funcionario.id + '\',\'' + funcionario.nome + '\',true)">X</a></span>'
  }
  else {
    var saldoText = 'Indisponível'
    var saldoColor = 'danger'
    var button = '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary"><a href="#" class="text-decoration-none text-white fw-bold" onclick="adicionaSaldo(\'' + funcionario.id + '\',\'' + funcionario.nome + '\',true)">+</a></span>'
  }

  let selectVinculo = ""
  vinculos.map(vinculo => {
    let selected = vinculo == funcionario.vinculo ? "selected" : "";
    selectVinculo += '<option value="' + vinculo + '" ' + selected + '>' + vinculo + '</option>'
  })

  let selectSecretaria = ""
  secretarias.map(secretaria => {
    let selected = secretaria == funcionario.secretaria ? "selected" : "";
    selectSecretaria += '<option value="' + secretaria + '" ' + selected + '>' + secretaria + '</option>'
  })

  $('#formFuncionario-imgPerfil').html('<img src="../img/perfil/' + img + '" class="img-thumbnail rounded float-end mb-1" alt="...">');
  $('#formFuncionario-img-matricula').val(funcionario.matricula);

  $('#modalViewFuncionarioLabel').html(funcionario.matricula + ' ' + funcionario.nome)
  $('#modalBodyViewFuncionario').html(
    '<form class="form form-sm row g-3" id="form-edit-funcionario">' +
    '<div class="row mb-3">' +
    '<div class="col-2">' +
    '<label for="matricula" class="form-label">Matrícula</label>' +
    '<input type="number" class="form-control form-control-sm" name="matricula" value="' + funcionario.matricula + '" readonly="readonly">' +
    '<input type="number" class="form-control form-control-sm" name="id" value="' + funcionario.id + '" hidden>' +
    '</div>' +
    '<div class="col-4">' +
    '<label for="name" class="form-label">Nome</label>' +
    '<input type="text" class="form-control form-control-sm" name="nome" value="' + funcionario.nome + '" readonly="readonly">' +
    '</div>' +
    '<div class="col-3">' +
    '<label for="folha" class="form-label">Folha</label>' +
    '<input type="text" class="form-control form-control-sm" name="folha" value="' + funcionario.folha + '" readonly="readonly">' +
    '</div>' +
    '<div class="col-3">' +
    '<label for="vinculo" class="form-label">Vínculo</label>' +
    '<select class="form-select form-select-sm" id="vinculo" name="vinculo" readonly="readonly">' +
    selectVinculo +
    '</select>' +
    '</div>' +
    '</div>' +

    '<div class="row mb-3">' +
    '<div class="col-auto">' +
    '<label for="secretaria" class="form-label">Secretaria</label>' +
    // '<input type="text" class="form-control form-control-sm" name="secretaria" value="'+funcionario.secretaria+'" readonly="readonly">'+
    '<select class="form-select form-select-sm" id="secretaria" name="secretaria" readonly="readonly">' +
    selectSecretaria +
    '</select>' +
    '</div>' +
    '<div class="col">' +
    '<label for="local" class="form-label">Local</label>' +
    '<input type="text" class="form-control form-control-sm" name="local" value="' + funcionario.local_trabalho + '" readonly="readonly">' +
    '</div>' +
    '<div class="col">' +
    '<label for="lotacao" class="form-label">Lotação</label>' +
    '<input type="text" class="form-control form-control-sm" name="lotacao" value="' + funcionario.lotacao + '" readonly="readonly">' +
    '</div>' +
    '<div class="col">' +
    '<label for="cargo" class="form-label">Cargo</label>' +
    '<input type="text" class="form-control form-control-sm" name="cargo" value="' + funcionario.cargo + '" readonly="readonly">' +
    '</div>' +
    '</div>' +

    '<div class="row mb-3">' +
    '<div class="col-3">' +
    '<label for="email" class="form-label">E-mail</label>' +
    '<input type="email" class="form-control form-control-sm" name="email" value="' + funcionario.email + '" readonly="readonly" style="text-transform: lowercase;">' +
    '</div>' +
    '<div class="col-3">' +
    '<label for="celular" class="form-label">Celular</label>' +
    '<input type="tel" class="form-control form-control-sm" name="celular" data-mask="(00) 00000-0000" value="' + celular + '" onkeyup="handlePhone(event)" readonly="readonly">' +
    '</div>' +
    '<div class="col-2">' +
    '<label for="cartão" class="form-label">Cartão</label>' +
    '<input type="password" class="form-control form-control-sm" name="cartao" data-mask="0000000" value="' + funcionario.cartao + '" readonly="readonly">' +
    '</div>' +
    '<div class="col-2">' +
    '<label for="saldo" class="form-label">Saldo do cartão</label>' +
    //'<span class="badge bg-'+saldoColor+' fw-bold fs-6 p-2 position-relative">'+saldoText+button+'</span>'+
    '<span class="badge bg-' + saldoColor + ' fw-bold fs-6 p-2">' + saldoText + '</span>' +
    '</div>' +
    '</div>' +


    '<div class="row mb-3 justify-content-start">' +
    '<div class="col-12">' +
    '<label for="obs" class="form-label">Observações</label>' +
    '<textarea class="form-control form-control-sm lh-1 js--trumbowyg" name="obs" rows=6 readonly="readonly">' + obs + '</textarea>' +
    '</div>' +
    '</div>' +

    '<div class="row mb-3 justify-content-start">' +
    '<div class="col-auto">' +
    '<div class="form-check form-switch">' +
    '<input class="form-check-input" type="checkbox" name="direito"' + direitoCesta + ' onclick="return false;">' +
    '<label class="form-check-label" for="direito">Possui direito a cesta</label>' +
    '</div>' +
    '</div>' +
    '<div class="col-auto">' +
    '<div class="form-check form-switch">' +
    '<input class="form-check-input" type="checkbox" name="opcao"' + opcaoCesta + ' onclick="return false;">' +
    '<label class="form-check-label" for="opcao">Optante por receber cesta</label>' +
    '</div>' +
    '</div>' +
    // '<div class="col-auto">'+
    //   '<div class="form-check form-switch">'+
    //     '<input class="form-check-input" type="checkbox" name="ativo"' +ativo+' onclick="return false;">'+
    //     '<label class="form-check-label" for="ativo">Ativo</label>'+
    //   '</div>'+
    // '</div>'+                
    '</div>' +

    '</form>'
  );

  myModal.show();
  // });
}