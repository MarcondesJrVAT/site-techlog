<?php
/**
 * @author Fábio Assunção - fabio@fabioassuncao.com.br
 * @version 0.0.1
 * @date February 06, 2016
 * @date updated March 14, 2016
 */

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 * development
 * production
 *
 */
define('ENVIRONMENT', 'production');

/**
 * Define relative base path.
 */

define('DIR', '/');

define('URL_SITE', 'https://www.vat.com.br/');


/**
 * System path
 */
define('SYSTEM_PATH', 'Babita');

/**
 * Application path
 */
define('APPLICATION_PATH', 'application');

/**
 * Errors log path
 */
define('ERRORS_PATH', 'log/error');

/**
 * Models path
 */
define('MODELS_PATH', 'app/Models');

/**
 * Views path
 */
define('VIEWS_PATH', 'app/views');

/**
 * Templates path
 */
define('TEMPLATES_PATH', 'app/templates');

/**
 * Controllers path
 */
define('CONTROLLERS_PATH', 'app/Controllers');

/**
 * Modules path
 */
define('MODULES_PATH', 'app/Modules');

/**
 * Languages path
 */
define('LANGUAGES_PATH', 'app/Languages');

/**
 * Set default controller for legacy calls.
 */
define('DEFAULT_CONTROLLER', 'Home');

/**
 * Set default method for legacy calls.
 */
define('DEFAULT_METHOD', 'index');

/**
 * Set the default template.
 */
define('TEMPLATE', 'default');

/**
 * Set a default language.
 */
define('LANGUAGE_CODE', 'pt_BR');

/**
 * Set private key for encryption and decryption.
 * The key length must be at least 256bit / 32 characters
 * Exemple: a9e83e7d2b4638ff200ba1a2b925c424e623420a
 */
define('APP_KEY', 'a9e83e7d2b4638ff200ba1a2b925c424e623420a');

/**
 * Recaptcha Key Google
 * Site key
 * Use this in the HTML code your site serves to users.
 */
 define('RECAPTCHA_PUBLIC_KEY', '6Le6jigTAAAAAGkWv-SzAedoBbgFbSLDve5hE25F');

/**
 * Recaptcha Key Google
 * Secret key
 * Use this for communication between your site and Google. Be sure to keep it a secret.
 */
 define('RECAPTCHA_SECRET_KEY', '6Le6jigTAAAAAM4460isGCYrxxh8sXXITZXgrIoP');

/**
 * Optional create a constant for the name of the site.
 */
define('SITETITLE', 'VAT Tecnologia da Informação S/A');

/**
 * Set timezone.
 */
define('TIMEZONE', 'America/Sao_Paulo');

/**
 * Set User agent
 */
define('USER_AGENT', 'VAT WEB Agent');
