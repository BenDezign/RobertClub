<?php
session_start();
/**
 * Created by IntelliJ IDEA.
 * User: Ben
 * Date: 2019-03-07
 * Time: 14:16
 */
require_once('config/config.inc.php');
require_once('index.ctl.php');
require_once('controller/' . $Muscucle . '.ctl.php');
?>

<!doctype html>
<html lang=fr>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo (isset($Muscutitle)) ? $Muscutitle : "Mon Projet "; ?></title>

    <link href="<?php echo __ASSET_DIR__; ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?php echo __ASSET_DIR__; ?>css/datatables.css" rel="stylesheet">
    <link href="<?php echo __ASSET_DIR__; ?>css/labelholder.css" rel="stylesheet">
    <link href="<?php echo __ASSET_DIR__; ?>css/select2.css" rel="stylesheet">
    <link href="<?php echo __ASSET_DIR__; ?>css/fontawesome-all.css" rel="stylesheet" type="text/css">

</head>
<body id="page-top">
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Ma fédération</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="<?php echo __SITE_DIR__; ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
               aria-expanded="true" aria-controls="collapseTwo">
                <span>Clubs</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Gestion des clubs</h6>
                    <a class="collapse-item" href="<?php echo __SITE_DIR__; ?>liste-clubs">Liste des clubs</a>
                    <a class="collapse-item" href="<?php echo __SITE_DIR__; ?>clubs">Ajouter un clubs</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
                <span>Adherents</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Gestions des adherents</h6>
                    <a class="collapse-item" href="<?php echo __SITE_DIR__; ?>liste-adherents">Liste des adherents</a>
                    <a class="collapse-item" href="<?php echo __SITE_DIR__; ?>adherents">Ajouter un adherents</a>
                </div>
            </div>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

    </ul>
    <!-- End of Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                             aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                           placeholder="Search for..." aria-label="Search"
                                           aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>


                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Teboul Benjamin</span>
                            <img class="img-profile rounded-circle"
                                 src="https://www.gravatar.com/avatar/7fa6185e7383523d42b043fb05a656b9?d=https%3A%2F%2Fui-avatars.com%2Fapi%2FTeboul+Ben%2F200%2F293a59%2Fd0a902&s=200">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Settings
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Activity Log
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->


            <div class="container-fluid">

                <?php
                if (isset($_SESSION['success'])) {
                    echo '<div class="alert alert-success">';
                    echo $_SESSION['success'];
                    echo '</div>';
                    unset($_SESSION['success']);
                }
                if (isset($_SESSION['error'])) {
                    echo '<div class="alert alert-danger">';
                    echo $_SESSION['error'];
                    echo '</div>';
                    unset($_SESSION['error']);
                }
                require_once('vue/' . $Muscucle . '.php');

                ?>
            </div>
        </div>
    </div>
</div>
</body>
<script src="<?php echo __ASSET_DIR__; ?>js/jquery.min.js"></script>
<script src="<?php echo __ASSET_DIR__; ?>js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo __ASSET_DIR__; ?>js/jquery.easing.min.js"></script>
<script src="<?php echo __ASSET_DIR__; ?>js/sb-admin-2.min.js"></script>
<script src="<?php echo __ASSET_DIR__; ?>js/datatables.min.js"></script>
<script src="<?php echo __ASSET_DIR__; ?>js/labelholder.js"></script>
<script src="<?php echo __ASSET_DIR__; ?>js/select2.js"></script>
<script src="<?php echo __ASSET_DIR__; ?>js/Chart.min.js"></script>
<script>
    $(document).ready(function () {
        $('table').not('.NoDataTable').dataTable({
            "dom": 'lfrtip',
            "responsive": true,
            'order': [[0, 'desc']],
            "oLanguage": {
                "sProcessing": "Traitement en cours...",
                "sSearch": "Rechercher&nbsp;: ",
                "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
                "sInfo": "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                "sInfoEmpty": "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                "sInfoPostFix": "",
                "sLoadingRecords": "Chargement en cours...",
                "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
                "sEmptyTable": "Aucune donnée disponible dans le tableau",
                "oPaginate": {
                    "sFirst": "Premier",
                    "sPrevious": "Pr&eacute;c&eacute;dent",
                    "sNext": "Suivant",
                    "sLast": "Dernier"
                },
                "oAria": {
                    "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                    "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
                }
            }
        });
        $('.labelholder').labelholder() ;
        $('.select2').select2();
        $('[data-toggle="popover"]').popover({
            container: 'body' ,
            trigger: 'hover'
        }) ;
    });

</script>
<?php
@include('assets/js/' . $Muscucle . '-js.php');

?>

</html>