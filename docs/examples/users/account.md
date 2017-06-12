---
layout: default
permalink: /examples/users/account.html
title: Users account
---

# Users account

This resource returns a user structure and the repositories array associated with an existing account.

### Prepare:
{% include auth.md var_name="users" class_ns="Users" %}

### Get the account profile:

```php
$users->account()->profile($account_name);
```

### Get the account plan:

```php
$users->account()->plan($account_name);
```

### Get the followers of an account:

```php
$users->account()->followers($account_name);
```

### Gets a count and the list of events associated with an account:

```php
$users->account()->events($account_name);
```

----

#### Related:
  * [Authentication]({{ site.url }}/examples/authentication.html)
  * [Users]({{ site.url }}/examples/users.html)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/account+Resource)
