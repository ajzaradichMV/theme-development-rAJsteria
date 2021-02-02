<div class="nav">
	<div class="wrapper nav-wrapper">
        <?php
        $args = [
            'theme_location'  => 'primary',
            'container'       => 'nav',
            'container_class' => 'nav-container',
            'container_id'    => 'primary-nav',
            'menu_class'      => 'nav-list',
            'fallback_cb'     => false,
        ];
		mv_trellis_nav_menu( $args, true, 'Menu', 'template-parts/svg/menu' );
		?>
	</div>
</div>