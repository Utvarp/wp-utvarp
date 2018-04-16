<?php
$uuid = get_option('utvarp_station_uuid');
?>

<p>
    <input type="text" name="utvarp_station_uuid" value="<?php echo isset($uuid) ? esc_attr($uuid) : ''; ?>">
</p>
