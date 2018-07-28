<?php

// check user capabilities
if (! current_user_can('manage_options')) {
        return;
}

?>

<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <table border="1">
        <tr>
            <td><b><?=__('Name', 'utvarp') ?></b></td>
            <td><b><?=__('Identifier', 'utvarp') ?></b></td>
        </tr>

        <?php dd($this->api->getStationMusicalEntries("2018-07-20", "2018-07-24")); ?>

        <?php foreach ($this->api->getShows() as $show) : ?>
        <tr>
            <td><?=$show->name?></td>
            <td><?=$show->uuid?></td>
        </tr>
        <?php endforeach ?>
    </table>
</div>