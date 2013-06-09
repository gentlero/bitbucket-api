## Issue milestones

----
Manage milestones on a issue tracker.

### Prepare:
```php
$issue = new Bitbucket\API\Repositories\Issues();
$issue->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Fetch all milestones:
```php
$issue->milestones()->all($accountname, $repo_slug);
```

### Fetch a single milestone:
```php
$issue->milestones()->get($accountname, $repo_slug, 56735);
```

### Add a new milestone:
```php
$issue->milestones()->create($accountname, $repo_slug, 'dummy');
```

### Update an existing milestone:
```php
$issue->milestones()->update($accountname, $repo_slug, 56736, 'not dummy');
```

### Delete an existing milestone:
```php
$issue->milestones()->delete($accountname, $repo_slug, 56736);
```

----

#### Related:
  * [Authentication](../../authentication.md)
  * [Repository issues](../issues.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/issues+Resource#issuesResource-Overview)
