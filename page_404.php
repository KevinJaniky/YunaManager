<?php
require_once "fonction.php";
head('Page Not Found - YunaHotel');
?>
<style>
    #page404 {
        background: white;
    }

    html, body, .page_404 {
        height: 100%;
    }

    .code_error {
        text-align: center;
        position: relative;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .code_error span:first-child {
        font-size: 14vw;
        display: block;
    }
    a{
        display: block;
        color: #1b6d85 !important;
    }
</style>
<body id="page404">
<div class="container-fluid">
    <div class="page_404">
        <div class="code_error">
            <span>404</span>
            <span>Page Not Found</span>
            <a href="index.php">Retourner a l'accueil</a>
        </div>
    </div>
</div>
</body>
<?php
footer();
?>


