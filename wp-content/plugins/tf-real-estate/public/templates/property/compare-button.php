<?php
if (!defined('ABSPATH')) {
   exit; // Exit if accessed directly
}
$enable_compare = tfre_get_option('enable_compare', 'y');
?>
<?php if ($enable_compare == 'y'): ?>
   <a class="tfre-compare-property hv-tool" data-tooltip="<?php esc_attr_e('Compare', 'tf-real-estate') ?>" href="javascript:void(0)" data-property-id="<?php the_ID() ?>"
      >
      <i class="fa fa-plus"></i>
   </a>
<?php endif; ?>