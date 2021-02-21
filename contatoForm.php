<?php
header('Content-Type: text/html; charset=utf-8');

//Recuperar dados do Formulário:
$GetPost = filter_input_array(INPUT_POST,FILTER_DEFAULT);
//var_dump($GetPost);

//Variaveis locais:
$Erro = true;
$Nome = utf8_decode($GetPost['nome']);
$Telefone = utf8_decode($GetPost['telefone']);
$Email = utf8_decode($GetPost['email']);
$Mensagem = utf8_decode($GetPost['mensagem']);

//var_dump($Nome);

//Incluir a classe PHPMailer
include_once 'PHPMailer/class.smtp.php';
include_once 'PHPMailer/class.phpmailer.php';

$Mailer = new PHPMailer;
$Mailer->Charset = "utf8";
//$Mailer->SMTPDebug = 0;
$Mailer->IsSMTP();
$Mailer->Host = "smtp-mail.outlook.com";
$Mailer->SMTPAuth = true;
$Mailer->Username = "fabio.tecnoseg@hotmail.com";
$Mailer->Password = "cash784dig624";
$Mailer->SMTPSecure = 'tls';
$Mailer->Port = 587;
$Mailer->FromName = "{$Nome}";
$Mailer->From = "fabio.tecnoseg@hotmail.com";
$Mailer->AddAddress("fabio.tecnoseg@gmail.com");
$Mailer->IsHTML(true);
$Mailer->Subject = "Novo e-mail de Site &nbsp; {$Nome}&nbsp;".date("H:i:s")." - ".Date("d/m/y");
$Mailer->Body = "

<html>
     <meta charset=\"utf-8\">
<!-- Bootstrap CSS -->
    <link rel=\"stylesheet\" href=\"node_modules\bootstrap\compiler\bootstrap.css\">
    <link rel=\"stylesheet\" href=\"style/css/style.css\">
<head>
<body>
<div class=\"container\">
    <div class=\"row\">
        <div class=\"col-12 text-center my-3\">
            <h4 class=\"display-5\">Email de Contato de Site(Portifolio)</h4>
        </div>
        <div class=\"col-12 text-center my-4\">
            <p>E-mail enviado por {$Nome}<br></p>
            <p>Telefone: {$Telefone}<br></p>
            <p>E-mail: {$Email}<br></p>
            <p class='text-justify'>Mensagem: {$Mensagem}</p>
        </div>
    </div>
    </div>
</body>
</head>
</html>

";

//Verificação:
if($Mailer->send()){
   $Erro = false;
    header("Location: TelaConfirmaMensagem.php");

}else{
    echo "Não foi possível enviar o e-mail.";
    echo "<b>Informações do erro:</b> " . $Erro;
}
//var_dump($Mailer);
?>

