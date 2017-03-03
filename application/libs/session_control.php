<?
session_start();

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
                    // last request was more than 30 minutes ago
                    unset($_SESSION['id']);     // unset $_SESSION variable for the run-time 
                    unset($_SESSION['email']);     // unset $_SESSION variable for the run-time 
                }
$_SESSION['LAST_ACTIVITY'] = time();