# Environment Aware Wordpress wp-config File

## Summary

This is a customized Wordpress wp-config.php that allows loading of custom config files for specific environments. The supplemental config files follow the naming convention of `wp-config-{environment}.php`. 

The purpose of this approach is to eliminate code changes when moving between environments (local, dev, stage, production, etc). The environments are fully customizable and based on programatically inspecting the `$_SERVER['SERVER_NAME']` superglobal.

## Usage

### Define Your Environments
First, open the `wp-config.php` and modify the `$environments` array to reflect your environments:

```php
	$environments = array(
	    'local'       => array('.local', 'local.example.com'),
	    'development' => array('dev.example.com', 'dev.', '.dev'),
	    'staging'     => 'stage.example.com',
    );
```

Each of these environments can be either a string or an array of strings that might define multiple patterns that denote the particular environment.

### Create Your Customized wp-config-{environment}.php Files

Then create a `wp-config-{environment}.php` file in the root directory of your site for each environment that contains any variables that you need customized per each environment. Keep in mind that the environment gets assigned based on the first environment matched. The file name should be named so that the `key` in the `$environments` array is used in the `{environment}` portion of the file name. 

For example, if your environment was defined as `'stage' => 'stage.example.com'`, then your custom config would be called `wp-config-stage.php`.

Note, these variables do not have to be just Wordpress variables but can contain any site variables that need to change based on the environment (e.g. you could setup separate test suites for Google Analytics `define('GA_ACCT', 'UA-XXXXXXXX-X');`)

That's all there is to it.