---
layout: default
permalink: /examples/repositories/issues/components.html
title: Issue components
---

# Issue components

Manage components on a issue tracker.

### Prepare:
{% include auth.md var_name="issue" class_ns="Repositories\Issues" %}

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
  * [Authentication]({{ site.url }}/examples/authentication.html)
  * [Repository issues]({{ site.url }}/examples/repositories/issues.html)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/issues+Resource#issuesResource-Overview)
