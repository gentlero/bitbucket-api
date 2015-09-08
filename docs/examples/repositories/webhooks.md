---
layout: default
permalink: /examples/repositories/webhooks.html
title: WebHooks
---

# WebHooks

This resource manages webhooks on a repository. The administrators of the repository are 
the only users who can create, access, update, or delete the webhook.

### Prepare:

```php
$uuid	= '30b60aee-9cdf-407d-901c-2de106ee0c9d'; // unique identifier of the webhook
$hooks	= new Bitbucket\API\Repositories\Hooks();

$hooks->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get a webhook:

```php
$hooks->get($account_name, $repo_slug, $uuid);
```

**HINT:** You can use `$hooks->all()` method to get a list of all available hooks and their unique identifiers.

### Get a list of webhooks:

```php
$hooks->all($account_name, $repo_slug);
```

### Create a new webhook:

```php
$hook->create($account_name, $repo_slug, array(
    'description' => 'Webhook Description',
    'url' => 'http://requestb.in/xxx',
    'active' => true,
    'events' => array(
        'repo:push',
        'issue:created',
        'issue:updated'
    )
));
```

**HINT:** For a full list of available events, see [Event Payloads](https://confluence.atlassian.com/display/BITBUCKET/Event+Payloads) page.

### Update a webhook:

Add a new event `pullrequest:approved` to our webhook:

```php
$hook->update($account_name, $repo_slug, $uuid, array(
    'description' => 'Webhook Description',
    'url' => 'http://requestb.in/xxx',
    'active' => true,
    'events' => array(
        'repo:push',
        'issue:created',
        'issue:updated',
        'pullrequest:approved'
    )
));
```

**HINT:** Bitbucket doesn't offer a patch endpoint, so you need to send the entire object represensation in order to update.

### Delete a webhook:

```php
$hook->delete($account_name, $repo_slug, $uuid);
```

----

#### Related:
  * [Authentication]({{ site.url }}/examples/authentication.html)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/webhooks+Resource)
