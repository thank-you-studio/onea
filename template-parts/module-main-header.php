<header class="main-header" data-color="dark">
    <div class="bg-layer"></div>
    <div class="bg-layer"></div>
    <ul class="menubar" role="menubar" aria-label="Primary Menu">
        <li>
            <?php include(locate_template('template-parts/component-logotype.php' )); ?>
        </li>
        <li>
            <?php include(locate_template('template-parts/component-monogram.php' )); ?>
        </li>
        <li>
            <?php include(locate_template('template-parts/component-menu-link.php' )); ?>
        </li>
    </ul>
    <nav class="language-switcher">
        <ul class="fw--medium">
        <?php
            insert_language_items(icl_get_languages('skip_missing=1&orderby=name&order=asc&link_empty_to=str'),'s');
        ?>
        </ul>
    </nav>
    <nav class="main-nav">
        <div class="grid">
            <?php
                echo '<nav class="col product-menu">';
                insertProductMenu();
                echo '</nav>';
                echo '<nav class="col primary-menu">';

                    echo '<ul>';
                        insert_menu_items(wp_get_nav_menu_items('primary'));
                    echo '</ul>';

                echo '</nav>';

                echo '<nav class="col secondary-menu">';

                    echo '<ul>';
                        insert_menu_items(wp_get_nav_menu_items('secondary'), 'xs', 'from-opposite');
                    echo '</ul>';

                echo '</nav>';
            ?>
        </div>
    </nav>
</header>