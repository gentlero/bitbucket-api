---
layout: default
permalink: /examples/repositories.html
title: Repositories
---

# Repositories

The repositories namespace has a number of resources you can use to manage repository. The following resources are available on
repositories:

### Prepare:
{% include auth.md var_name="repositories" class_ns="Repositories" %}

### Pagination:
{% include pagination.md var_name="repositories" class_ns="Repositories" %}

### Get a list of repositories for an account:

If the caller is properly authenticated and authorized, this method returns a collection containing public and private repositories.

  ```php
  $repositories->all($account_name);
  ```

### Get a list of all public repositories:

Only public repositories are returned.

  ```php
  $repositories->all();
  ```

----

#### Related:
  * [Authentication](authentication.html)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/repositories+Endpoint)
