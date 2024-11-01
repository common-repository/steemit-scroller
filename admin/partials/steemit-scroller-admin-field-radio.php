<?php
/**
 * Provides the markup for a radio field
 *
 * @since      	1.0.1
 * @package 	Steemit-Scroller
 * @subpackage 	Steemit-Scroller/admin/partials
 */

if ( ! empty( $atts['label'] ) ) {

	?><th><label for="<?php echo esc_attr( $atts['id'] ); ?>"><?php esc_html_e( $atts['label'], 'steemit-scroller' ); ?>: </label></th><?php

}

if ( empty( $atts['value'] ) ) {
	
	$atts['value'] = '0';
	
}

?>
<td>
<fieldset>
<?php
foreach ( $atts['selections'] as $selection ) {

	if ( is_array( $selection ) ) {

		$label = $selection['label'];
		$value = $selection['value'];

	} else {

		$label = strtolower( $selection );
		$value = strtolower( $selection );

	}

	?><label>
		<input
			type="radio"
			name="<?php echo esc_attr( $atts['name'] ); ?>"
			value="<?php echo esc_attr( $value ); ?>" <?php
			checked( $atts['value'], $value ); ?>>

		<span><?php echo esc_html_e( $label, 'steemit-scroller' ); ?></span>
		<?php
		if (array_key_exists('desc', $selection)) {
			?>
			<code><?php echo esc_html_e( $selection['desc'], 'steemit-scroller' ); ?></code>
		<?php }
	?></label></br>

<?php
} // foreach

?>
<p class="description"><?php esc_html_e( $atts['description'], 'steemit-scroller' ); ?></p>
</fieldset>
</td>
