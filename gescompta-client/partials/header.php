<header class="header black-bg" style="background-color: #0bbad6;">
    <!-- <nav class="navbar navbar-default"> -->
    <div class="container-fluid">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Menu de navigation"></div>
        </div>
        <!--logo start-->
        <a href="../views/accueil.php" class="logo header-title">ITLCompta</a>
        <!--logo end-->
        
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right pull-right top-menu" align="center">
                <li class="user-label">Connecté en tant que : </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle user-name-policy" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="connectedUser" role="button"></a>
                    <ul class="dropdown-menu">
                        <!-- <li><a href="../views/profil.php"><i class="fa fa-user-circle"></i><span> Profil</span></a></li> -->
                        <li><a href="parametres.php"><i class="fa fa-edit"></i><span> Changer mot de passe</span></a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="../views/lock.php" id="devLink"><i class="fa fa-lock"></i><span> Verrouiller</span></a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="../views/login.php" class="logout" id="deconnexion"><i class="fa fa-sign-out"></i><span> Déconnexion</span></a></li>
                    </ul>
                </li><br>
                <span id="descUser" style="position: relative; top: -5px;"></span>
            </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    <!-- </nav> -->
</header>
 