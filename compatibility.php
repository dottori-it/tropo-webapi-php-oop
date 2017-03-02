<?php
    /*
     * Runs checks for common issues that can affect performance of the library.
     */

    echo "\n\n======================================================\n";
    echo "Begin Tropo WebAPI compatibility check.\n\n";

    // Check to see if errors/warnings are displayed.
    if (ini_get('display_errors') == 0) {
        echo "OK Display errors: disabled.\n";
    } else {
        echo "WARNING Display errors: Errors are displayed. This may cause issues with how JSON is rendered for Tropo.\n";
    }

    echo "\n======================================================\n\n";
