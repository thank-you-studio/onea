
</div>
</main>
<script src="http://sdks.shopifycdn.com/buy-button/0.1.34/buybutton.js"></script>
<?php
    include(locate_template('template-parts/module-main-footer.php' ));
    wp_footer();
?>
<?php
if ( $_SERVER["HTTP_HOST"] === 'onea.wp' || $_SERVER["SERVER_ADDR"] === '127.0.0.1' ) {
    echo '<div class="wrapper">';
    var_dump(get_fields(get_the_ID()));
    echo '</div>';
}
?>
</body>
</html>
