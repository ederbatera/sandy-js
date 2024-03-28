$(document).ready(function () {


	/* PEGA O EVENTO DE ABERTURA DE TAB */
	$(() => {
		$('a[data-bs-toggle="tab"]').on('show.bs.tab', function (event) {
			setTimeout(() => {
				const el = event.target || event.srcElement;
				//const id = el.id;
				const target = el.getAttribute("aria-controls");

				if (target !== null) {
					localStorage.setItem("@Sandy:table_active", target)

					switch (target) {
						case "tab-dashboard":
							//console.log("dashboard")
							break;
						case "tab-funcionarios":
							$("#rfidCardInput").val("").focus()
							break;
						case "tab-cestas":
							setSaldoAll()
							break;
						case "tab-estoque":
							//console.log("estoque")
							break;
						case "tab-fornecedores":
							getFornecedores()
							break;
						case "tab-usuarios":
							getUsuarios()
							break;
						case "tab-retiradas":
							getEntregas()
							break;
						case "tab-configuracoes":
							break;
						default:

							break;
					}
				}
			}, 300);
		});
	});


	// VERIFICA SE A TECLA ENTER FOI ACIONADA NO INPUT RFID
	$('#rfidCardInput').keypress(function (e) {
		if (e.which == 13) {
			getRFID();
		}
	});

	// VERIFICA SE A TECLA ENTER FOI ACIONADA NO INPUT BUSCA FUNCIONÁRIOS
	$('#input-find-funcionarios').keypress(function (e) {
		if (e.which == 13) {
			findFuncionarios();
		}
	});


	/* HABILITA O data-mask="(00) 00000-0000" */
	$.jMaskGlobals.watchDataMask = true;

	/* FAZ A LISTAGEM DE FUNCIONÁRIOS NO CARREGAMENTO DA PÁGINA */
	//getFuncionarios(false);
	//getFornecedores(false);

	/* LIMPA O CAMPO DE MENSAGEM AO FECHAR O MODAL */
	$('#modalViewFuncionario').on('hide.bs.modal', function (event) {
		$("#res-post-img").html('');
	})

	/* LIMPA O FORMULÁRIO AO FECHAR O MODAL */
	$('#modalAddFuncionario').on('hide.bs.modal', function (event) {
		$('#formAddFuncionario').each(function () {
			this.reset();
		});
		fetchData();
	})

	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
		return new bootstrap.Tooltip(tooltipTriggerEl)
	})

}) // FIM DO READ FUNCTION



function getRFID(receveRFID = false) {

	if (receveRFID) {
		var rfidCard = receveRFID;
	} else {
		var rfidCard = $("#rfidCardInput").val();
	}

	rfidCard = parseInt(rfidCard)
	if (rfidCard == "") {
		Swal.fire({
			icon: 'error',
			title: 'Digite o número do cartão',
		});
	} else {

		$("#rfidCardInput").val("");
		$.post("../assets/_get_rfidcard.php", { "rfidcard": rfidCard }).done(function (data) {

			if (data.localizado == 1) {
				openModalViewFuncionario(data);

			} else {
				Swal.fire({
					icon: 'error',
					title: 'Ops!',
					html: data.error,
					showConfirmButton: true,
					showCancelButton: false,
					confirmButtonText: 'Fechar',
					confirmButtonColor: 'blue',
					allowOutsideClick: true,
					allowEscapeKey: true,
					allowEnterKey: true,
					stopKeydownPropagation: false,
				})
			}

		});
	}


}