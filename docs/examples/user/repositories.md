---
layout: default
permalink: /examples/user/repositories.html
title: User repositories
---

# User repositories

Get the details of the repositories associated with an individual or team account.

### Prepare:
{% include auth.md var_name="user" class_ns="User" %}

### Get a list of repositories visible to an account:

```php
$user->repositories()->get();
```

### Get a list of repositories the account is following:

```php
$user->repositories()->overview();
```

### Get the list of repositories on the dashboard:

```php
$user->repositories()->dashboard();
```

----

#### Related:
  * [Authentication]({{ site.url }}/examples/authentication.html)
  * [User]({{ site.url }}/examples/user.html)  
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/user+Endpoint#userEndpoint-GETalistofrepositoriesanaccountfollows)
