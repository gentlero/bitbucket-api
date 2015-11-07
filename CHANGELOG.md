# Change Log
All notable changes to this project will be documented in this file.  
This project adheres to [Semantic Versioning](http://semver.org/).

## 0.7.1 / 2015-11-07

### Fixed:
  - HTTP Client options where not forwarded to child classes. (PR #26)

## 0.7.0 / 2015-09-08

### Added:
  - Implemented webhooks endpoints.
  - Toggle spam on a changeset comment. (issue #2)
  - Support for OAuth2. (issue #34)

### Changed:
  - Marked Repositories/Services as deprecated in favor of Repositories/Hooks. (issue #29)
  - [DOCS] Added example on how to use this library in combination with a 3rd party OAuth1 client in a 3-legged flow.

### Fixed:
  - `forking_policy` parameter renamed to `fork_policy` on repository endpoint. (issue #32)

## 0.6.2 / 2015-05-18

### Fixed:
  - Client listener propagation to child classes. (PR #23)

##  0.6.1 / 2015-03-24

### Changed:
  - Better parameters validation and type hints.
  - Documentation has been updated and is available at http://gentlero.bitbucket.org/bitbucket-api/

### Fixed:
  - Request body was build the wrong way when no ( _or wrong type of_ ) additional params where passed to Repository::create()
  - `Commits::all()` should use GET instead of POST
  - `Listener::delListener` did not properly deleted the listener.
  - Forward all available listener when a child class is requested via Api::api or Api::childClass.

## 0.6.0 / 2014-10-21

### Added:
  - Added Changelog
  - Added `Api::api()*` as a single entry point for concrete apis ( *thanks to @digitalkaoz* )

### Fixed:
  - Fixed `Privileges::grant()` parameters format ( [Fixes #22] )

### Changed:
  - Marked `eabay/bitbucket-repo-sync` as conflict in composer.json
  - CS fixes

[Fixes #22]: https://bitbucket.org/gentlero/bitbucket-api/issue/22/grant-account-privileges-to-repo

## 0.5.2 / 2014-07-09

### Fixed:
  - Make tests go green again. ( *My bad and I'm sorry* ).

## 0.5.1 / 2014-07-08

### Fixed:
  - Bug: A default content-type is added for POST and PUT, if none was given. ( [Fixes #19] )

[Fixes #19]: https://bitbucket.org/gentlero/bitbucket-api/issue/19

## 0.5.0 / 2014-06-09

### Added:
  - Allow setting custom `Request` and `Response` inside HTTP client, which should facilitate integration in 3rd party software.

### Changed:
  - Implemented basic priority for listeners.

### Fixed:
  - Bug: Missing content-type made `PullRequests::merge` and `PullRequests::declined` unusable.

## 0.4.1 / 2014-06-01

### Fixed:
  - Bug: OAuthListener: Parameters may be included from the body if the content-type is urlencoded. ( [Fixes #18] )

[Fixes #18]: https://bitbucket.org/gentlero/bitbucket-api/issue/18

## 0.4.0 / 2014-05-14

### Added:
  - Added API 2.0 endpoints for `Users` ( *get, followers, following, repositories* )
  - Added API 2.0 endpoints for `Teams`. ( *profile, members, followers, following, repositories* )
  - Added API 2.0 endpoints for `BranchRestrictions`. ( *all, create, get, update, delete* )
  - Added `delListener()` method for `ClientInterface`.

### Fixed:
  - Bug: Mandatory parameters inside PullRequest's methods were not checked.

### Changed:
  - Documentation updated.

## 0.3.0 / 2014-05-12

  Started to implement version 2.0 of the API.
   - All 1.0 endpoints that have a "twin" in version 2.0 will be updated to use the never version.
   - All specific 2.0 endpoints will be added gradual.

### Added:
  - Implemented `Commits` and `Commits::Comments` endpoints for API 2.0
  - Added `Repository::get()` ( *API 2.0* )
  - Added all endpoints for PullRequests ( *API 2.0* )
  - Added repositories endpoint ( *API 2.0* )

### Changed:
  - Updated `Repository` to use API 2.0 (create, delete) and implemented endpoints specific to API 2.0 ( *watchers, forks* )
  - Updated `PullRequests::all()` to API 2.0
  - Updated `PullRequests::Comments::get()` and `PullRequests::Comments::all()` to API 2.0
  - Updated `Repositories::PullRequests::all()` to allow `state` param.
  - CS fixes.


## 0.2.1 / 2014-04-21

### Added:
  - Added `Repositories::PullRequests::all()` method to get a list of all pull requests.


## 0.2.0 / 2014-02-24

### Fixed:
  - Bug: group privileges returned 400 error ( [Fixes #14] )

### Added:
  - Implemented HttpClient which abstracts HTTP layer from base clases and allows custom HTTP libraries to be used.
  - Implemented simple EventListener which can be used to change request before and after its executed.

### Changed:
  - Updated `Api::setCredentials()` to use our new EventListener.

[Fixes #14]: https://bitbucket.org/gentlero/bitbucket-api/issue/14

## 0.1.2 / 2013-12-24

### Fixed:
  - Bug: Duplicate array keys in groups filters. ( [Fixes #12] )

[Fixes #12]: https://bitbucket.org/gentlero/bitbucket-api/issue/12


## 0.1.1 / 2013-11-26

### Removed:
  - Removed `newuser` endpoint. ( [Fixes #10] )
  - Removed `repositories/changesets/likes` endpoint. ( [ref #1] )

### Changed:
  - Code clean, fixed typos.

[Fixes #10]: https://bitbucket.org/gentlero/bitbucket-api/issue/10
[ref #1]: https://bitbucket.org/gentlero/bitbucket-api/issue/1


## 0.1.0 / 2013-06-09

  - First public release
