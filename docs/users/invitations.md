## Users invitations

----
An invitation is a request sent to an external email address to participate one or more of an account's groups.
Any user with admin access to the account can invite someone to a group.

### Prepare:
```php
$invitations = new Bitbucket\API\Users();
$invitations->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get a list of pending invitations:
```php
$users->invitations()->all($account_name);
```

### Gets any pending invitations on a team or individual account for a particular email address:
```php
$users->invitations()->email($account_name, 'dummy@example.com');
```

----

#### Related:
  * [Authentication](authentication.md)
  * [Users](../users.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/invitations+Resource#invitationsResource-Overview)
