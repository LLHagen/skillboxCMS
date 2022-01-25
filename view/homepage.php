<?php
include $_SERVER['DOCUMENT_ROOT'] . '/view/layout/admin_header.php';
?>

<div class="album py-5 bg-light">
    <div class="container">

        <section>
            <a href="/about">На страницу О нас</a>
            <a href="/posts">На страницу Posts</a>
            <h1><?= $title ?? 'CMS' ?></h1>
        </section>

    </div>
</div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/view/layout/admin_footer.php';
