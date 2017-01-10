---
layout: default
permalink: /examples/repositories/refs/tags.html
title: Tags
---

# Tags

Allows you to get a list of tags.

### Prepare:
{% include auth.md var_name="tags" class_ns="Repositories\Refs\Tags" %}

### Get a list of tags:

```php
$tags->all($account_name, $repo_slug);
```

### Get an individual tag:

```php
$tags->get($account_name, $repo_slug, $tag_name);
```

### Create a new tag:

```php
$tags->create($account_name, $repo_slug, $tag_name, $hash);
```

----

#### Related:
  * [Authentication]({{ site.url }}/examples/authentication.html)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/src+Resources)
