---
layout: default
permalink: /examples/group-privileges.html
title: Group Privileges
---

# Group Privileges

Manages a group's repository permissions.

### Prepare
{% include auth.md var_name="privileges" class_ns="GroupPrivileges" %}

### Get a list of privileged groups

```php
$groups = $privileges->groups($account_name);
```

### Get a list of privileged groups for a repository

```php
$groups = $privileges->repository($account_name, $repo_slug);
```

### Gets the privileges of a group on a repository.

```php
$group = $privileges->group($account_name, $repo_slug, $group_owner, $group_slug);
```

### Get a list of the repositories on which a particular privilege group appears.

```php
$repos = $privileges->repositories($account_name, $group_owner, $group_slug);
```

### Grant group privileges on a repository.

```php
$privileges->grant($account_name, $repo_slug, $group_owner, $group_slug, 'read');
```

### Delete group privileges from a repository

```php
$privileges->delete($account_name, $repo_slug, $group_owner, $group_slug);
```

----

#### Related:
  * [Authentication]({{ site.url }}/examples/authentication.html)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/group-privileges+Endpoint#group-privilegesEndpoint-Overview)
