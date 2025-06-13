<?php
/**
 * Mailer
 *
 * @author Fábio Assunção da Silva - fabio@fabioassuncao.com.br
 * @version 0.0.1
 * @date Jul 31 2015
 * @date updated March 23, 2016
 */

namespace Babita\Mailer;

/**
 * Custom class for PHPMailer to uniform sending emails.
 */
class Mail extends PhpMailer
{

    public $log = [];

    public function __construct($param = null)
    {
        parent::__construct();

        if (!isset($param['type'])
            || isset($param['type'])
            && $param['type'] == 'smtp'
        ) {

            $smtpAuth = (!isset($param['smtpAuth']))
            ? MAIL_SMTP_AUTH
            : $param['smtpAuth'];

            $isHTML = (!isset($param['isHTML']))
            ? MAIL_IS_HTML
            : $param['isHTML'];

            $charset = (!isset($param['charset']))
            ? MAIL_CHARSET
            : $param['charset'];

            $smtpSecure = (!isset($param['smtpSecure']))
            ? MAIL_SMTP_SECURE
            : $param['smtpSecure'];

            $host = (!isset($param['host']))
            ? MAIL_HOST
            : $param['host'];

            $port = (!isset($param['port']))
            ? MAIL_PORT
            : $param['port'];

            $user = (!isset($param['user']))
            ? MAIL_USER
            : $param['user'];

            $pass = (!isset($param['pass']))
            ? MAIL_PASS
            : $param['pass'];

            //Making an SMTP connection with authentication.

            // Set mailer to use SMTP
            $this->Mailer = 'smtp';

            // Specify main and backup SMTP servers
            $this->Host = $host;

            // Enable SMTP authentication
            $this->SMTPAuth = $smtpAuth;

            // SMTP username
            $this->Username = $user;

             // SMTP password
            $this->Password = $pass;

            // Enable TLS encryption, `ssl` also accepted
            $this->SMTPSecure = $smtpSecure;

            // TCP port to connect to
            $this->Port = $port;

            // Set email format to HTML
            $this->isHTML($isHTML);

            $this->CharSet = $charset;

        } elseif (isset($param['type']) && $param['type'] == 'sendmail') {
            /**
             * Which method to use to send mail.
             * Sending a message using a local sendmail binary.
             * More options: "mail", "sendmail", or "smtp".
             * @type string
             */
            $this->Mailer = 'sendmail';

        } elseif (isset($param['type'])
                && $param['type'] == 'mail'
                || $param['type'] == 'php'
            ) {
            /**
             * Which method to use to send mail.
             * Send messages using PHP's mail() function.
             * More options: "mail", "sendmail", or "smtp".
             * @type string
             */
            $this->Mailer = 'mail';
        }

        /**
         * SMTP class debug output mode.
         * Options:
         *   0: no output
         *   1: commands
         *   2: data and commands
         *   3: as 2 plus connection status
         *   4: low level data output
         * @type int
         * @see SMTP::$do_debug
         */
        $this->SMTPDebug = 0;
        $this->Debugoutput = 'html';


    }

    public function quick($subject, $message, $from, $destination, $replyto = null)
    {

        $this->subject($subject);
        $this->body($message);

        $replyto = ($replyto) ? $replyto : $from;

        $this->from($from, false);
        $this->replyTo($replyto);


        $this->destination($destination);

        return $this->go();
    }

    /**
     * The Subject of the message.
     * @type string
     */
    public function subject($subject)
    {
        $this->Subject = $subject;
    }


    /**
     * @param string ou array $from
     * @param bool ou array $replyto
     *
     * if $replyto is true => $replyto == $from
     *
     *  Example 1: $from = ['mail' => 'fabio23gt@gmail.com', 'name' => 'Fábio Assunção'];
     *  Example 2: $from = 'fabio@fabioassuncao.com.br, Fábio Silva';
     *
     */
    public function from($from, $replyto = true)
    {

        if ($replyto === true) {
            $this->replyTo($from);
        }

        if (is_string($from) && strpos($from, ',')) {
            list($mail, $name) = explode(',', $from);
            $this->SetFrom($mail, $name);
            return;
        }

        elseif (is_array($from) && isset($from['mail']) && isset($from['name'])) {
            $this->SetFrom($from['mail'], $from['name']);
            return;
        }

    }

    /**
     * Add a "Reply-to" address.
     *
     * @param string or array $replyTo
     *
     *  Example 1: $replyTo = array(
     *      'fabio@fabioassuncao.com.br, Fábio Silva',
     *      'fabio23gt@gmail.com, Fábio Assunção'
     *  );
     *
     *  Example 2: $replyTo = array('mail' => 'fabio23gt@gmail.com', 'name' => 'Fábio Assunção');
     *
     *  Example 3: $replyTo = array(
     *      array('mail' => 'fabio23gt@gmail.com', 'name' => 'Fábio Assunção'),
     *      array('mail' => 'fabio.as@live.com', 'name' => 'Adriano Marinho'),
     *  );
     *
     *  Example 4: $replyTo = 'fabio@fabioassuncao.com.br, Fábio Silva';
     *
     */
    public function replyTo($replyTo)
    {
        $this->address('Reply-To', $replyTo);
    }


    /**
     * Add a "CC" address.
     *
     * @param string ou array $replyTo
     *
     *  Example 1: $replyTo = array(
     *      'fabio@fabioassuncao.com.br, Fábio Silva',
     *      'fabio23gt@gmail.com, Fábio Assunção'
     *  );
     *
     *  Example 2: $replyTo = array('mail' => 'fabio23gt@gmail.com', 'name' => 'Fábio Assunção');
     *
     *  Example 3: $replyTo = array(
     *      array('mail' => 'fabio23gt@gmail.com', 'name' => 'Fábio Assunção'),
     *      array('mail' => 'fabio.as@live.com', 'name' => 'Adriano Marinho'),
     *  );
     *
     *  Example 4: $replyTo = 'fabio@fabioassuncao.com.br, Fábio Silva';
     */
    public function cc($cc)
    {
        $this->address('cc', $cc);
    }

    /**
     * An HTML or plain text message body.
     * If HTML then call isHTML(true).
     * @type string
     */
    public function body($body) {
        $this->Body = $body;
        $this->AltBody = 'If this email does not appear correctly, enable viewing of HTML messages.';
    }

    /**
     *
     * @param string ou array $destination
     * @param bool $send
     *
     *  Example 1: $destination = [
     *      'fabio@fabioassuncao.com.br, Fábio Silva',
     *      'fabio23gt@gmail.com, Fábio Assunção'
     *  ];
     *
     *  Example 2: $destination = ['mail' => 'fabio23gt@gmail.com', 'name' => 'Fábio Assunção'];
     *
     *  Example 3: $destination = [
     *      ['mail' => 'fabio23gt@gmail.com', 'name' => 'Fábio Assunção'],
     *      ['mail' => 'fabio.as@live.com', 'name' => 'Adriano Marinho'],
     *  ];
     *
     *  Example 4: $destination = 'fabio@fabioassuncao.com.br, Fábio Silva';
     *
     */
    public function destination($destination, $send = false)
    {
        return $this->address('to', $destination, $send);
    }

    /**
     * @param string ou array $mailingList
     *
     *  Example 1: $mailingList = [
     *      'fabio@fabioassuncao.com.br, Fábio Silva',
     *      'fabio23gt@gmail.com, Fábio Assunção'
     *  ];
     *
     *  Example 2: $mailingList = [
     *      array('mail' => 'fabio23gt@gmail.com', 'name' => 'Fábio Assunção'),
     *      array('mail' => 'fabio.as@live.com', 'name' => 'Adriano Marinho')
     *  ];
     *
     */
    public function mailingList($mailingList)
    {
        return $this->address('to', $mailingList, true);
    }

    public function address($kind, $data, $send = false)
    {
        if ($send === true) {
            // SMTP connection will not close after each email sent, reduces SMTP overhead
            // Deixa em aberto a conexão com servidor
            $this->SMTPKeepAlive = true;
        }

        if (is_string($data) && strpos($data, ',')) {

            list($mail, $name) = explode(',', $data);
            $this->addAnAddress($kind, $mail, $name);

            if ($send === true) {
                $result = $this->go(true);
                $this->setLog($mail, $result);
            }

            return $this->log;
        }

        if (is_array($data) && isset($data['mail']) && isset($data['name'])) {
            $this->addAnAddress($kind, $data['mail'], $data['name']);

            if ($send === true) {
                $result = $this->go(true);
                $this->setLog($data['mail'], $result);
            }

            return $this->log;

        } elseif (is_array($data)) {

            foreach ($data as $d) {

                if (is_array($d) && isset($d['mail']) && isset($d['name'])) {
                    $this->addAnAddress($kind, $d['mail'], $d['name']);

                    if ($send) {
                        $result = $this->go(true);
                        $this->setLog($d['mail'], $result);
                    }

                } elseif (is_string($d) && strpos($d, ',')) {

                    $d = explode(',', $d);
                    $this->addAnAddress($kind, $d[0], $d[1]);

                    if ($send) {
                        $result = $this->go(true);
                        $this->setLog($d[0], $result);
                    }

                }

            }

            return $this->log;

        }
    }



    /**
     * Add an attachment from a path on the filesystem.
     * Returns false if the file could not be found or read.
     * @param string ou array $attachment
     *
     *  Example 1: $attachment = array(
     *      'uploads/sample.png, sample.png',
     *      'uploads/teste_anexo2.png, teste_anexo2.png'
     *  );
     *
     *  Example 2: $attachment = array('path' => 'uploads/sample.png', 'name' => 'sample.png');
     *
     *  Example 3: $attachment = array(
     *      array('path' => 'uploads/sample.png', 'name' => 'sample.png'),
     *      array('path' => 'uploads/teste_anexo2.png', 'name' => 'teste_anexo2.png'),
     *  );
     *
     *  Example 4: $attachment = 'uploads/sample.png, sample.png';
     *
     */
    public function attachment($attachment)
    {
        if (is_string($attachment) && strpos($attachment, ',')) {
            $a = explode(',', $attachment);
            $this->AddAttachment($a[0], $a[1]);

            return;
        }

        if (is_array($attachment) && isset($attachment['path']) && isset($attachment['name'])) {
            $this->AddAttachment($attachment['path'], $attachment['name']);
            return;

        } elseif (is_array($attachment)) {

            foreach ($attachment as $a) {

                if (is_array($a) && isset($a['path']) && isset($a['name'])) {
                    $this->AddAttachment($a['path'], $a['name']);

                } elseif (is_string($a) && strpos($a, ',')) {

                    $a = explode(',', $a);
                    $this->AddAttachment($a[0], $a[1]);

                }

            }

        }

    }

    /**
     * Create a message and send it.
     * Uses the sending method specified by $Mailer.
     * @return bool false on error - See the ErrorInfo property for details of the error.
     */
    public function mailsend($mailingList = false)
    {

        $send = $this->Send();

        if ($send === false) {

            return [
                "message" => "Error sending mail",
                "info" => $this->ErrorInfo,
                "status" => $send,
                "date" => date('Y-m-d H:i:s')
            ];

        } else {

            // se enviado com sucesso, limpa recipientes e anexos;
            // Clear all addresses and attachments for next loop

            if ($mailingList === false) {
                $this->clearAllRecipients();
            } else {
                $this->clearAddresses();
            }

            $this->clearAttachments();

            return [
                "message" => "Email successfully sent",
                "status" => $send,
                "date" => date('Y-m-d H:i:s')
            ];
        }

    }

    public function setLog($mail, $result)
    {
        array_push($this->log, [
            'mail' => $mail,
            'result' => $result,
        ]);
    }

    public function log()
    {
        return $this->log;
    }

}
