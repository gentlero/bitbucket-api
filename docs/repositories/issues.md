## Repository issues

----
Provides functionality for interacting with an issue tracker. Authentication is necesary to access private issue tracker, to get more detailed information, to create and to update an issue.

### Prepare:
```php
$issue = new Bitbucket\API\Repositories\Issues();
$issue->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Fetch a list of issues:
```php
$issue->all($account_name, $repo_slug);
```

### Fetch a single issue:
```php
$issue->get($account_name, $repo_slug, 3);
```

### Fetch 5 issues that contains word `bug` in title:
```php
$issue->all($account_name, $repo_slug, array(
    'limit' => 5,
    'start' => 0,
    'search' => 'bug'
));
```

### Add a new issue:
```php
$issue->create($account_name, $repo_slug, array(
    'title'     => 'dummy title',
    'content'   => 'dummy content',
    'kind'      => 'proposal',
    'priority'  => 'blocker'
));
```

### Update an existing issue:
```php
$issue->update($account_name, $repo_slug, 5, array(
    'title' => 'dummy title (edited)'
));
```

### Delete issue:
```php
$issue->delete($account_name, $repo_slug, 5);
```

----

#### Related:
  * [Authentication](../authentication.md)
  * [Issues comments](issues/comments.md)
  * [Issues components](issues/components.md)
  * [Issues milestones](issues/milestones.md)
  * [Issues versions](issues/versions.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/issues+Resource#issuesResource-Overview)
