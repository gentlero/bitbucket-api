---
layout: default
permalink: /examples/user.html
title: User
---

# User

Manages the currently authenticated account profile.

### Prepare
{% include auth.md var_name="user" class_ns="User" %}

### Get user profile

```php
$profile = $user->get();
```

### Update currently authenticated user profile:

```php
$user->update(array(
    'first_name'    => 'John',
    'last_name'     => 'Doe'
));
```

### Get user privileges:

```php
$user->privileges();
```

### Get a list of repositories an account follows:

```php
$user->follows();
```

### Retrieves the email for an authenticated user.

```php
$user->emails();
```
----

#### Related:
  * [Authentication]({{ site.url }}/examples/authentication.html)
  * [User repositories](user/repositories.html)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/user+Endpoint#userEndpoint-Overview)
