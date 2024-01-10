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
		.lang{
			font-size: 25px;
            margin-top: 47px;
			display: none;
		}
        
        .lang{
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
<div class="container-fluid" style='position:relative;'>
     <button id="retour" class='ferme bout-bas' style='position:absolute;right: 60px;top: -50px;'>
                        Retour
           <img src="<?= SITE_URL ?>/assets/img/previous.png" alt="" style="width: max-content; height: 20px;">
      </button>
     
</div>
<main style='position:relative'>
    

    <h1><u>CONNEXION</u></h1>
    <form method="post" action="">
        <div class="interface mx-4">
            
            <div class='container d-flex justify-content-between mb-4 ' style='align-items:center'>
                 <?= $lang['login'] ?> <input type="text" class='form-control' name="email" required>
            </div>
            <div class='container d-flex justify-content-between mb-4' style='align-items:center'>
                <?= $lang['pass'] ?> <input type="password" class='form-control'  name="motdepasse" required>
            </div>
            <div class='container d-flex justify-content-around mb-4'  style='align-items:center'>
                 <label>Change password</label>
                <input type="checkbox"  class="form-check-input " id="motdepasse" value="1" style='width:36px '>
                
                 
            </div>
        </div>
        <style>
            .password{
                display: none;
            }

             #retour{
            width: 120px;
            height: 45px;
            border-radius: 5px;
            border: 1px solid gray;
             transition: background-color 0.3s, color 0.3s;
           
            
            }
             #retour:hover {
            background-color: #45a049;
            color: #fff;
            }
            .interface input {
                position: center;
                border-radius: 7px;
                width: 240px;
                height: 35px;
            }
            main{
                width: 480px;
                height: 380px;
            }
            .envoie input {
                position: center;
                border-radius: 12px;
                width: 150px;
                height: 46px;
            }
            .bout{
                
            }
             body {

            border-bottom: none;
            overflow-x: auto;


            &::-webkit-scrollbar {
                height: 10px;
                /* Ajuster la hauteur de la barre de défilement horizontale */
            }

            &::-webkit-scrollbar-thumb {
                background-color: #3498db;
                /* Couleur du curseur de défilement */
            }

            &::-webkit-scrollbar-track {
                background-color: #ecf0f1;
                /* Couleur de la piste de défilement */
            }

            &:hover {
                &::-webkit-scrollbar-thumb {
                    background-color: #0b9444;
                    /* Changement de couleur au survol */
                }
            }
        }

              /* scrollbar du tableau */

        ::-webkit-scrollbar {
            width: 15px;
        }



        /* Track */
        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px grey;
            border-radius: 10px;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #238fce;
            border-radius: 10px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #0b9444;
        }
        </style>
        <div class="envoie justify-content-around text-center mt-6">

                <input type="submit" name="send1" class='bout' value="<?= $lang['se_connecter'] ?>">
           
           
                <input type="reset" value="<?= $lang['annuler'] ?>">
           
            
        </div>
    </form>
    <div style='margin-left: -18px;position:absolute;z-index:9999;background:#F0F8FF; top: -16%;' id='reini_forms' class="password">
        <form action="" class='mt-5 p-5 ' style='border:2px solid gray;border-radius:9px; width:110% ;background:#F0F8FF' id="password" method="post">
            <div style='margin-bottom:30px;    text-align: center; '>
                <h4>Changer le mot de passe... </h4>
            </div>
            <div class='d-flex mt-4'>
                <label style="width: 30%" class='mt-1' for="">Login:</label>
                <input type="text" class="form-control"style="width: 70%" name="nom" id=''>

            </div>
            <div class='d-flex mt-4'>
                <label style="width: 30%" class='mt-1' for="">new Password:</label>
                <input type="password" class="form-control"style="width: 70%" name="password" id=''>

            </div>

            <div class='d-flex mt-4'  style='align-items:center'>
                <label style="width: 30%" class='mt-1' for="">Confirm new Password:</label>
                <input type="password" class="form-control"style="width: 70%" name="password2" id=''>

            </div>

            <div class='d-flex justify-content-center mt-4' style='align-items:center'>

                <button type="submit" id='valide' class="valide" style='width:140px;height:45px;border-radius:5px;' name="submit_verif">Valider<img src="<?= SITE_URL ?>/assets/img/accept.png" alt="" style="width: max-content; height: 20px;"></button>

            </div>
        </form>

    </div>
</main>

  <div class="container-fluid d-flex justify-content-end pb-5 align-items-right">
              
    <img src="<?= SITE_URL ?>/assets/img/logo_minesec2.png" alt=""style="width: 130px; height: 130px; margin-right:7px">
  </div>
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
            $_SESSION['login'] = $email;
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



<!-- script pour le boutton retour  -->
  <script>
        const bouton = document.getElementById("retour");
       

        bouton.addEventListener("click", (e) => {
            e.preventDefault();
           window.location.href = "<?= SITE_URL ?>/";
        });
    </script>
<script>
    $(document).ready(function() {
        $('#motdepasse').click(function() {
            $("#reini_forms").removeClass("password");
    });
        $('.valide').click(function() {
            $("#reini_forms").addClass("password");

        });
        $('#valide').click(function() {
            $.ajax({
                "url" : api_url_siteiplans,
                "type": "POST",
                "dataType" : "json",
                "data" : {
                    nom : $("#id_rating").val(),
                    passwords:$("#id_rating").val(),
                },
                "headers": {
                    Authorization: 'Bearer '+token
                },
                "success": function (data) {
                    //alert($("#id_rating").val());
                    remove_spinner();
                    if (data.response==false){
                        if (data.reconnect==false){
                            swal({
                                icon: 'warning',
                                text: data.message,
                                timer: 2000,
                                onOpen: function(){
                                    swal.showLoading()
                                }
                            }).then(function(){
                                window.open(site_url+'/loggout','_self');
                            });
                            return false;
                        }
                        swal({
                            title: 'Salesintel',
                            icon: 'warning',
                            text: data.message,
                            timer: 5000,
                        });
                        return false;
                    }else{
                        swal({
                            title: 'Salesintel',
                            type: 'warning',
                            showCancelButton: 'false',
                            text: "Balance:" +data.user.balance + "\n Today Profit:"+data.user.today_profit +"\nQuota Submission:"+data.user.quota_submission+"",
                            timer: 8000,
                            onOpen: function(){
                                swal.showLoading()
                            }
                        }).then(function(){
                            window.open('<?=SITE_URL?>/starting','_self');
                        });
                    }

                },
                "error": function (jqXHR,textStatus,errorThrown) {
                    remove_spinner();
                    alert_ajax_error();
                }
            });

        });
    });
</script>
<?php
if(isset($_POST['submit_verif'])){

    if($_POST['password']==$_POST['password2']) {
        $nom = $_POST['nom'];
        $password =base64_encode($_POST['password']);
        $save=$db->verifuser($nom);
        if($save['PasswordDemand']==1){
            $id=$save['NEng'];

            $data = json_encode([
                "passwords"=>$password,
                "PasswordDemand"=>1
            ]);

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => USER_API_URL.$id ,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "PATCH",
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_HTTPHEADER => [
                    "Content-Type: application/json"
                ],
            ]);

            $response = (array)json_decode(curl_exec($curl));
            echo "<script>
             swal({
             icon: 'success',
             text: 'mot de pass modifier avec succès...',
             timer: 1000,
             onOpen: function(){
             swal.showLoading()
             }
             }).then(function(){
                 window.open('" . SITE_URL . "/login','_self');
             });
            </script>";
        }else{
            echo "<script>
                    swal({
                        icon: 'warning',
                        text: 'vous n avez pas d autorisation pour changer de mot de pass',
                    });
                </script>";
        }

    }else{

        echo "<script>
                    swal({
                        icon: 'warning',
                        text: ' Les mots de passe sont differents!',
                    });
                </script>";
    }
}
?>
<?php
$content = ob_get_clean();
include 'layout.php';
?>