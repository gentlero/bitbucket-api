---
layout: default
permalink: /examples/repositories/src.html
title: Source
---

# Source

Allows you to browse directories and view files.
*NOTE:* This is a read-only resource.

### Prepare:
{% include auth.md var_name="src" class_ns="Repositories\Src" %}

### Get a list of the src in a repository.:

```php
$src->get($account_name, $repo_slug, '1e10ffe', 'app/models/');
```

### Get raw content of an individual file:

```php
$src->raw($account_name, $repo_slug, '1e10ffe', 'app/models/core.php');
```

----

#### Related:
  * [Authentication]({{ site.url }}/examples/authentication.html)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/src+Resources)
