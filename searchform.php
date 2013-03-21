<form method="get" class="search-form clear" action="<?php echo esc_url( home_url( '/' ) ); ?>">	
	<input 
		type="text" class="search-field placeholder-text" name="s"  		
		placeholder="<?php echo esc_attr( 'Search', 'telerikacademy' )?>"
	/> 
	<input type="submit" class="command-button" name="submit" value="<?php esc_attr_e( 'Search', 'telerikacademy' ); ?>" />
</form>
