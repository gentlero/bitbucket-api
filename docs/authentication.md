## Authentication

----
Although you can access any public data without authentication, you need to authenticate before you can access certain features like (_but not limited to_) accesing data from a private repository, or give access to a repository.
Bitbucket provides Basic and OAuth authentication.

### Basic authentication
To use basic authentication, you need to instantiate `Basic` class from `Bitbucket\API\Authentication` namespace and pass it to `setCredentials()` method, before making first request.
 
```php
$auth = new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass);

$user = new Bitbucket\API\User();
$user->setCredentials($auth);

// some code

$invitation = new Bitbucket\API\Invitations();
$invitation->setCredentials($auth);
```

If you need to change credentials, two methods are available for this:
```php
$auth->setUsername('username');
$auth->setPassword('password');
```

----

### OAuth authentication
Soon
