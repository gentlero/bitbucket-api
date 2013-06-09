## Users account

----
This resource returns a user structure and the repositories array associated with an existing account.

### Prepare:
```php
$users = new Bitbucket\API\Users();
$users->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get the account profile:
```php
$users->account()->profile($account_name);
```

### Get the account plan:
```php
$users->account()->plan($account_name);
```

### Get the followers of an account:
```php
$users->account()->followers($account_name);
```

### Gets a count and the list of events associated with an account:
```php
$users->account()->events($account_name);
```

----

#### Related:
  * [Authentication](authentication.md)
  * [Users](../users.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/account+Resource)
