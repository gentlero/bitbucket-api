## Users

----
Get information related to an individual or team account.

### Prepare:
```php
$user = new Bitbucket\API\Users();
$user->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get the public information associated with a user: (API 2.0)
```php
$user->get($username);
```

### Get the list of followers: (API 2.0)
```php
$user->followers($username);
```

### Get a list of accounts the user is following: (API 2.0)
```php
$user->following($username);
```

### Get the list of the user's repositories: (API 2.0)
```php
$user->repositories($username);
```

----

#### Related:
  * [Authentication](authentication.md)
  * [Users account](users/account.md)
  * [Users emails](users/emails.md)
  * [Users invitations](users/invitations.md)
  * [Users oauth](users/oauth.md)
  * [Users privileges](users/privileges.md)
  * [Users ssh keys](users/ssh-keys.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/users+Endpoint)
