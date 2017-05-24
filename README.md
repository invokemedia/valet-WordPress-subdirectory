# Valet WordPress SubDirectory

Use WordPress in a subdirectory.

### Requirements

Make sure your WordPress code is in the root directory of your site and is called `wordpress/`.

## UPDATE:

You can now set the sub directory in the constructor function of the class code, rather than the sub directory needing to be `wordpress/`.

The sub directory can be anything you like (personally, I use `public/`). All you need to do is change the value of `$this->subfolder = 'public';`

### Installation

Just move `WordpressSubDirectoryValetDriver.php` into `~/.valet/Drivers`.