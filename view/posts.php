<?php
include $_SERVER['DOCUMENT_ROOT'] . '/view/layout/admin_header.php';
?>

<div class="album py-5 bg-light">
    <div class="container">

        <section>
            <a href="/about">На страницу О нас</a>
            <h1><?= $title ?? 'CMS' ?></h1>
        </section>

        <section>
            <?php
            if (!empty($posts)) {
                foreach ($posts as $post) {
                    var_dump('<p>' . $post . '</p>');
                }
            }
            ?>
        </section>

    </div>
</div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/view/layout/admin_footer.php';
