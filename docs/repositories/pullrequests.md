## Pull requests

----
Manage the comments on pull requests. Other users can reply to them. This allows for the construction of a thread of comments. 

### Prepare:
```php
$pull = new Bitbucket\API\Repositories\PullRequests();
$pull->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get a list of a pull request comments:
```php
$pull->comments()->all($account_name, $repo_slug, 1)
```

### Get an individual pull request comment:
```php
$pull->comments()->get($account_name, $repo_slug, 1, 2)
```

### Add a new comment:
```php
$pull->comments()->create($account_name, $repo_slug, 41, "dummy content");
```

### Update an existing comment:
```php
$pull->comments()->update($account_name, $repo_slug, 41, 4, "dummy content [edited]");
```

### Delete a pull request comment
```php
$pull->comments()->delete($account_name, $repo_slug, 41, 4);
```

### Get all pull requests
```php
$pull->all($account_name, $repo_slug);
```

----

#### Related:
  * [Authentication](../authentication.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/pullrequests+Resource#pullrequestsResource-Overview)
