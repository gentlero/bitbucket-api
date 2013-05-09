## Invitations

----
Allows repository administrators to send email invitations to grant read, write, or admin privileges to a repository.

### Prepare:
```php
$invitation = new Bitbucket\API\Invitations();
$invitation->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Send invitation:
```php
$invitation->send($account_name, $repo_slug, 'user@example.com', 'read');
```

----

#### Related:
  * [Authentication](authentication.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/invitations+Endpoint#invitationsEndpoint-Overview)
