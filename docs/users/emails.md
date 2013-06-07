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

----

#### Related:
  * [Authentication](authentication.md)
  * [Users](../users.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/account+Resource)
