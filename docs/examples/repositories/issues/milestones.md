---
layout: default
permalink: /examples/repositories/issues/milestones.html
title: Issue milestones
---

# Issue milestones

Manage milestones on a issue tracker.

### Prepare:
{% include auth.md var_name="issue" class_ns="Repositories\Issues" %}

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
  * [Authentication]({{ site.url }}/examples/authentication.html)
  * [Repository issues]({{ site.url }}/examples/repositories/issues.html)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/issues+Resource#issuesResource-Overview)
