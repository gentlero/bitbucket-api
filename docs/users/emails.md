## Users emails

----
An account can have one or more email addresses associated with it. Use this end point to list, change, or create an email address.

### Prepare:
```php
$users = new Bitbucket\API\Users();
$users->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get a list of user's email addresses:
```php
$users->emails()->all($account_name);
```

### Gets an individual email address associated with an account.:
```php
$users->emails()->get($account_name, 'dummy@example.com');
```

----

#### Related:
  * [Authentication](authentication.md)
  * [Users](../users.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/account+Resource)
