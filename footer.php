<?php

/**
 * The template for displaying the footer.
 */
?>
<footer class="site-footer">
    <div class="container">
        <div class="grid grid-middle footer-grid grid-spaceBetween">
            <?php
            get_template_part('templates-parts/footer/f-brand');
            get_template_part('templates-parts/footer/f-navs');
            ?>
        </div>
        <?php get_template_part('templates-parts/footer/f-info'); ?>
    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>