---
layout: default
permalink: /faq.html
title: FAQ
---

# FAQ

### This library follows [semantic versioning][1] ?
Yes it does.

### How longer PHP 5.3 will be supported ?
Starting with version 1.0 of this library, minimum PHP version will be bumped to 5.4

### How can I commit to the repository using this library ?
You can't, because Bitbucket offers only read-only access to a repository source through their API.

### How can I fetch all pages of a paginated response ?

Using `Response\Pager`.

_Example: Fetching all repositories from an account:_

{% include pagination.md var_name="repositories" class_ns="Repositories" %}

[1]: http://semver.org/
