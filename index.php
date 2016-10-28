<?
ini_set('display_errors', 1);
require_once 'application/bootstrap.php';
?>

    

<?
    session_start();   
    include('include/session_lifetime.php');
?>

    <?
    include_once "include/ez_sql_core.php";

    // Include ezSQL database specific component
    include_once "include/ez_sql_mysql.php";
    include_once "../conf";

    // Initialise database object and establish a connection
    // at the same time - db_user / db_password / db_name / db_host
    // $db = new ezSQL_mysql($db_user,$db_password,$db_name,$db_host);

    // $var2 = $db->get_results("SELECT user_login, user_email, meta_value AS 'last name' FROM wp1_users AS u, wp1_usermeta AS m WHERE meta_key='last_name' AND u.ID=m.user_id");
    // $db->debug();

    ?>