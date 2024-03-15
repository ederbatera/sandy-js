
function getFuncionarios(search){

    
    $.post('../assets/_get_funcionarios.php', {"search" : search}).done(function( funcionarios ) { 

        $('#tbody-list-funcionarios').html('');       
        for(var i = 0; i < funcionarios.length; i++){  
            
            var nome = funcionarios[i].cartao ? funcionarios[i].nome+' <span class="text-primary ms-3"><i class="fa-regular fa-id-card fa-xl"></i></span>' : funcionarios[i].nome;
            // var saldo = funcionarios[i].saldo > 0 ? '<a href="#" class="text-decoration-none fw-bold" onclick="removeSaldo(\''+funcionarios[i].id+'\',\''+funcionarios[i].nome+'\')"><i class="fa-solid fa-box fa-bounce text-primary tooltip-main"><span class="tooltiptext-danger">Remover o saldo</span></i></a>' : '<a href="#" class="text-decoration-none fw-bold" onclick="adicionaSaldo(\''+funcionarios[i].id+'\',\''+funcionarios[i].nome+'\')"><i class="fa-solid fa-box text-danger tooltip-main"><span class="tooltiptext-primary">Adicionar saldo</span></i></a>' ; 
             var saldo = funcionarios[i].saldo > 0 ? '<a href="#" class="text-decoration-none fw-bold" onclick="removeSaldo(\''+funcionarios[i].id+'\',\''+funcionarios[i].nome+'\')"><i class="fa-solid fa-box fa-bounce text-success" data-tooltip="Remover saldo"></i></a>' : '<a href="#" class="text-decoration-none fw-bold" onclick="adicionaSaldo(\''+funcionarios[i].id+'\',\''+funcionarios[i].nome+'\')"><i class="fa-solid fa-box text-danger" data-tooltip="Adicionar saldo"></i></a>' ; 

            var direitoCesta = funcionarios[i].direito_cesta == 1 ? '<i class="fa-regular fa-circle-check text-primary"></i>' : '<i class="fa-regular fa-circle-xmark text-danger"></i>';
            var opcaoCesta = funcionarios[i].opcao_cesta == 1 ? '<i class="fa-regular fa-circle-check text-primary"></i>' : '<i class="fa-regular fa-circle-xmark text-danger"></i>';
            var ativo = funcionarios[i].ativo == 1 ? '<i class="fa-regular fa-circle-check text-primary"></i>' : '<i class="fa-regular fa-circle-xmark text-danger"></i>'; 

            $('#tbody-list-funcionarios').append(
												'<tr class="fw-semibold lh-1">'+
													'<td>'+nome+'</td>'+
													'<td>'+funcionarios[i].matricula+'</td>'+
													'<td>'+funcionarios[i].vinculo+'</td>'+
													'<td>'+funcionarios[i].lotacao+'</td>'+
													'<td>'+funcionarios[i].local_trabalho+'</td>'+
													'<td>'+funcionarios[i].cargo+'</td>'+
													'<td>'+funcionarios[i].folha+'</td>'+
													'<td>'+funcionarios[i].secretaria+'</td>'+
													'<td class="text-center fs-5">'+direitoCesta+'</td>'+
													'<td class="text-center fs-5">'+opcaoCesta+'</td>'+
													//'<td class="text-center fs-5">'+ativo+'</td>'+
                                                    '<td class="text-center fs-5">'+saldo+'</td>'+
													'<td class="text-center fs-5">'+
														'<a class="text-decoration-none hover-black" onclick="openModalViewFuncionario('+funcionarios[i].id+')"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>'+
													'</td>'+
												'</tr>'
												);
           

        }
        $('#foo-table-funcionarios').html("Listando todos os funcionários");
        $('#input-find-funcionarios').val("");

    });

} 

/* ************************************************************************************************ */



function findFuncionarios(){

    var find = $('#input-find-funcionarios').val().toUpperCase();
    sessionStorage.setItem('input-find-funcionarios', find);

    
    $.post('../assets/_get_funcionarios.php', {"search" : find}).done(function( funcionarios ) {

        $('#tbody-list-funcionarios').html('');
        for(var i = 0; i < funcionarios.length; i++){

            var nome = funcionarios[i].cartao ? funcionarios[i].nome+' <span class="text-primary ms-3"><i class="fa-regular fa-id-card fa-xl"></i></span>' : funcionarios[i].nome;
            var saldo = funcionarios[i].saldo > 0 ? '<a href="#" class="text-decoration-none fw-bold" onclick="removeSaldo(\''+funcionarios[i].id+'\',\''+funcionarios[i].nome+'\')"><i class="fa-solid fa-box fa-bounce text-primary"></i></a>' : '<a href="#" class="text-decoration-none fw-bold" onclick="adicionaSaldo(\''+funcionarios[i].id+'\',\''+funcionarios[i].nome+'\')"><i class="fa-solid fa-box text-danger"></i></a>' ; 
            var direitoCesta = funcionarios[i].direito_cesta == 1 ? '<i class="fa-regular fa-circle-check text-success"></i>' : '<i class="fa-regular fa-circle-xmark text-danger"></i>';
            var opcaoCesta = funcionarios[i].opcao_cesta == 1 ? '<i class="fa-regular fa-circle-check text-success"></i>' : '<i class="fa-regular fa-circle-xmark text-danger"></i>';
            var ativo = funcionarios[i].ativo == 1 ? '<i class="fa-regular fa-circle-check text-success"></i>' : '<i class="fa-regular fa-circle-xmark text-danger"></i>';


            $('#tbody-list-funcionarios').append(
                                                    '<tr class="fw-semibold lh-1">'+
                                                    '<td>'+nome+'</td>'+
                                                    '<td>'+funcionarios[i].matricula+'</td>'+
                                                    '<td>'+funcionarios[i].vinculo+'</td>'+
                                                    '<td>'+funcionarios[i].lotacao+'</td>'+
                                                    '<td>'+funcionarios[i].local_trabalho+'</td>'+
                                                    '<td>'+funcionarios[i].cargo+'</td>'+
                                                    '<td>'+funcionarios[i].folha+'</td>'+
                                                    '<td>'+funcionarios[i].secretaria+'</td>'+
                                                    '<td class="text-center fs-5">'+direitoCesta+'</td>'+
                                                    '<td class="text-center fs-5">'+opcaoCesta+'</td>'+
                                                    '<td class="text-center fs-5">'+ativo+'</td>'+
                                                    '<td class="text-center fs-5">'+saldo+'</td>'+
                                                    '<td class="text-center fs-5">'+
                                                        '<a class="text-decoration-none hover-black" onclick="openModalViewFuncionario('+funcionarios[i].id+')"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>'+
                                                    '</td>'+
                                                '</tr>'
                                                );
        $('#foo-table-funcionarios').html("Filtrando funcionários com \""+find+"\"");
        $('#input-find-funcionarios').val("");
            }
            });
        }

