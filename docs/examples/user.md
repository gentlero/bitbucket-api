---
layout: default
permalink: /examples/user.html
title: User
---

# User

Manages the currently authenticated account profile.

### Prepare

```php
$user = new Bitbucket\API\User();
$user->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

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
----

#### Related:
  * [Authentication]({{ site.url }}/examples/authentication.html)
  * [User repositories](user/repositories.html)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/user+Endpoint#userEndpoint-Overview)
