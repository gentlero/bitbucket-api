## Users

----
Get information related to an individual or team account.

### Prepare:
```php
$users = new Bitbucket\API\Users();
$users->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

----

#### Related:
  * [Authentication](authentication.md)
  * [Users account](users/account.md)
  * [Users emails](users/emails.md)
  * [Users invitations](users/invitations.md)
  * [Users oauth](users/oauth.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/users+Endpoint)
