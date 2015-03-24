---
layout: default
permalink: /examples/repositories/commits/comments.html
title: Commits comments
---

# Commits comments

Manage commits comments.

### Prepare:

```php
$commit = new Bitbucket\API\Repositories\Commits();
$commit->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

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
