<?php
    get_header();
    include(locate_template('template-parts/module-product-info.php' ));
    include(locate_template('template-parts/module-product-featured-area.php' ));
    include(locate_template('template-parts/module-product-shop.php' ));
    include_modules();
    include(locate_template('template-parts/module-product-cta.php' ));
    include(locate_template('template-parts/module-product-contact-form.php' ));
    get_footer();