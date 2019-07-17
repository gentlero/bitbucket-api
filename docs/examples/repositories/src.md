---
layout: default
permalink: /examples/repositories/src.html
title: Source
---

# Source

Allows you to browse directories and view files, create branches and commit new files.

### Prepare:
{% include auth.md var_name="src" class_ns="Repositories\Src" %}

### Get a list of the src in a repository.:

```php
$src->get($account_name, $repo_slug, '1e10ffe', 'app/models/');
```

### Get raw content of an individual file:

```php
$src->get($account_name, $repo_slug, '1e10ffe', 'app/models/core.php');
```

### Create file in repository

```php
$params = array();
$params['parent'] = 'master'; // Optional branch to commit to
$params['/path-to-file'] = 'File content'; // Can be multiple files per commit
$params['author'] = 'User <my@email.com>';
$params['message'] = 'Commit message';

$src->create($account_name, $repo_slug, $params);
```

### Delete file in repository

```php
$params = array();
$params['parent'] = 'master'; // Optional branch to commit to
$params['files'] = '/file-to-delete';
$params['author'] = 'User <my@email.com>';
$params['message'] = 'Commit message';

$src->create($account_name, $repo_slug, $params);
```

### Create new branch in repository

```php
$params = array();
$params['parent'] = 'master'; // Optional source branch
$params['branch'] = 'new-branch-name';
$params['author'] = 'User <my@email.com>';
$params['message'] = 'Commit message';

$src->create($account_name, $repo_slug, $params);
```
----

#### Related:
  * [Authentication]({{ site.url }}/examples/authentication.html)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/src+Resources)
