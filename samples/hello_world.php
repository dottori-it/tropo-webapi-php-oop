<?php
    /**
     * A sample application that demonstrates the use of the TropoPHP package.
     *
     * @copyright 2010 Mark J. Headd (http://www.voiceingov.org)
     */
    use Tropo\Tropo;

    $tropo = new Tropo();
    $tropo->say("Hello World!");
    $tropo->renderJSON();
