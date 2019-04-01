<nav class="main-footer" data-color="light">
    <div class="wrapper grid">
        <?php include(locate_template('template-parts/component-newsletter.php' )); ?>
    </div>
    <div class="wrapper grid">
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

                echo '<ul class="grid">';
                    insert_menu_items(wp_get_nav_menu_items('secondary'), 'xs');
                echo '</ul>';

                echo '<h4 class="fs--xs tt--uc faded">Office & Showroom</h4>';
                echo '<div class="grid">';
                    echo '<ul class="fs--xs tt--uc lh--m">';
                        echo '<li>ONE A</li>';
                        echo '<li>Hyldvej 1A 6092 </li>';
                        echo '<li>6092 / Sdr. Stenderup</li>';
                        echo '<li>Denmark</li>';
                    echo '</ul>';
                    echo '<ul>';
                        insert_menu_items(wp_get_nav_menu_items('contact'), 'xs');
                    echo '</ul>';
                echo '</div>';

            echo '</nav>';
        ?>
    </div>
</nav>