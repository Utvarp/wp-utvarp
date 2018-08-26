<?php

// check user capabilities
if (! current_user_can('manage_options')) {
        return;
}

?>

<div class="wrap">
    <h1>Hello, we're Útvarp!</h1>
    <p>This is a home page.</p>
</div>