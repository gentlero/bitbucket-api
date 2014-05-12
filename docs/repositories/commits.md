## Commits

----
Retrieve and compare information about commits.

### Prepare:
```php
$commits = new Bitbucket\API\Repositories\PullRequests();
$commits->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get all commits for a repository: (API 2.0)
```php
$commits->all($account_name, $repo_slug);
```

### Get all commits for a single branch: (API 2.0)
```php
$commits->all($account_name, $repo_slug, array(
    'branch' => 'master' // this can also be a tag
));
```

----

#### Related:
  * [Authentication](../authentication.md)
  * [BB Wiki](https://confluence.atlassian.com/x/doA7Fw)
