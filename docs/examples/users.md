---
layout: default
permalink: /examples/users.html
title: Users
---

# Users

Get information related to an individual or team account.

### Prepare:
{% include auth.md var_name="user" class_ns="Users" %}

### Get the public information associated with a user: (API 2.0)

```php
$user->get($username);
```

### Get the list of followers: (API 2.0)

```php
$user->followers($username);
```

### Get a list of accounts the user is following: (API 2.0)

```php
$user->following($username);
```

### Get the list of the user's repositories: (API 2.0)

```php
$user->repositories($username);
```
----

#### Related:
  * [Authentication]({{ site.url }}/examples/authentication.html)
  * [Users account](users/account.html)
  * [Users emails](users/emails.html)
  * [Users invitations](users/invitations.html)
  * [Users oauth](users/oauth.html)
  * [Users privileges](users/privileges.html)
  * [Users ssh keys](users/ssh-keys.html)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/users+Endpoint)
