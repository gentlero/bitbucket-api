## Followers

----
List a repository's followers.

### Prepare:
```php
$followers = new Bitbucket\API\Repositories\Followers();
```

### Get the repository followers:
```php
$followers->all($account_name, $repo_slug);
```

----

#### Related:
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/followers+Resource)
