<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Envio de Curriculo</title>
</head>

<body>

</body>

</html>
<?php
        
        $name = $_POST["name"];
        $email = $_POST["email"];
        $areainteresse = $_POST["areainteresse"];
        $file = $_FILES["file"];

        if(!empty($_FILES['file'])){
            
            //$uploaddir = '/';
             //$extensao = strtolower(end(explode('.', $_FILES['file']['name'])));
            
            //$file = $uploaddir.'arquivo'.$extensao;
            $file = "/curriculo.pdf";
            move_uploaded_file($_FILES['file']['tmp_name'], $file);
        }

        $mensagem = "<html>
            <head>
            <meta charset='utf-8'>
            </head>
            <body>
                <b>Nome do(a) Candidato:</b> $name
                <br /><br />
                <b>E-mail do(a) Candidato:</b> $email
                <br /><br />
                <b>Área de Interesse:</b> $areainteresse
                <br /><br />
            </body>
            </html>
                ";
              
        

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;


        require './mail4/Exception.php';
        require './mail4/PHPMailer.php';
        require './mail4/SMTP.php';
        
        

        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = 0;
        $mail->Host = 'smtp.office365.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'STARTTLS';
        $mail->SMTPAuth = true;
        $mail->Username = 'ariandersonsena@outlook.com.br'; //username
        $mail->Password = 'sena162570'; //password

        $mail->setFrom('ariandersonsena@outlook.com.br', 'Currículo VVH');
        $mail->addAddress('ariandersonsena@outlook.com.br', 'Currículo VVH');
//        $mail->addAddress('rafael.goncalves@cav-ba.asav.org.br', 'Solicitação Formulário');
        $mail->isHTML(true);
        $mail->Subject = "Opa!! Um novo Curriculo para" .$areainteresse ."Hospital Vila Velha Acabou de chegar!!";
        $mail->Body = $mensagem;
        
      if(!empty($_FILES['file'])){
            $mail->AddAttachment($file);
        }

         if ($mail->send()) {
            ?>
<html>

<head>
    <meta charset='utf-8'>
</head>

<body>
    <div
        style="margin: auto; background-color: #eeeeeebe; width:25%; height: 50vh; border-radius: 5px; text-align: center; margin-top:5%;">
        <div>
            <img src="../VVH/img/check.png" alt="Check verde">
            <h1>Curriculo Enviado!</h1>
            <p>A empresa entrará em contato caso seu perfil seja selecionado pelo recrutador.</p>
            <p>Estamos lhe desejando, boa sorte!</p>
            <p>Aperte "OK" para voltar ao site do Hospital Vila Velha!</p>
            <br /><br /><br /><br />
            <a href="http://www.vilavelhahospital.com.br/"><button style="width: 20%;">ok</button></a>
        </div>
    </div>
</body>

</html>
<?php
         } else {
             echo "Houve um erro no envio. Por favor, entre em contato com a nossa Equipe de suporte.";
             exit();
         }
         
?>