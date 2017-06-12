# Contributing

First of all, thank you for taking time to contribute!

Contributions are accepted via Pull Requests on [Bitbucket][repo]. Sometimes, our free time is very limited and could take a while until we review your pull request, so please be patient while you wait for code review.

We don't mind getting questions, so if you have any, please open a new issue on our [tracker][repo].

## Pull Requests

Here are a few rules which you should follow, in order to ease code review and merging:

1. **Follow [PSR-2 Coding Standard][PSR-2]**
- **Create feature branches** - We don't pull from your (master|develop) branch!
- **One pull request per feature** - If you need/want to change more than one thing, please send multiple pull requests.
- **Consider our release cycle** - We follow [SemVer v2.0.0][semver]. Breaking public APIs is not acceptable.
- **(Add|Update) tests when applicable.**
- **Document any change in behaviour** - Update documentation and/or readme file when applicable.

Sometimes you might be asked to also [squash your commits][squash] (*we don't want commits such as `fix 1`, `fix <n>`, `now its working`, etc*). This is done in order to keep a clean and coherent VCS history.

## Running tests

``` bash
$ composer test
```

To check against [PSR-2][PSR-2] coding standard:

``` bash
$ composer style
```

[repo]: https://bitbucket.org/gentlero/bitbucket-api/overview
[PSR-2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[squash]: http://www.git-scm.com/book/en/v2/Git-Tools-Rewriting-History#Changing-Multiple-Commit-Messages
[semver]: http://semver.org/
