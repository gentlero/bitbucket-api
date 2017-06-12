---
layout: default
permalink: /examples/teams.html
title: Teams
---

# Teams

Get Team related information.

### Prepare:
{% include auth.md var_name="team" class_ns="Teams" %}

### Get a list of teams to which the caller has access: (API 2.0)

```php
$team->all($role);
```

Where `$role` can be: _member_, _contributor_ or _admin_

### Get the team profile: (API 2.0)

```php
$team->profile($team_name);
```

### Get the team members: (API 2.0)

```php
$team->members($team_name);
```

### Get the team followers: (API 2.0)

```php
$team->followers($team_name);
```

### Get a list of accounts the team is following: (API 2.0)

```php
$team->following($team_name);
```

### Get the team's repositories: (API 2.0)

```php
$team->repositories($team_name);
```
----

#### Related:
  * [Authentication]({{ site.url }}/examples/authentication.html)
  * [BB Wiki](https://confluence.atlassian.com/x/XwZAGQ)
