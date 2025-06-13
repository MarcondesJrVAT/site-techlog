<?php
/**
 * @author Fábio Assunção - fabio@fabioassuncao.com.br
 * @version 0.0.1
 * @date February 06, 2016
 */

/**
 * Administrator e-mail for error notification system
 * Sample: sample@mail.com
 */
define('MAIL_ADMIN', 'fabio@ma.ip.tv');

/**
 * Whether to use SMTP authentication.
 * Uses the Username and Password properties.
 * @type bool
 */
define('MAIL_SMTP_AUTH', true);

/**
 * Sets message type to HTML or plain.
 * @param bool $ishtml True for HTML mode.
 * @return void
 */
define('MAIL_IS_HTML', true);

/**
 * The character set of the message.
 * @type string
 */
define('MAIL_CHARSET', 'UTF-8');

/**
 * The secure connection prefix.
 * Options: "", "ssl" or "tls"
 * @type string
 */
define('MAIL_SMTP_SECURE', 'tls');

/**
 * SMTP hosts.
 * Either a single hostname or multiple semicolon-delimited hostnames.
 * You can also specify a different port
 * for each host by using this format: [hostname:port]
 * (e.g. "smtp1.example.com:25;smtp2.example.com").
 * Hosts will be tried in order.
 * @type string
 */
define('MAIL_HOST', 'mail.ip.tv');

/**
 * The default SMTP server port.
 * @type int
 */
define('MAIL_PORT', 587);//465);

/**
 * SMTP username.
 * @type string
 */
define('MAIL_USER', 'feedback@ip.tv');

/**
 * SMTP password.
 * @type string
 */
define('MAIL_PASS', '&}d(BZv_eA@Z');

/**
 * How to handle debug output.
 * Options:
 *   'echo': Output plain-text as-is, appropriate for CLI
 *   'html': Output escaped, line breaks converted to <br>, appropriate for browser output
 *   'error_log': Output to error log as configured in php.ini
 * @type string
 */
define('DEBUG_OUTPUT', 'html');

/**
 * SMTP class debug output mode.
 * Options:
 *   0: no output
 *   1: commands
 *   2: data and commands
 *   3: as 2 plus connection status
 *   4: low level data output
 * @type int
 */
define('SMTP_DEBUG', 4);

/**
 * The path to the sendmail program.
 * @type string
 */
define('SENDMAIL_PATH', '/usr/sbin/sendmail');
