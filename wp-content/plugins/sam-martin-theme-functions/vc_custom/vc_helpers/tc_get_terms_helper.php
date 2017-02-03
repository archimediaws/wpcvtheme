<?php
function sam_martin_get_terms($args = array(), $args2 = ''){
	$return_data = array();
	
	if( !empty($args2) ){
		$result = get_terms( $args, $args2 );
	}else{
		$args['hide_empty'] = false;
		$result = get_terms( $args );
	}	
	if ( is_wp_error( $result ) ) {
		return $return_data;
	}
	
	if ( !is_array( $result ) || empty( $result ) ) {
		return $return_data;
	}
	
	foreach ( $result as $term_data ) {
		if ( is_object( $term_data ) && isset( $term_data->name, $term_data->term_id ) ) {
			$return_data[ $term_data->name ] = $term_data->term_id;
		}
	}
	return $return_data;
}