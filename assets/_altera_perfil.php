
<?php

header('Content-Type: application/json');

if (isset($_POST['id_altera_usuario']) && !empty($_POST['id_altera_usuario']) && $_POST['id_altera_usuario'] != ""){
    $id = $_POST['id_altera_usuario'];
}else{
    $id = false;
}

if (isset($_POST['id_user_change_altera_usuario']) && !empty($_POST['id_user_change_altera_usuario']) && $_POST['id_user_change_altera_usuario'] != ""){
    $id_user_change = $_POST['id_user_change_altera_usuario'];
}else{
    $id_user_change = false;
}

if (isset($_POST['nome_altera_usuario']) && !empty($_POST['nome_altera_usuario']) && $_POST['nome_altera_usuario'] != ""){
    $nome = $_POST['nome_altera_usuario'];
}else{
    $nome = false;
}

if (isset($_POST['cargo_altera_usuario']) && !empty($_POST['cargo_altera_usuario']) && $_POST['cargo_altera_usuario'] != ""){
    $cargo = $_POST['cargo_altera_usuario'];
}else{
    $cargo = false;
}

if (isset($_POST['matricula_altera_usuario']) && !empty($_POST['matricula_altera_usuario']) && $_POST['matricula_altera_usuario'] != ""){
    $matricula = $_POST['matricula_altera_usuario'];
}else{
    $matricula = false;
}

if (isset($_POST['email_altera_usuario']) && !empty($_POST['email_altera_usuario']) && $_POST['email_altera_usuario'] != ""){
    $email = $_POST['email_altera_usuario'];
}else{
    $email = false;
}

if (isset($_POST['senha_altera_usuario']) && !empty($_POST['senha_altera_usuario']) && $_POST['senha_altera_usuario'] != ""){
    $salt = 'n0ssUS3rv1d0Rb@L@';
    $senha = hash('sha512', $_POST['senha_altera_usuario'] . $salt);
}else{
    $senha = false;
}

if (isset($_POST['ativo_altera_usuario']) && $_POST['ativo_altera_usuario'] == 1){
    $ativo = "A";
}else{
    $ativo = "I";
}

// echo json_encode(
//     //[$nome,$cargo,$matricula,$email,$ativo,$id, $senha],
//     $_POST,
//      JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
//     );
    
//     die();


$params = [
    "error" => true, 
    "errorText" => "", 
    "statusRes" => "error", 
    "titleRes" => "", 
    "htmlRes" => "", 
    "data" => ""
  ];


function resConstruct(){
global $params;
$res =  [
"icon"  => $params['statusRes'],
"title" => $params['titleRes'],
"html"  => $params['htmlRes'],
"param" => $params['data'],
"error" => [
          "status" => $params['error'],
          "text" => $params['errorText']
          ]
];

echo json_encode($res, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}


$data = isset($_POST) && !empty($_POST)? json_encode($_POST) : null;

if($data !== null):

  if( !$nome || !$cargo || !$matricula || !$email || !$ativo || !$id )
    {
      $params['error'] = true;
      $params['titleRes'] = "Falta parâmetros";
      $params['data'] = [$nome,$cargo,$matricula,$email,$ativo, $id, $id_user_change] ;
      resConstruct();
      die();
    }

    if( !is_numeric($id) && !is_numeric($matricula) ){
    $params['error'] = true;
    $params['titleRes'] = "Parâmetros incorretos";
    $params['data'] = [$nome,$cargo,$matricula,$email,$ativo, $id, $id_user_change] ;
    resConstruct();
    die();
    }





    include_once '_conexao.php';
    $pdo = Conexao::getInstance();

    try {
        // Conexão PDO com o banco de dados
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // Iniciar a transação
        $pdo->beginTransaction();
    
        // Preparar a consulta SQL com parâmetros nomeados
        if ($senha) {
            $stmt = $pdo->prepare("UPDATE usuarios SET nome=:nome,cargo=:cargo, matricula=:matricula,  email=:email, senha=:senha, status=:ativo WHERE id=:id");
    
            // Associar os valores aos parâmetros nomeados
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':cargo', $cargo, PDO::PARAM_STR);
            $stmt->bindParam(':matricula', $matricula, PDO::PARAM_INT);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
            $stmt->bindParam(':ativo', $ativo, PDO::PARAM_STR);
        }else {
            $stmt = $pdo->prepare("UPDATE usuarios SET nome=:nome, cargo=:cargo, matricula=:matricula, email=:email, status=:ativo WHERE id=:id");
    
            // Associar os valores aos parâmetros nomeados
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':cargo', $cargo, PDO::PARAM_STR);
            $stmt->bindParam(':matricula', $matricula, PDO::PARAM_INT);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            //$stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
            $stmt->bindParam(':ativo', $ativo, PDO::PARAM_STR);
        }
    
        // Executar a consulta
        $stmt->execute();
    
        // Fazer o commit da transação
        $pdo->commit();
    
        $params['error']     = false;
        $params['statusRes'] = "success";
        $params['titleRes']  = "Update realizado com sucesso!";
        $params['htmlRes']   = "";
        $params['data'] = [$nome,$cargo,$matricula,$email,$ativo, $id, $id_user_change] ;
        resConstruct();

    } catch (PDOException $e) {
        // Se ocorrer um erro, desfazer a transação
        $pdo->rollBack();

        $params['error'] = true;
        $params['errorText']   = $e->getMessage();
        $params['statusRes']   = "error";
        $params['titleRes']    = "Ops :(";
        $params['htmlRes']     = "Ocorreu um erro: ". $e->getMessage();
        $params['data'] = [$nome,$cargo,$matricula,$email,$ativo, $id, $id_user_change] ;
        resConstruct();
    }
        
    

else:
    $params['error'] = true;
    $params['errorText']   = "Sem os parâmetros necessários";
    $params['statusRes']   = "error";
    $params['titleRes']    = "Ops :(";
    $params['htmlRes']     = "Ocorreu um erro: ";
    $params['data'] = [$nome,$cargo,$matricula,$email,$ativo, $id, $id_user_change] ;
    resConstruct();
    die();
endif;
    
    
    
//resConstruct();
      
?>
    