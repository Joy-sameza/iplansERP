<?php
session_start();
require_once("./include/commandes.php");
require_once("./include/config.php");
$db = new Commandes();

$title = 'accueil';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$url = $_SERVER["REQUEST_URI"];
$query = parse_url($url, PHP_URL_QUERY);
if ($query == "lang=en") {
    $_SESSION["lang"] = "en";
    include_once "./lang/en.php";
} else {
    if ($query == NULL) {
        $lanuage = $_SESSION['lang'] ?? 'fr';
        if ($lanuage == 'en') {
            include_once "./lang/en.php";
        }
        if ($lanuage == 'fr') {
            include_once "./lang/fr.php";
        }
    } else {
        $_SESSION["lang"] = "fr";
        include_once "./lang/fr.php";
    }
}
ob_start();
?>
<link rel="stylesheet" type="text/css" href="<?= SITE_URL ?>/assets/css/login.css">

    <link href="<?= SITE_URL ?>/assets/css/style.css" rel="stylesheet">
<main2 >
    <style>
		.lange{
			font-size: 25px;
            margin-top: 47px;
			display: none;
		}
		.lang{
			    margin-top: 0px!important;
				padding-top: 43px;
		}
	    .lang	img{
				height: 24px;
				width: 24px;
			}


	</style>

<link href="<?= SITE_URL ?>/assets/css/style.css" rel="stylesheet">
<main>

    <h1><u>CONNEXION</u></h1>
    <form method="post" action="">
        <div class="interface mx-4">
            <div class='container d-flex justify-content-between mb-4'>
                 <?= $lang['login'] ?> <input type="text" class='form-control' name="email" required>
            </div>
            <div class='container d-flex justify-content-between mb-4'>
                <?= $lang['pass'] ?> <input type="password" class='form-control' name="motdepasse" required>
            </div>    
        </div>
        <style>
            .interface input {
                position: center;
                border-radius: 7px;
                width: 240px;
                height: 35px;
            }
            main{
                width: 450px;
                
            }
            .envoie input {
                position: center;
                border-radius: 12px;
                width: 150px;
                height: 46px;
            }
            .bout{
                
            }
        </style>
        <div class="envoie justify-content-around text-center mt-6">

                <input type="submit" name="send1" class='bout' value="<?= $lang['se_connecter'] ?>">
           
           
                <input type="reset" value="<?= $lang['annuler'] ?>">
           
            
        </div>
    </form>
</main>
<?php
if (isset($_POST['send1'])) {
    if (!empty(($_POST['email']) and ($_POST['motdepasse']))) {
        $email = htmlspecialchars(($_POST['email']));
        $motdepasse = htmlspecialchars(($_POST['motdepasse']));
        $admin = $db->getAdmin($email, $motdepasse);
        // header("Location: " . SITE_URL . "/spider");
        // print_r($admin);
        // exit();
        if ($admin) {
            $_SESSION['login'] = $admin;
            echo "<script>
             swal({
             icon: 'success',
             text: 'Connexion avec succès...',
             timer: 1000,
             onOpen: function(){
             swal.showLoading()
             }
             }).then(function(){
                 window.open('" . SITE_URL . "/home','_self');
             });
            </script>";
        } else {
            echo "<script>
                    swal({
                        icon: 'warning',
                        text: 'Désolé! Le mot de passe ou le login est incorrects',
                    });
                </script>";
        }
    }
}
?>


<?php
$content = ob_get_clean();
include 'layout.php';
?>