---
layout: default
permalink: /examples/invitations.html
title: Invitations
---

# Invitations

Allows repository administrators to send email invitations to grant read, write, or admin privileges to a repository.

### Prepare:
{% include auth.md var_name="invitation" class_ns="Invitations" %}

### Send invitation:

```php
$invitation->send($account_name, $repo_slug, 'user@example.com', 'read');
```

----

#### Related:
  * [Authentication]({{ site.url }}/examples/authentication.html)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/invitations+Endpoint#invitationsEndpoint-Overview)
