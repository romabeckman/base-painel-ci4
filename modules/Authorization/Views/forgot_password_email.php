<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Recuperação de senha - <?php echo PROJECT_NAME; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body style="margin: 0; padding: 0;">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style='font-family: Calibri, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"; font-size: 11pt;'>
            <tr>
                <td>
                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="600">
                        <tr>
                            <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px; text-align: justify;">
                                <p>Olá, <?php echo $user->name; ?>,</p>
                                <p>
                                    Recebemos uma solicitação para restaurar sua senha de acesso em nosso domínio: <?php echo base_url(); ?>.
                                    Ela ocorreu em <?php echo date('d/m/Y H:i:s'); ?>.
                                </p>
                                <p>Sua nova senha é: <b><?php echo $password; ?></b></p>
                                <p>Atenciosamente,<br /><?php echo PROJECT_NAME; ?></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>