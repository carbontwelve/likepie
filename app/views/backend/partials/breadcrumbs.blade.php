<div class="banner">
    <?php
        echo Menu::handler('main')
            ->breadcrumbs()
            ->setElement('ol')
            ->addClass('breadcrumb');
    ?>
</div>

