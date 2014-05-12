## Branch restrictions

----
Manage branch restrictions on a repository

### Prepare:
```php
$restrictions = new Bitbucket\API\Repositories\PullRequests();
$restrictions->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get the information associated with a repository's branch restrictions: (API 2.0)
```php
$restrictions->all($account_name, $repo_slug);
```

----

#### Related:
  * [Authentication](../authentication.md)
  * [BB Wiki](https://confluence.atlassian.com/x/XQEYFw)
