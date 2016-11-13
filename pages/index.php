<!DOCTYPE html>
<?php  session_start(); ?>  // session starts with the help of this function

<?php

if(isset($_SESSION['use']))   // Checking whether the session is already there or not if                              // true that header redirect it to the home page directly
{
    header("Location:user_dashboard.php");
}

if(isset($_POST['email']) && isset($_POST['password']))   // it checks whether the user clicked login button or not
{
  $email = $_POST['email'];
  $password = $_POST['password'];
  $service_url = 'http:// /api/login';
  $curl = curl_init($service_url);
  $curl_post_data = array(
          'email' => $email,
          'password' => $password
  );
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
  $curl_response = curl_exec($curl);
  if ($curl_response === false) {
      $info = curl_getinfo($curl);
      curl_close($curl);
      die('error occured during curl exec. Additioanl info: ' . var_export($info));
  }
  curl_close($curl);
  $decoded = json_decode($curl_response);
  if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
      die('error occured: ' . $decoded->response->errormessage);
  }

}
 ?>


<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
    @import url(http://fonts.googleapis.com/css?family=Oswald);

      body{
        font-family: 'Oswald', sans-serif;
      }

      .btn{
        margin: 4px;
        box-shadow: 1px 1px 5px #888888;
      }

      .btn-xs{
        font-weight: 300;
      }

      .btn-hot {
      color: #fff;
      background-color: #db5566;
      border-bottom:2px solid #af4451;
      }

      .btn-hot:hover, .btn-sky.active:focus, .btn-hot:focus, .open>.dropdown-toggle.btn-hot {
      color: #fff;
      background-color: #df6a78;
      border-bottom:2px solid #b25560;
      outline: none;}


      .btn-hot:active, .btn-hot.active {
      color: #fff;
      background-color: #c04b59;
      border-top:2px solid #9a3c47;
      margin-top: 2px;
      }

      .btn-sunny {
      color: #fff;
      background-color: #f4ad49;
      border-bottom:2px solid #c38a3a;
      }

      .btn-sunny:hover, .btn-sky.active:focus, .btn-sunny:focus, .open>.dropdown-toggle.btn-sunny {
      color: #fff;
      background-color: #f5b75f;
      border-bottom:2px solid #c4924c;
      outline: none;
      }


      .btn-sunny:active, .btn-sunny.active {
      color: #fff;
      background-color: #d69840;
      border-top:2px solid #ab7a33;
      margin-top: 2px;
      }

      .btn-fresh {
      color: #fff;
      background-color: #51bf87;
      border-bottom:2px solid #41996c;
      }

      .btn-fresh:hover, .btn-sky.active:focus, .btn-fresh:focus, .open>.dropdown-toggle.btn-fresh {
      color: #fff;
      background-color: #66c796;
      border-bottom:2px solid #529f78;
      outline: none;
      }


      .btn-fresh:active, .btn-fresh.active {
      color: #fff;
      background-color: #47a877;
      border-top:2px solid #39865f;
      outline: none;
      outline-offset: none;
      margin-top: 2px;
      }

      .btn-sky {
      color: #fff;
      background-color: #0bacd3;
      border-bottom:2px solid #098aa9;
      }

      .btn-sky:hover,.btn-sky.active:focus, .btn-sky:focus, .open>.dropdown-toggle.btn-sky {
      color: #fff;
      background-color: #29b6d8;
      border-bottom:2px solid #2192ad;
      outline: none;
      }

      .btn-sky:active, .btn-sky.active {
      color: #fff;
      background-color: #0a97b9;
      border-top:2px solid #087994;
      outline-offset: none;
      margin-top: 2px;
      }

      .btn:focus,
      .btn:active:focus,
      .btn.active:focus {
        outline: none;
        outline-offset: 0px;
      }

    </style>

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center">ChildIn</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" id = "email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" id = "password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <div class = "row">
                                    <div class = "col-lg-4">
                                        <button class = "btn btn-success" id = "login">Login</button>
                                    </div>
                                    <div class = "col-lg-4">
                                        <button class = "btn btn-primary" id = "register">Register</button>
                                    </div>
                                    <div class = "col-lg-4">
                                        <button type="button" class="btn btn-hot text-uppercase" id = "donate">Donate <span class="glyphicon glyphicon-heart" aria-hidden="true"></span></button>
                                    </div>

                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <script>
      $(document).ready(function() {
        $("#login").click(function() {

            var email = $("#email").val();
            var password = $("#password").val();


            console.log(email +  " " + password);

            $.ajax({
              url : "index.php"
              data : {'email' : email, 'password' : password},
              method : "POST",
              success : function(data) {
                if(data) {
                  <?php  session_start(); ?>  // session starts with the help of this function
                }
              }

            })

            //TODO write ajax calls and in success send to dashboard.html or user_dashboard.html



        });

        $("#register").click(function() {
          window.location = "register.html";
        });

        $("#donate").click(function() {
          //TODO
          window.location = "https://www.onlinesbi.com/prelogin/icollecthome.htm?corpID=642804";
        })
      })

    </script>

</body>

</html>
