---
layout: default
permalink: /examples/repositories/refs/branches.html
title: Branches
---

# Branches

Allows you to get a list of branches.

### Prepare:
{% include auth.md var_name="branches" class_ns="Repositories\Refs\Branches" %}

### Get a list of branches:

```php
$branches->all($account_name, $repo_slug);
```

### Get an individual branch:

```php
$branches->get($account_name, $repo_slug, $branch_name);
```

----

#### Related:
  * [Authentication]({{ site.url }}/examples/authentication.html)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/src+Resources)
