## Users invitations

----
An invitation is a request sent to an external email address to participate one or more of an account's groups.
Any user with admin access to the account can invite someone to a group.

### Prepare:
```php
$users = new Bitbucket\API\Users();
$users->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get a list of pending invitations:
```php
$users->invitations()->all($account_name);
```

### Gets any pending invitations on a team or individual account for a particular email address:
```php
$users->invitations()->email($account_name, 'dummy@example.com');
```

### Tests whether there is a pending invitation for a particular email on account's group:
```php
$users->invitations()->group($account_name, 'john', 'testers', 'dummy@example.com');
```

### Issues an invitation to the specified account group.
An invitation is a request sent to an external email address to participate one or more of an account's groups.
```php
$users->invitations()->create($account_name, 'john', 'testers', 'dummy@example.com');
```

### Deletes any pending invitations on a team or individual account for a particular email address.
```php
$users->invitations()->deleteByEmail($account_name, 'dummy@example.com');
```

### Deletes a pending invitation for a particular email on account's group.
```php
$users->invitations()->deleteByGroup($account_name, 'john', 'testers', 'dummy@example.com');
```

----

#### Related:
  * [Authentication](authentication.md)
  * [Users](../users.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/invitations+Resource#invitationsResource-Overview)
