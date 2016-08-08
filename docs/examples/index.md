---
layout: default
permalink: /examples/
title: Examples
---

# Usage examples

**TIP:** Although all examples from this documentation are instantiating each class, a single point of entry is also available:

  ```php
  $bitbucket = new \Bitbucket\API\Api();
  $bitbucket->getClient()->addListener(
      new \Bitbucket\API\Http\Listener\BasicAuthListener('username', 'password')
  );

  /** @var \Bitbucket\API\User $user */
  $user = $bitbucket->api('User');

  /** @var \Bitbucket\API\Repositories\Issues $issues */
  $issues = $bitbucket->api('Repositories\Issues');
  ```

### Available examples

  - [Authentication](authentication.html)
  - [Group privileges](group-privileges.html)
  - [Groups](groups.html)
  - [Invitations](invitations.html)
  - [Privileges](privileges.html)
  - [Repositories](repositories.html)
    - [Branch restrictions](repositories/branch-restrictions.html)
    - [Changesets](repositories/changesets.html)
      - [Comments](repositories/changesets/comments.html)
    - [Commits](repositories/commits.html)
      - [Comments](repositories/commits/comments.html)
      - [Build statuses](repositories/commits/build-statuses.html)
    - [Deploy keys](repositories/deploy-keys.html)
    - [Events](repositories/events.html)
    - [Followers](repositories/followers.html)
    - [Issues](repositories/issues.html)
      - [Comments](repositories/issues/comments.html)
      - [Components](repositories/issues/components.html)
      - [Milestones](repositories/issues/milestones.html)
      - [Versions](repositories/issues/versions.html)
    - [Links](repositories/links.html)
    - [Pull requests](repositories/pull-requests.html)
      - [Comments](repositories/pull-requests/comments.html)
    - [Repository](repositories/repository.html)
    - [Services](repositories/services.html)
    - [Hooks](repositories/webhooks.html)
    - [Src](repositories/src.html)
    - [Wiki](repositories/wiki.html)
    - [Build statuses](repositories/commits/build-statuses.html)
  - [Teams](teams.html)
  - [User](user.html)
    - [Repositories](user/repositories.html)
  - [Users](users.html)
    - [Account](users/account.html)
    - [Emails](users/emails.html)
    - [Invitations](users/invitations.html)
    - [OAuth](users/oauth.html)
    - [Privileges](users/privileges.html)
    - [SSH keys](users/ssh-keys.html)
