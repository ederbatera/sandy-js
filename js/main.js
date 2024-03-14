$(document).ready(function () {
 
$(() => {
  $("#btn-funcionarios").on("click", event => {
    $("#rfidCardInput").focus();
  });
});

// VERIFICA SE A TECLA ENTER FOI ACIONADA NO INPUT RFID
$('#rfidCardInput').keypress(function(e) {
    if(e.which == 13) {
      	getRFID();
    }
});

// VERIFICA SE A TECLA ENTER FOI ACIONADA NO INPUT BUSCA FUNCIONÁRIOS
$('#input-find-funcionarios').keypress(function(e) {
    if(e.which == 13) {
		findFuncionarios();
    }
});


$('#rfidCardInput').mask('0000000', {
	'translation': {
	//	S: {pattern: /[A-Za-z]/},
		0: {pattern: /[0-9]/}
	}
	,onKeyPress: function (value, event) {
		event.currentTarget.value = value.toUpperCase();
	}
});

/*
$(document).on("click","#formFuncionario-celular", function(){
	$(this).mask('(00) 0 0000-0000',{reverse: true});
})
*/

/* HABILITA O data-mask="(00) 00000-0000" */
$.jMaskGlobals.watchDataMask = true;

/* FAZ A LISTAGEM DE FUNCIONÁRIOS NO CARREGAMENTO DA PÁGINA */
//getFuncionarios(false);
//getFornecedores(false);

/* LIMPA O CAMPO DE MENSAGEM AO FECHAR O MODAL */
$('#modalViewFuncionario').on('hide.bs.modal', function (event) {
	$("#res-post-img").html('');
	//getFuncionarios(false);
})

/* LIMPA O FORMULÁRIO AO FECHAR O MODAL */
$('#modalAddFuncionario').on('hide.bs.modal', function (event) {
	$('#formAddFuncionario').each (function(){
		this.reset();
	  });
	fetchData();
})

// $("#table-funcionarios").fancyTable({
// 	sortColumn:0,
// 	pagination: true,
// 	perPage:10,
// 	globalSearch:true
//   });


var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})

}) // FIM DO READ FUNCTION



function getRFID(receveRFID = false){

	if(receveRFID){
 		var rfidCard = receveRFID;
	}else{
		var rfidCard = $( "#rfidCardInput" ).val();
		}
		
	if(rfidCard == ""){
		Swal.fire({
			icon: 'error',
			title: 'Digite o número do cartão',
		  });
	}else{

		$( "#rfidCardInput" ).val("");
		$.post( "../assets/_get_rfidcard.php", {"rfidcard" : rfidCard}).done(function( data ) {
			var retorno = data;
		
			if(retorno.localizado == 1){
				openModalViewFuncionario(retorno.id);					

			}else{
				Swal.fire({
					icon: 'error',
					title: 'Ops!',
					html: retorno.error,
					showConfirmButton:true,
					showCancelButton: false,
					confirmButtonText: 'Fechar',
					confirmButtonColor: 'blue',
					allowOutsideClick:true,
					allowEscapeKey:true,
					allowEnterKey:true,
					stopKeydownPropagation:false,
				  })
			}

		});
	}  
	
}