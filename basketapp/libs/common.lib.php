<?php 

require_once($ROOT.'libs/defines.lib.php');

/**
 * DEFINES VARIABLES & CONSTANTS
 * Overview:
 *    PMA_THEME_VERSION        (int)    - phpMyAdmin theme version integer
 *    PMA_THEME_GENERATION     (int)    - phpMyAdmin theme generation integer
 *    PMA_PHP_INT_VERSION      (int)    - eg: 30017 instead of 3.0.17 or
 *                                        40006 instead of 4.0.6RC3
 *    PMA_IS_WINDOWS           (bool)   - mark if phpMyAdmin running on windows
 *    PMA_IS_IIS               (bool)   - true is phpMyAdmin is running
 *                                        on Microsoft IIS server
 *    PMA_IS_GD2               (bool)   - true if GD2 is present
 *    PMA_USR_OS               (string) - the plateform (os) of the user
 *    PMA_USR_BROWSER_AGENT    (string) - the browser of the user
 *    PMA_USR_BROWSER_VER      (double) - the version of this browser
 */


if (!defined('PMA_THEME_VERSION')) {
    define('PMA_THEME_VERSION', 1);
}

if (!defined('PMA_THEME_GENERATION')) {
    define('PMA_THEME_GENERATION', 1);
}

// php version
if (!defined('PMA_PHP_INT_VERSION')) {
    if (!preg_match('@([0-9]{1,2}).([0-9]{1,2}).([0-9]{1,2})@', phpversion(), $match)) {
        $result = preg_match('@([0-9]{1,2}).([0-9]{1,2})@', phpversion(), $match);
    }
    if (isset($match) && !empty($match[1])) {
        if (!isset($match[2])) {
            $match[2] = 0;
        }
        if (!isset($match[3])) {
            $match[3] = 0;
        }
        define('PMA_PHP_INT_VERSION', (int)sprintf('%d%02d%02d', $match[1], $match[2], $match[3]));
        unset($match);
    } else {
        define('PMA_PHP_INT_VERSION', 0);
    }
    define('PMA_PHP_STR_VERSION', phpversion());
}

// Whether the os php is running on is windows or not
if (!defined('PMA_IS_WINDOWS')) {
    if (defined('PHP_OS') && stristr(PHP_OS, 'win')) {
        define('PMA_IS_WINDOWS', 1);
    } else {
        define('PMA_IS_WINDOWS', 0);
    }
}

// Whether the Web server php is running on is IIS
if (!defined('PMA_IS_IIS')) {
    if (isset($_SERVER['SERVER_SOFTWARE'])
    && stristr($_SERVER['SERVER_SOFTWARE'], 'Microsoft/IIS')) {
        define('PMA_IS_IIS', 1);
    } else {
        define('PMA_IS_IIS', 0);
    }
}

// Determines platform (OS), browser and version of the user
// Based on a phpBuilder article:
//   see http://www.phpbuilder.net/columns/tim20000821.php
if (!defined('PMA_USR_OS')) {
    if (!empty($_SERVER['HTTP_USER_AGENT'])) {
        $HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];
    } else if (!isset($HTTP_USER_AGENT)) {
        $HTTP_USER_AGENT = '';
    }

    // 1. Platform
    if (strstr($HTTP_USER_AGENT, 'Win')) {
        define('PMA_USR_OS', 'Win');
    } else if (strstr($HTTP_USER_AGENT, 'Mac')) {
        define('PMA_USR_OS', 'Mac');
    } else if (strstr($HTTP_USER_AGENT, 'Linux')) {
        define('PMA_USR_OS', 'Linux');
    } else if (strstr($HTTP_USER_AGENT, 'Unix')) {
        define('PMA_USR_OS', 'Unix');
    } else if (strstr($HTTP_USER_AGENT, 'OS/2')) {
        define('PMA_USR_OS', 'OS/2');
    } else {
        define('PMA_USR_OS', 'Other');
    }

    // 2. browser and version
    // (must check everything else before Mozilla)

    if (preg_match('@Opera(/| )([0-9].[0-9]{1,2})@', $HTTP_USER_AGENT, $log_version)) {
        define('PMA_USR_BROWSER_VER', $log_version[2]);
        define('PMA_USR_BROWSER_AGENT', 'OPERA');
    } else if (preg_match('@MSIE ([0-9].[0-9]{1,2})@', $HTTP_USER_AGENT, $log_version)) {
        define('PMA_USR_BROWSER_VER', $log_version[1]);
        define('PMA_USR_BROWSER_AGENT', 'IE');
    } else if (preg_match('@OmniWeb/([0-9].[0-9]{1,2})@', $HTTP_USER_AGENT, $log_version)) {
        define('PMA_USR_BROWSER_VER', $log_version[1]);
        define('PMA_USR_BROWSER_AGENT', 'OMNIWEB');
    //} else if (ereg('Konqueror/([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version)) {
    // Konqueror 2.2.2 says Konqueror/2.2.2
    // Konqueror 3.0.3 says Konqueror/3
    } else if (preg_match('@(Konqueror/)(.*)(;)@', $HTTP_USER_AGENT, $log_version)) {
        define('PMA_USR_BROWSER_VER', $log_version[2]);
        define('PMA_USR_BROWSER_AGENT', 'KONQUEROR');
    } else if (preg_match('@Mozilla/([0-9].[0-9]{1,2})@', $HTTP_USER_AGENT, $log_version)
               && preg_match('@Safari/([0-9]*)@', $HTTP_USER_AGENT, $log_version2)) {
        define('PMA_USR_BROWSER_VER', $log_version[1] . '.' . $log_version2[1]);
        define('PMA_USR_BROWSER_AGENT', 'SAFARI');
    } else if (preg_match('@Mozilla/([0-9].[0-9]{1,2})@', $HTTP_USER_AGENT, $log_version)) {
        define('PMA_USR_BROWSER_VER', $log_version[1]);
        define('PMA_USR_BROWSER_AGENT', 'MOZILLA');
    } else {
        define('PMA_USR_BROWSER_VER', 0);
        define('PMA_USR_BROWSER_AGENT', 'OTHER');
    }
}


function PMA_setFontSizes()
{
    global $font_size, $font_biggest, $font_bigger, $font_smaller, $font_smallest;

    // IE (<7)/Opera (<7) for win case: needs smaller fonts than anyone else
    if (PMA_USR_OS == 'Win'
        && ((PMA_USR_BROWSER_AGENT == 'IE' && PMA_USR_BROWSER_VER < 7)
        || (PMA_USR_BROWSER_AGENT == 'OPERA' && PMA_USR_BROWSER_VER < 7))) {
        $font_size     = 'x-small';
        $font_biggest  = 'large';
        $font_bigger   = 'medium';
        $font_smaller  = '90%';
        $font_smallest = '7pt';
    }
    // IE6 and other browsers for win case
    else if (PMA_USR_OS == 'Win') {
        $font_size     = 'small';
        $font_biggest  = 'large';
        $font_bigger   = 'medium';
        $font_smaller  = (PMA_USR_BROWSER_AGENT == 'IE')
                        ? '90%'
                        : 'x-small';
        $font_smallest = 'x-small';
    }
    // Some mac browsers need also smaller default fonts size (OmniWeb &
    // Opera)...
    // and a beta version of Safari did also, but not the final 1.0 version
    // so I remove   || PMA_USR_BROWSER_AGENT == 'SAFARI'
    // but we got a report that Safari 1.0 build 85.5 needs it!

    else if (PMA_USR_OS == 'Mac'
                && (PMA_USR_BROWSER_AGENT == 'OMNIWEB' || PMA_USR_BROWSER_AGENT == 'OPERA' || PMA_USR_BROWSER_AGENT == 'SAFARI')) {
        $font_size     = 'x-small';
        $font_biggest  = 'large';
        $font_bigger   = 'medium';
        $font_smaller  = '90%';
        $font_smallest = '7pt';
    }
    // ... but most of them (except IE 5+ & NS 6+) need bigger fonts
    else if ((PMA_USR_OS == 'Mac'
                && ((PMA_USR_BROWSER_AGENT != 'IE' && PMA_USR_BROWSER_AGENT != 'MOZILLA')
                    || PMA_USR_BROWSER_VER < 5))
            || PMA_USR_BROWSER_AGENT == 'KONQUEROR') {
        $font_size     = 'medium';
        $font_biggest  = 'x-large';
        $font_bigger   = 'large';
        $font_smaller  = 'small';
        $font_smallest = 'x-small';
    }
    // OS/2 browser
    else if (PMA_USR_OS == 'OS/2'
                && PMA_USR_BROWSER_AGENT == 'OPERA') {
        $font_size     = 'small';
        $font_biggest  = 'medium';
        $font_bigger   = 'medium';
        $font_smaller  = 'x-small';
        $font_smallest = 'x-small';
    }
    else {
        $font_size     = 'small';
        $font_biggest  = 'large';
        $font_bigger   = 'medium';
        $font_smaller  = 'x-small';
        $font_smallest = 'x-small';
    }

    return TRUE;
} // end of the 'PMA_setFontSizes()' function

?>