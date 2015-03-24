---
layout: default
permalink: /examples/repositories/issues/versions.html
title: Issue versions
---

# Issue versions

Manage versions on a issue tracker.

### Prepare:

```php
$issue = new Bitbucket\API\Repositories\Issues();
$issue->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Fetch all versions:

```php
$issue->versions()->all($accountname, $repo_slug);
```

### Fetch single version:

```php
$issue->versions()->get($accountname, $repo_slug, 53917);
```

### Add a new version:

```php
$issue->versions()->create($accountname, $repo_slug, '3.0');
```

### Update an existing version:

```php
$issue->versions()->update($accountname, $repo_slug, 53920, '3.0.1');
```

### Delete an existing version:

```php
$issue->versions()->delete($accountname, $repo_slug, 53920);
```

----

#### Related:
  * [Authentication]({{ site.url }}/examples/authentication.html)
  * [Repository issues]({{ site.url }}/examples/repositories/issues.html)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/issues+Resource#issuesResource-Overview)
