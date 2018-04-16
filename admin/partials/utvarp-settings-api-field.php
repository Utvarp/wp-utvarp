<?php
$api_key = get_option('utvarp_api_key');
?>

<p>
    <input type="text" name="utvarp_api_key" value="<?php echo isset($api_key) ? esc_attr($api_key) : ''; ?>">
</p>
