<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
define('APP_NAME', 'admin');

define('EMAIL_GATEWAY','cpanel_mailer');//define('EMAIL_GATEWAY','gmail', 'phpmailer', 'cpanel_mailer');//

define('SENDER_EMAIL','support@321re.com');

define("EHOST",'smtp.gmail.com');
define("EUSERNAME",'kdcsev113@gmail.com');
define("EPASSWORD",'');
define("ESENDERNAME",'support@higherlevelfx.com');

define('SMTP_HOST','email-smtp.us-west-2.amazonaws.com');
define('SMTP_USER','AKIAJ7FIXU3XTUYQMTXQ');
define('SMTP_PASS','AjhuuaEL0ip30EeGFCw2MHqITBEmJnD3gCOtEDhYFHp1');
define('SMTP_PORT',587);
define('SMTP_SENDER','info@321re.com');

define("CHOST",'mail.wi5admin.com');
define("CUSERNAME",'_mainaccount@wi5admin.com');
define("CPASSWORD",'100-silver');
define("CSENDERNAME",'Wi5admin');

/*define('SUPPORT_EMAIL','jintong113@outlook.com');*/
define('SUPPORT_EMAIL','info@321re.com');


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/*define('FB_APP_ID','216509912879262');
define('FB_APP_SECRET','8201f5f2658ed39c1ee4fa6f66b42ddd');*/
define('FB_APP_ID','725589850845175');
define('FB_APP_SECRET','7b3a4ec3ec3f79ccf37882cda8515cda');

define('DESKTOP_URL','http://colabore.info');
define('DEFAULT_DAILY_LIMIT', 50);

/*database tables*/
define('MEMBERS_TB', 'pbz_users');
define('LANGUAGE_SITE_TB', 'fro_textes');
define('LANGUAGE_MENU_TB', 'pbz_menu_textes');
define('LANGUAGE_LIST_TB', 'pbz_langues');
define('MENU_TB', 'pbz_menus');
define('COMPANY_TB', 'pbz_societes');
define('COMPANY_USERS_TB', 'pbz_societe_users');
define('COUNTRY_TB', 'pbz_pays');
