## Users ssh keys

----
Use the ssh-keys resource to manipulate the ssh-keys on an individual or team account.

### Prepare:
```php
$users = new Bitbucket\API\Users();
$users->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get a list of the keys associated with an account:
```php
$users->sshKeys()->get($account_name);
```

### Creates a key on the specified account:
```php
$users->sshKeys()->create($account_name, 'key content', 'dummy key');
```

----

#### Related:
  * [Authentication](authentication.md)
  * [Users](../users.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/ssh-keys+Resource#ssh-keysResource-Overview)
