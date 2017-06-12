---
layout: default
permalink: /examples/users/invitations.html
title: Users invitations
---

# Users invitations

An invitation is a request sent to an external email address to participate one or more of an account's groups.
Any user with admin access to the account can invite someone to a group.

### Prepare:
{% include auth.md var_name="users" class_ns="Users" %}

### Get a list of pending invitations:

```php
$users->invitations()->all($account_name);
```

### Gets any pending invitations on a team or individual account for a particular email address:

```php
$users->invitations()->email($account_name, 'dummy@example.com');
```

### Tests whether there is a pending invitation for a particular email on account's group:

```php
$users->invitations()->group($account_name, 'john', 'testers', 'dummy@example.com');
```

### Issues an invitation to the specified account group.

An invitation is a request sent to an external email address to participate one or more of an account's groups.

```php
$users->invitations()->create($account_name, 'john', 'testers', 'dummy@example.com');
```

### Deletes any pending invitations on a team or individual account for a particular email address.

```php
$users->invitations()->deleteByEmail($account_name, 'dummy@example.com');
```

### Deletes a pending invitation for a particular email on account's group.

```php
$users->invitations()->deleteByGroup($account_name, 'john', 'testers', 'dummy@example.com');
```

----

#### Related:
  * [Authentication]({{ site.url }}/examples/authentication.html)
  * [Users]({{ site.url }}/examples/users.html)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/invitations+Resource#invitationsResource-Overview)
