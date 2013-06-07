## Users oauth

----
Use the oauth resource to create and maintain your own OAuth consumers.

### Prepare:
```php
$users = new Bitbucket\API\Users();
$users->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get all OAuth consumers:
```php
$users->oauth()->all($account_name);
```

----

#### Related:
  * [Authentication](authentication.md)
  * [Users](../users.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/invitations+Resource#invitationsResource-Overview)
