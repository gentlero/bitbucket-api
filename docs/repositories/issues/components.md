## Issue components

----
Manage components on a issue tracker.

### Prepare:
```php
$issue = new Bitbucket\API\Repositories\Issues();
$issue->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Fetch all components:
```php
$issue->components()->all($accountname, $repo_slug);
```

### Fetch single component:
```php
$issue->components()->get($accountname, $repo_slug, 100332);
```

### Add a new component:
```php
$issue->components()->create($accountname, $repo_slug, 'DummyComponent');
```

### Update an existing component:
```php
$issue->components()->update($accountname, $repo_slug, 100336, 'DummyComponent');
```

### Delete an existing component:
```php
$issue->components()->delete($accountname, $repo_slug, 100336);
```

----

#### Related:
  * [Authentication](../../authentication.md)
  * [Repository issues](../issues.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/issues+Resource#issuesResource-Overview)
