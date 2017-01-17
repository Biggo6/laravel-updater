## Laravel 4.2 Self-Updater
This is a Laravel 4.2 package which supports self-update of Laravel applications.
You only need a remote webserver which holds the update files.

### Requirements
```
Laravel 4.2
PHP >= 5.4
```

### Installation
1. Run
```
composer require biggo6/laravel-updater
```
2. Add service provider to **/config/app.php** file.
```php
'providers' => [
    ...
    'Biggo6\LaravelUpdater\LaravelUpdaterServiceProvider',
],
```
3. Create a **version.json** file in the root directory.
```
{
    "version": "[your initial version]"
}
```
4. Publish config file. (optionally)
```
php artisan vendor:publish
```

### Usage
This package registers some new routes.

You can check if there is a new application version when you type `self-updater/check`
in your web browser after the base url of your application.

You can automatically update your application with the url ``self-updater/update``.

### Customizing Views

```
php artisan view:publish biggo6/laravel-updater
```
This command will move the package's views into the ``app/views/packages`` directory. If this directory doesn't already exist, it will be created when you run the command. Once the views have been published, you may tweak them to your liking! The exported views will automatically take precedence over the package's own view files.


### Remote version file
The remote version file holds the up to date version of the application. It also defines
where to find the update package.
```
{
    "version": "1.0.1",
    "file": "versions/v101.zip"
}
```

### Configuration
If you published the configuration fiels with the ``vendor:publish`` artisan command, you can
specify your own remote server.
```
'remote_uri' => env('REMOTE_UPDATE_URI', 'http://localhost')
```
You can easily set this parameter in your .env file. The URI should not have a trailing slash
and the **remote_version.json** file on the webserver must be accessible.
