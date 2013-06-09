## Changeset comments

----
Manage changeset comments.

### Prepare:
```php
$changesets = new Bitbucket\API\Repositories\Changesets();
$changesets->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get a list of comments on a changeset:
```php
$changesets->comments()->all($accountname, $repo_slug, 'a9f15cfdfb68436f324dd980eefdbb9d0dc3887c');
```

### Delete a comment on a changeset:
```php
$changesets->comments()->delete($accountname, $repo_slug, 'a9f15cfdfb68436f324dd980eefdbb9d0dc3887c', 195700);
```

### Post a new comment on a changeset:
```php
$changesets->comments()->create($accountname, $repo_slug, 'a9f15cfdfb68436f324dd980eefdbb9d0dc3887c', 'dummy comment 2');
```

### Update a comment on a changeset:
```php
$changesets->comments()->update($accountname, $repo_slug, 'a9f15cfdfb68436f324dd980eefdbb9d0dc3887c', 195753, 'edited comment');
```

----

#### Related:
  * [Authentication](../../authentication.md)
  * [Changesets](../changesets.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/changesets+Resource#changesetsResource-Overview)
