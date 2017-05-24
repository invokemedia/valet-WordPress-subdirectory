# Valet WordPress SubDirectory

Use WordPress in a subdirectory.

### Requirements

Make sure your WordPress code is in the root directory of your site and is called `wordpress/`.

### Changing the WordPress install directory:

You can set the sub directory in the constructor function of the class code, rather than the sub directory needing to be `wordpress/`.

All you need to do is change the value of `$this->subfolder = 'public';` to something else. Note the **missing trailing slash**.

### Installation

Just move `WordpressSubDirectoryValetDriver.php` into `~/.valet/Drivers`.
