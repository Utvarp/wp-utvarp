<?php

// check user capabilities
if (! current_user_can('manage_options')) {
        return;
}

?>

<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <p>Here is a list of every possible shortcodes you can now use.</p>
    <h2>Station</h2>
    <p>
        <ul>
            <li>Return a PHP array containing station informations: <code>[utvarp_get_station_infos]</code></li>
        </ul>
    </p>

    <h2>Shows</h2>
    <p>You will have to replace every instance of <code>SHOW_IDENTIFIER</code> by the corresponding value.</p>
    <p>
        <ul>
            <li>Return a show's podcast URL: <code>[utvarp_get_rss_link uuid=SHOW_IDENTIFIER]</code></li>
        </ul>
    </p>
</div>