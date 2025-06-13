<?php

namespace Controllers;
use Babita\Mailer\Mail;
use Babita\Helpers\Url;
use Babita\Security\Csrf;
use Babita\Mvc\View;

class FaleConosco extends BaseController
{

    public function faleConosco()
    {
        $data = [];
        $data['title'] = "Fale Conosco · " . SITETITLE;
        $data['recaptchaPublicKey'] = RECAPTCHA_PUBLIC_KEY;
        $data['csrf_token'] = Csrf::makeToken();

        $this->renderSite('fale-conosco', $data);
    }

    public function processar()
    {
        $errors = [];

        // Checa se token CSRF é válido
        if (!Csrf::isTokenValid()) {
            $errors = array_merge($errors, array('Token inválido. Por favor, tente novamente!'));
        }

        $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Valida nome
        if (!isset($form['name']) || empty($form['name'])) {
            $errors = array_merge($errors, array('Digite seu nome'));
        }

        // Valida telefone
        if (!isset($form['phone']) || empty($form['phone'])) {
            $errors = array_merge($errors, array('Digite um telefone válido'));
        }

        // Valida email
        if (!isset($form['email']) || empty($form['email'])) {
            $errors = array_merge($errors, array('Digite seu email'));
        }

        // Valida email
        if (!filter_var($form['email'], FILTER_VALIDATE_EMAIL)) {
            $errors = array_merge($errors, array('Digite um email válido'));
        }

        // Valida assunto
        if (!isset($form['subject']) || empty($form['subject'])) {
            $errors = array_merge($errors, array('Selecione um assunto'));
        }

        // Valida mensagem
        if (!isset($form['message']) || empty($form['message'])) {
            $errors = array_merge($errors, array('Escreva uma mensagem'));
        }

        // Caso tenha erros, envia mensagens com lista erros para a tela do usuário
        if(count($errors) >= 1){

            $list = "<ul class='margin-left-20'>";
            foreach ($errors as $error) {
                $list .= "<li>{$error}</li>";
            }

            $list .= "</ul>";

            alertError([
                'title' => 'Atenção!',
                'message' => $list
            ]);

            Url::redirect('fale-conosco');
            return;
        }

        // Recebe valores do formulário
        $name = $form['name'];
        $phone = $form['phone'];
        $email = $form['email'];
        $subject = $form['subject'];
        $message = $form['message'];

        $form['fullName'] = $name;


        // Instancia PHPMailer
    	$mail = new Mail();

        // Cria assunto da mensagem
        $subject = "VAT - Fale Conosco: " . $subject;

        // Seta assunto da mensagem
		$mail->subject($subject);

        $template = 'app/Templates/mensagem-site';
        $emailHtml = View::get($template, $form, false, true);

        // Seta corpo da mensagem
		$mail->body($emailHtml);

        $mail->address('to', [
                'mail' => 'suporte@ip.tv',
                'name' => 'Suporte IPTV'
        ]);

        // Seta destino da mensagem | Com cópia oculta
        $mail->address('bcc', [
            [
                'mail' => 'fabio23gt@gmail.com',
                'name' => 'Fábio Assunção'
            ]
        ]);

        // Seta remetente
		$mail->from(['mail' => MAIL_USER, 'name' => 'Fale Conosco [VAT]']);
		$mail->replyTo(['mail' => $email, 'name' => $name]);

        $mail->smtpConnect([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ]);

        // Envia mensagem
 		$result = $mail->mailsend();

        // Caso tenha enviado com sucesso
        if ($result['status'] === true) {
            alertSuccess("Mensagem eviada com sucesso!");
        }

        // Caso não tenha enviado
        else {
            alertError(['message' => 'Ops, algo deu errado ao enviar sua mensagem. Por favor, escolha um de nossos canais de atendimento e envie sua mensagem.']);
        }

        // Retorna para o formulário com uma mensagem de feedback
        Url::redirect('fale-conosco');

    }
}
