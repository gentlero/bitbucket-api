---
layout: default
permalink: /examples/repositories/deploy-keys.html
title: Deploy keys
---

# Deploykeys

Manage ssh keys used for deploying product builds.

### Prepare:

```php
$dk = new Bitbucket\API\Repositories\Deploykeys();
$dk->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get a list of keys:

```php
$dk->all($account_name, $repo_slug);
```

### Get a key content:

```php
$dk->get($account_name, $repo_slug, 508372);
```

### Add a new key:

```php
$dk->create($account_name, $repo_slug, 'ssh-rsa [...]', 'test key');
```

### Update an existing key:

```php
$dk->update($account_name, $repo_slug, '508380', array('label' => 'test [edited]'));
```

### Delete an existing key:

```php
$dk->delete($account_name, $repo_slug, '508380');
```

----

#### Related:
  * [Authentication]({{ site.url }}/examples/authentication.html)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/deploy-keys+Resource#deploy-keysResource-Overview)
