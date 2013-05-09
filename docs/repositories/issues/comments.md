## Issue comments

----
Manage issue comments.

### Prepare:
```php
$issue = new Bitbucket\API\Repositories\Issues();
$issue->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Fetch all comments:
```php
$issue->comments()->all($accountname, $repo_slug, 4);
```

### Fetch a single comment:
```php
$issue->comments()->get($accountname, $repo_slug, 4, 2967835);
```

### Add a new comment to specified issue:
```php
$issue->comments()->create($accountname, $repo_slug, 4, 'dummy comment.');
```

### Update existing comment:
```php
$issue->comments()->update($accountname, $repo_slug, 4, 3454384, "dummy comment [edited]");
```
----

#### Related:
  * [Authentication](../../authentication.md)
  * [Repository issues](../issues.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/issues+Resource#issuesResource-Overview)
