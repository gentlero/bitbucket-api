---
layout: default
permalink: /examples/repositories/commits/build-statuses.html
title: Build Statuses
---

# Build Statuses

Manages build statuses on a commit.

### Prepare:
{% include auth.md var_name="buildStatuses" class_ns="Repositories\Commits\BuildStatuses" %}

### Get the build status for a commit: (API 2.0)

```php
$buildStatuses->get($account, $repository, $revision, $key);
```

### Adds a build status to a commit: (API 2.0)

```php
$buildStatuses->create($account, $repository, $revision, array(
    'state' => 'FAILED',
    'key'=> 'JENKINS-PROJECT-X',
    'name'=> 'Build #1',
    'url'=> 'https://example.com/path/to/build/info',
    'description'=> 'Changes by John Doe'
));
```

### Updates the build status for a commit: (API 2.0)

```php
$buildStatuses->update($account, $repository, $revision, $key, array(
    'state' => 'SUCCESSFUL',
    'name'=> 'Build #2',
    'url'=> 'https://example.com/path/to/build/info',
    'description'=> 'Changes by John Doe'
));
```

----

#### Related:
  * [Authentication]({{ site.url }}/examples/authentication.html)
  * [BB Wiki](https://confluence.atlassian.com/bitbucket/buildstatus-resource-779295267.html)
