<?php
class WPML_ACF_Post_Ids implements WPML_ACF_Convertable {
	/** @var WPML_ACF_Post_Id[] $ids */
	public function convert( WPML_ACF_Field $WPML_ACF_Field) {

		$came_serialized = is_serialized($WPML_ACF_Field->meta_value);

		$ids_unpacked = (array) maybe_unserialize($WPML_ACF_Field->meta_value);
		
		$ids = array();
		foreach ($ids_unpacked as $id) {
			$ids[] = new WPML_ACF_Post_Id($id, $WPML_ACF_Field);
		}
		
		$result = array_map(function($id) {return $id->convert()->id;}, $ids);

		if (count($result) == 1 && !$came_serialized) {
			return $result[0];
		}

		if ( $came_serialized ) {
			$result = maybe_serialize( $result );
		}
		
		return $result;
		
	}
}
