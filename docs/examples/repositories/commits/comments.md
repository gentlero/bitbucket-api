---
layout: default
permalink: /examples/repositories/commits/comments.html
title: Commits comments
---

# Commits comments

Manage commits comments.

### Prepare:
{% include auth.md var_name="commit" class_ns="Repositories\Commits" %}

### Get a list of a commit comments: (API 2.0)

```php
$commit->comments()->all($account_name, $repo_slug, $commitSHA1)
```

### Get an individual commit comment: (API 2.0)

```php
$commit->comments()->get($account_name, $repo_slug, $commitSHA1, $commentID)
```

----

#### Related:
  * [Authentication]({{ site.url }}/examples/authentication.html)
  * [Commit(s)]({{ site.url }}/examples/repositories/commits.html)
