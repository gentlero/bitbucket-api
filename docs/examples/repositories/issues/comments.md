---
layout: default
permalink: /examples/repositories/issues/comments.html
title: Issue comments
---

# Issue comments

Manage issue comments.

### Prepare:
{% include auth.md var_name="issue" class_ns="Repositories\Issues" %}

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
  * [Authentication]({{ site.url }}/examples/authentication.html)
  * [Repository issues]({{ site.url }}/examples/repositories/issues.html)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/issues+Resource#issuesResource-Overview)
