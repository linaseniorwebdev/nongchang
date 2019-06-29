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

defined('ALIPAY_APPID')        OR define('ALIPAY_APPID', 2019052065249037);     // AppID
defined('ALIPAY_SIGN_TYPE')    OR define('ALIPAY_SIGN_TYPE', 'RSA2');           // Sign Type
defined('ALIPAY_RSA_PRIVATE')  OR define('ALIPAY_RSA_PRIVATE', 'MIIEpAIBAAKCAQEA6VJBGzhm+HxBVjk2Vf6saGe0dPI0jWx9WFxBzgmmvHiEk/IozChxNIo69o0m5MnWbbgmjw6Isf2mk943FD8sshLo8kuhC0kk0SEdj6LFGIqYUr5gCBY7/fZMHIWxZ8HV59a2jebF0uy1o92ZDjFKCrteT9xkHHqPfbkvi5zaJpAYZsdURxme3nTLS5q8uLkXpl2IG1M+wS6GOPCHx6Z1BksFztnXR14lX7wFQFq8BKg/rdoX+tWAkMGunfoShxZOX7wuASTngLnozX61+18U+8/I+jrLlDdDokeLgUy3pMe7fy1rlSiEUSL3+Q7LXpQb3GEkTOZFKMzq96WuRU47WwIDAQABAoIBAQDieoxmHr6dDwfg6VIb8URrZ9bb+csXSCr3nT3nAKlPovCWJ2aAnfUdGdyYPHV3eZBiGnGbRXFczKloOThft97rz708jDr7mHlbYniuV0JYSxgGoXLYBrUfFHfW69NDsvyuuVWkslBuKIU8Vbre8us7NZsbjAPFPRaR5DMJoyyCZlv4G85yOdsZK8S0BbYs82wDlhakaTUONrsPrv2iQGuwV561HSEJa5/uUcjksYHarUqmh6UnUtKZ3xtei59yJ6NXav6GbVezetpHD7JZChNfdGUxnnYKUeRiPYiydMVeNxousECuUJm/s8LJIbFnv1Tz2sDE9gW3m7k9FxDBG49pAoGBAP0LoJvOjqjKrvFTUBE8oXpvojsc5YT3ohcE8ff2mRA5UmuWtd8uOeHv74y5bThbIXFdabF7nnKIqYnxbbHd3uSAAfTmJsA79li3O8OX8WLaFyMTBA55/VrS9sPOr3KZINYviEdDJJJQO4SL2BQdZNpBcg9F4w8S0JkE9s+NNRmVAoGBAOwLq4Z4TuYMeC5DBQGJJf0dWsVqkVeVNeil5C6L53UxNXfm5HRW4u3SaLfHE3n6rqTuEvvSxyAzwAYyMTzDDjlLIM/7vs7NFvxTkP+sYbS/1VaKrbUs9pParywRzhqrsFOvFNo3YMePGfoUwXTQLH8y8QcAChgOAPwatOYdbCUvAoGABaQdt3t6WK70CXM3BLtaSjV042Z4g2dV2LeGgWWg8eilOrrIYSpRpgTITVXQ5oG5lCJl+cvss1bymJ2mOWHd1zA3WvNKh9yOWFn1Xh3kBrUf8Os6muwDRuQPFjxkUuSxA7VZj2UiypQ5T3IipggluGvfFBIVxr8/oTmoGuZl+aUCgYEA4jHksr2DTexRFnPezjPxFXcVzuxqTvWLbV/bI8epi6IWTMoTznCcka3573Jz9YYF6cLCqlK3wuIUd1uN115LuReHYAcsN9xM1Iv3/Snhj2XtODs4bs+hktoS1zZQvTodhHPYlaxPr6wwBnfxUtFScqoMUtr00UxKIUwuYf177r0CgYBuD+5ExC9ictureUHPEXkdqXMmV5aTtG90uxfcsU75RLY5SQ5CJgaTmGblc7Dd/0DPBAtpFWVwB/LO+1UMWPFL2L146J6GOMMDQmrpXn6Hn7N/LZOwGyIDKP1eQj6kPI1A4lAjNvMxVYgoCHPOTm8Ve5kaYoaThvt91fuYspouHQ==');
defined('ALIPAY_RSA_PUBLIC')   OR define('ALIPAY_RSA_PUBLIC', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiNV/D+wO81OdITQTwnSjoUhk6tieE/6BFirb8C7zGDoaLyN7YynDpPmdNnByEJ4hta4sBwrbXDFhvgFcSQe0feMz78Vr4c3s48dEOx/MVNB36HKkYiyLx1JNkq1RqR0sEfB1ftEJXKLHUvVir2bbbIDJYDvH80U7V9a2rMHHpSTeHuGam7SpzVsF+kI3/g8DrQsZ4zzLwXPXwXyi/G8vRV8Drr3vj+dBUoVGMxWrYBf3hHoU2/1xcN2oWE17ZzT5njyDdth7OFVBw7K7n+Q/TiY7wfn6zzcht0nySP1s5IMRHK6+FNPcO+WmiZTgfL+u7WGD3pNJ+OF3qaWHQLruJwIDAQAB');
// defined('ALIPAY_RSA_PUBLIC')   OR define('ALIPAY_RSA_PUBLIC', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAp8nUuY2l1C5puMb6lCbd7YOpu10hqsZEBkjOCVAfKRqFcdaJUA0yFb6IJeHAYZCtRMWNUECxq3z3wxLJMd6K9/1jVdKSMbH1857Gr1HT6NVIIVZe0vk5Tew61/ZhAFZNy9o2Sd6M6Rkm9VBrsuDqa+Tidxilmd+4y9rZ8c2u/XX+ellzCEW4KNMhR5Tw39mQtbqLwrHc/WWUspF8pFjm9y0Zy50STOKgtoU2APBTSI/5HABSnslv28f5c1D3xwo1LBhlTDjxjFpbC2PoeEZ/TeI6A5+OBqTRVYDHZspKQb58uP2rZOnXXEdwtNo4Jm6tyg3HDooY91Aa08w8HNf+1QIDAQAB');
