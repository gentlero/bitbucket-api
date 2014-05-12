## Repositories

----
The repositories namespace has a number of resources you can use to manage repository. The following resources are available on repositories:

### Prepare:
```php
$repositories = new Bitbucket\API\Repositories();
$repositories->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get a list of repositories for an account: (API 2.0)

If the caller is properly authenticated and authorized, this method returns a collection containing public and private repositories.
```php
$repositories->all($account_name);
```

### Get a list of all public repositories: (API 2.0)

Only public repositories are returned.
```php
$repositories->all();
```

* [Commit(s)](repositories/commits.md) (API 2.0)
* [Changesets](repositories/changesets.md)
* [Deploykeys](repositories/deploykeys.md)
* [Events](repositories/events.md)
* [Followers](repositories/followers.md)
* [Issues](repositories/issues.md)
* [Links](repositories/links.md)
* [PullRequests](repositories/pullrequests.md)
* [Repository](repositories/repository.md)
* [Services](repositories/services.md)
* [Src](repositories/src.md)
* [Wiki](repositories/wiki.md)

----

#### Related:
  * [Authentication](authentication.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/repositories+Endpoint)
