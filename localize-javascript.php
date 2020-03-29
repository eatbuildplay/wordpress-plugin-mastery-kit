<?php 

// the key to this working is to ensure that you use the correct script handle which is the handle defined during the script enqueue
// to debug ensure the timing is correct, the enqueue script call must happen before the localize script call otherwise it will silently fail because the script does not exist with the defined handle
wp_localize_script( 'script-handle', 'objectVariableName', $data );
