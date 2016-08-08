---
layout: default
permalink: /examples/repositories/followers.html
title: Followers
---

# Followers

----
List a repository's followers.

### Prepare:
{% include auth.md var_name="followers" class_ns="Repositories\Followers" %}

### Get the repository followers:

```php
$followers->all($account_name, $repo_slug);
```

----

#### Related:
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/followers+Resource)
