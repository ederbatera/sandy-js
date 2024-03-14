
function getFornecedores(search){

    
    $.post('../assets/_get_fornecedores.php', {"search" : search}).done(function( fornecedores ) { 

        $('#tbody-list-fornecedores').html('');       
        for(var i = 0; i < fornecedores.length; i++){  
            $('#tbody-list-fornecedores').append(
                '<tr class="fw-semibold lh-1">'+
                    '<td>'+fornecedores[i].codigo+'</td>'+
                    '<td>'+fornecedores[i].razao+'</td>'+
                    '<td>'+fornecedores[i].data_cadastro+'</td>'+
                    '<td class="text-center fs-5">'+
                        '<a class="text-decoration-none hover-black" onclick="openModalViewFornecedor('+fornecedores[i].id+')"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>'+
                    '</td>'+
                '</tr>'
                );
           

        }
        $('#input-find-fornecedores').val("");

    });

} 

/* ************************************************************************************************ */



function findFornecedores(){

    var find = $('#input-find-fornecedores').val().toUpperCase();
    sessionStorage.setItem('input-find-fornecedores', find);

    
    $.post('../assets/_get_fornecedores.php', {"search" : find}).done(function( fornecedores ) {

        $('#tbody-list-fornecedores').html('');
        for(var i = 0; i < fornecedores.length; i++){
            $('#tbody-list-fornecedores').append(
                    '<tr class="fw-semibold lh-1">'+
                    '<td>'+fornecedores[i].codigo+'</td>'+
                    '<td>'+fornecedores[i].razao+'</td>'+
                    '<td>'+fornecedores[i].data_cadastro+'</td>'+
                    '<td class="text-center fs-5">'+
                        '<a class="text-decoration-none hover-black" onclick="openModalViewFornecedor('+fornecedores[i].id+')"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>'+
                    '</td>'+
                '</tr>'
                );
            }
            });
        }

