<?php
/**
 * A simple PSR-4 autoloader for the tropo-webapi-php library
 *
 * After registering this autoload function with SPL, the following line
 * would cause the function to attempt to load the \Tropo\Foo\Bar class
 * from <current path>/src/Foo/Bar.php:
 *
 *      new \Tropo\Foo\Bar;
 *
 * @param string $class The fully-qualified class name.
 *
 * @return void
 */
spl_autoload_register(
  function ($class) {

    // Namespace prefix
    $prefix = 'Tropo\\';

    // Base directory for the namespace prefix
    $base_dir = realpath(__DIR__).'/src/';

    // Does the requested class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
      // no, move to the next registered autoloader
      return;
    }

    // Get the relative class name
    $relative_class = substr($class, $len);

    // Replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir.str_replace('\\', '/', $relative_class).'.php';

    // if the file exists, require it
    if (file_exists($file)) {
      require $file;
    }
  }
);
