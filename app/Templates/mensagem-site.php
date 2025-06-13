<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>VAT Tecnologia da Informação</title>

    <style type="text/css">

    img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
    a img { border: none; }
    table { border-collapse: collapse !important; }
    #outlook a { padding:0; }
    .ReadMsgBody { width: 100%; }
    .ExternalClass {width:100%;}
    .backgroundTable {margin:0 auto; padding:0; width:100%;!important;}
    table td {border-collapse: collapse;}
    .ExternalClass * {line-height: 115%;}


    /* General styling */

    td {
      font-family: Arial, sans-serif;
      color: #5e5e5e;
      font-size: 16px;
      text-align: justify;
    }

    body {
      -webkit-font-smoothing:antialiased;
      -webkit-text-size-adjust:none;
      width: 100%;
      height: 100%;
      color: #5e5e5e;
      font-weight: 400;
      font-size: 16px;
    }


    h1 {
      margin: 10px 0;
    }

    a {
      color: #2b934f;
      text-decoration: none;
    }


    .body-padding {
      padding: 0 75px;
    }


    .force-full-width {
      width: 100% !important;
    }

    .icons {
      text-align: right;
      padding-right: 30px;
    }

    .logo {
      text-align: left;
      padding-left: 30px;
    }

    .computer-image {
      padding-left: 30px;
    }

    .header-text {
      text-align: left;
      padding-right: 30px;
      padding-left: 20px;
    }

    .header {
      color: #232925;
      font-size: 24px;
    }

    </style>

    <style type="text/css" media="screen">
        @media screen {
          @import url(http://fonts.googleapis.com/css?family=PT+Sans:400,700);
          * {
            font-family: 'PT Sans', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
          }
        }
    </style>

    <style type="text/css" media="only screen and (max-width: 599px)">
      @media only screen and (max-width: 599px) {

        table[class*="w320"] {
          width: 320px !important;
        }

        td[class*="icons"] {
          display: block !important;
          text-align: center !important;
          padding: 0 !important;
        }

        td[class*="logo"] {
          display: block !important;
          text-align: center !important;
          padding: 0 !important;
        }

        td[class*="computer-image"] {
          display: block !important;
          width: 230px !important;
          padding: 0 45px !important;
          border-bottom: 1px solid #e3e3e3 !important;
        }


        td[class*="header-text"] {
          display: block !important;
          text-align: center !important;
          padding: 0 25px!important;
          padding-bottom: 25px !important;
        }

        *[class*="mobile-hide"] {
          display: none !important;
          width: 0 !important;
          height: 0 !important;
          line-height: 0 !important;
          font-size: 0 !important;
        }


      }
    </style>
  </head>
  <body  offset="0" class="body" style="padding:0; margin:0; display:block; background:#e7e7e7; -webkit-text-size-adjust:none" bgcolor="#e7e7e7">
  <table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%">
    <tr>
      <td align="center" valign="top" style="background-color:#e7e7e7" width="100%">

      <center>
        <table cellspacing="0" cellpadding="0" width="600" class="w320">
          <tr>
            <td align="center" valign="top">

              <table class="force-full-width" cellspacing="0" cellpadding="0">
                <tr>
                  <td style="text-align: center; padding: 15px;">
                    <img src="https://www.vat.com.br/assets/images/logo-vat.png">
                  </td>
                </tr>
              </table>

              <table class="force-full-width" cellspacing="0" cellpadding="20" bgcolor="#fff">
                <tr>
                  <td>
                    <table cellspacing="0" cellpadding="0" class="force-full-width">
                      <tr>
                        <td>
                          <span class="header">Olá,<br><br></span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <span>Recebemos uma mensagem enviada através do formulário de contato do site da VAT (https://www.vat.com.br/fale-conosco) com os seguintes dados:</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          &nbsp;
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <strong>Nome:</strong> <?=$fullName;?>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <strong>Email:</strong> <?=$email;?>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <strong>Telefone:</strong> <?=$phone;?>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <strong>Assunto:</strong> <?=$subject;?>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <strong>Mensagem:</strong> <?=$message;?>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          &nbsp;
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <span>Obs.: Responda este email caso queira contactar o autor da mensagem.</span>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>

              <table cellspacing="0" cellpadding="0">
                <tr>
                  <td style="font-size: 10px; margin: 10px; padding: 15px; text-align: center;">
                    <span>Enviado em <?=date("d-m-Y H:i:s");?></span><br>
                  </td>
                </tr>
              </table>


            </td>
          </tr>
        </table>

      </center>
      </td>
    </tr>
  </table>
  </body>
</html>