## Pull requests comments

---
Manage pull requests comments.

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
