
/* Máscaras ER */

const handlePhone = (event) => {
    let input = event.target
    input.value = phoneMask(input.value)
  }
  
  const phoneMask = (value) => {
    if (!value) return ""
    value = value.replace(/\D/g,'')
    value = value.replace(/(\d{2})(\d)/,"($1) $2")
    value = value.replace(/(\d)(\d{4})$/,"$1-$2")
    return value
  }

/* Máscaras ER */

/* MENSAGENS DE INFORMAÇÕES */

const msgError = (text) => {
  const message = '<span class="badge bg-danger text-white">'+text+'</span>';
  return message;
}

const msgSuccess = (text) => {
  const message = '<span class="badge bg-primary text-dark">'+text+'</span>';
  return message;
}

/* MENSAGENS DE INFORMAÇÕES */

/* CARREGA O OBJETO COM TODOS OS FUNCIONÁRIOS */
var funcionariosAll = new Object();
$.post('../assets/_get_funcionarios.php', {"search" : false}).done(function( retorno ) {
  funcionariosAll = retorno ;
  //console.log(funcionariosAll)

})




/* ALTERAR IMAGEM DE PERFIL */

const sendImgPerfil = () => {

  //var formdata = new FormData($("form[name='form-change-img']")[0]);
  $('#res-post-img').html('<div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div>');
  var formdata = new FormData($("#form-change-img")[0]);
  var link = "../assets/_image_upload.php";
      $.ajax({
          type: 'POST',
          url: link,
          data: formdata ,
          processData: false,
          contentType: false
  
      }).done(function (res) {
          if(res.status == true){
            $("#res-post-img").html(msgSuccess('<i class="fa-solid fa-check"></i> Atualizada!'));
            setTimeout(() => {
              $("#res-post-img").html('');
            }, 3000);
            $("#formFuncionario-img-change").val('');
            $('#formFuncionario-imgPerfil').html('<img src="../img/perfil/'+res.img_link+'" class="img-thumbnail rounded float-end mb-1" alt="...">');
          }else{
            $("#formFuncionario-img-change").val('');
            $("#res-post-img").html(msgError(res.error));
            setTimeout(() => {
              $("#res-post-img").html('');
            }, 3000);
          }
      });
      return true;
  } 

/* DELETA IMAGEM DE PERFIL */

const deleteImgPerfil = () => {

  //var formdata = new FormData($("form[name='form-change-img']")[0]);
  $('#res-post-img').html('<div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div>');
  var formdata = new FormData($("#form-change-img")[0]);
  var link = "../assets/_image_delete.php";
      $.ajax({
          type: 'POST',
          url: link,
          data: formdata ,
          processData: false,
          contentType: false
  
      }).done(function (res) {
          if(res.status == true){
            $("#res-post-img").html(msgSuccess('<i class="fa-solid fa-check"></i> Deletada!'));
            setTimeout(() => {
              $("#res-post-img").html('');
            }, 3000);
            $("#formFuncionario-img-change").val('');
            $('#formFuncionario-imgPerfil').html('<img src="../img/perfil/null.jpg" class="img-thumbnail rounded float-end mb-1" alt="...">'); 
          }else{
            $("#formFuncionario-img-change").val('');
            $("#res-post-img").html(msgError(res.error));
            setTimeout(() => {
              $("#res-post-img").html('');
            }, 3000);
          }
      });
      return true;
  } 

  /* BLOQUEIA/DESBLOQUEIA EDIÇÃO NO FORMULÁRIO DO FUNCIONÁRIO */

  const lockFormFuncionario = (state) => { 
    var formFuncionarios = $("#form-edit-funcionario :input");
    formFuncionarios.each(function(){
      var input = $(this);
      input.attr("readonly", state);
      state == false ? input.attr("onclick", null).off("click") : input.attr('onclick', 'return false;');
      if(state == false){
        $('#btn-form-funcionario').html(
          '<button class="btn btn-danger m-2" onclick="lockFormFuncionario(true)">Cancelar</button>'+
          '<button class="btn btn-primary" type="submit" onclick="sendFormFuncionario()">Salvar</button>'
        )
      }
        else{
          $('#btn-form-funcionario').html(
            '<button class="btn btn-success" onclick="lockFormFuncionario(false)">Editar</button>'
          )
        }
      
       });
  }

  /* ADICIONAR FUNCIONÁRIO */


$( "#formAddFuncionario" ).on( "submit", function( event ) { 

    event.preventDefault();
    var data = {};
    $("#formAddFuncionario" ).serializeArray().map(function(x){data[x.name] = x.value;})

    var celular   = data.celular.replace(/[^0-9]/g,'');
    var direito   = data.direito ? 1 : 0;
    var opcao     = data.opcao ? 1 : 0;
    var ativo     = data.ativo ? 1 : 0;

    const dataUpper = {}
    for (var key in data) {
      dataUpper[key] = data[key].toUpperCase();
    }
    data = dataUpper

    $.post( "../assets/_edit_funcionario.php",
      {
        "operacao": "adicionar",
        "matricula": data.matricula,
        "nome": data.nome,
        "folha": data.folha,
        "vinculo": data.vinculo,
        "secretaria": data.secretaria,
        "local_trabalho": data.local,
        "lotacao": data.lotacao,
        "cargo": data.cargo,
        "email": data.email.toLowerCase(),
        "celular": celular,
        "cartao": data.cartao,
        "obs": data.obs,
        "direito_cesta": direito,
        "opcao_cesta": opcao,
        "ativo": ativo,
        "user_id": user_id,
      }
    ).done(function( data ) {
      var retorno = JSON.parse(data);
        if(!retorno.error){
              Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: retorno.message,
                showConfirmButton: false,
                timer: 1500
              });
              $("#modalAddFuncionario").modal("hide")
              // getFuncionarios(false);
              fetchData();
              socket.emit("update", {
                type: 'cadastro',
                message: `${user_name} cadastrou ${data.nome}`,
                log: {
                  user: user_id,
                  funcionario: data.nome,
                  data: new Date()
                }
              });
        }else{
              Swal.fire({
                icon: 'error',
                title: 'Ops!',
                text: retorno.message,
                //showConfirmButton: false,
                //timer: 1500
              });
        }
  
    });
   

});

/* EDITAR FUNCIONÁRIO */

 let sendFormFuncionario = () => {

   var data = {};
   $("#form-edit-funcionario" ).serializeArray().map(function(x){data[x.name] = x.value;})
   //console.log(data);

  var celular   = data.celular.replace(/[^0-9]/g,'');
  var direito   = data.direito ? 1 : 0;
  var opcao     = data.opcao ? 1 : 0;
  var ativo     = data.ativo ? 1 : 0;

  const dataUpper = {}
  for (var key in data) {
    dataUpper[key] = data[key].toUpperCase();
  }
  data = dataUpper

  $.post( "../assets/_edit_funcionario.php", 
    {
      "operacao": "editar",
      "id": data.id,
      "matricula": data.matricula,
      "nome": data.nome,
      "folha": data.folha,
      "vinculo": data.vinculo,
      "secretaria": data.secretaria,
      "local_trabalho": data.local,
      "lotacao": data.lotacao,
      "cargo": data.cargo,
      "email": data.email.toLowerCase(),
      "celular": celular,
      "cartao": data.cartao,
      "obs": data.obs,
      "direito_cesta": direito,
      "opcao_cesta": opcao,
      "ativo": ativo,
      "user_id": user_id,
    }
  ).done(function( response ) {
    // console.log( data );
    var retorno = JSON.parse(response);
      if(!retorno.error){
            Swal.fire({
              icon: 'success',
              title: 'Sucesso!',
              text: retorno.message,
              showConfirmButton: false,
              timer: 1500
            });
            $("#modalAddFuncionario").modal("hide")
            __FUNCIONARIOS[data.id] = data;
            //console.log(__FUNCIONARIOS[data.id])
            //getFuncionarios(false);
            fetchData();
            socket.emit("update", {
              type: 'cadastro',
              message: `${user_name} atualizou ${data.nome}`,
              log: {
                user: user_id,
                funcionario: data.nome,
                data: new Date()
              }
            });
      }else{
            Swal.fire({
              icon: 'error',
              title: 'Ops!',
              text: retorno.message,
              //showConfirmButton: false,
              //timer: 1500
            });
      }

  });
 
  lockFormFuncionario(true)
  //attFuncionarios();

};



/* */