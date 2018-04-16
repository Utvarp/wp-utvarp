<?php
$use_staging = get_option('utvarp_stage_api');
?>

<p>
    <input type="radio" name="utvarp_stage_api" value="0" <?=$use_staging == "0" ? "checked" : "" ?>> <?=__('No', 'utvarp')?><br>
    <input type="radio" name="utvarp_stage_api" value="1" <?=$use_staging == "1" ? "checked" : "" ?>> <?=__('Yes', 'utvarp')?><br>
</p>
