# Change Log
All notable changes to this project will be documented in this file.

## 0.6.0 / 2014-10-21

  - Added Changelog
  - Added `Api::api()*` as a single entry point for concrete apis ( *thanks to @digitalkaoz* )
  - Fixed `Privileges::grant()` parameters format ( [Fixes #22] )
  - Marked `eabay/bitbucket-repo-sync` as conflict in composer.json
  - CS fixes

[Fixes #22]: https://bitbucket.org/gentlero/bitbucket-api/issue/22/grant-account-privileges-to-repo

## 0.5.2 / 2014-07-09

  - Make tests go green again. ( *My bad and I'm sorry* ).

## 0.5.1 / 2014-07-08

  - Bug: A default content-type is added for POST and PUT, if none was given. ( [Fixes #19] )

[Fixes #19]: https://bitbucket.org/gentlero/bitbucket-api/issue/19

## 0.5.0 / 2014-06-09

  - Allow setting custom `Request` and `Response` inside HTTP client, which should facilitate integration in 3rd party software.
  - Implemented basic prioriy for listeners.
  - Bug: Missing content-type made `PullRequests::merge` and `PullRequests::declined` unusable.

## 0.4.1 / 2014-06-01

  - Bug: OAuthListener: Parameters may be included from the body if the content-type is urlencoded. ( [Fixes #18] )

[Fixes #18]: https://bitbucket.org/gentlero/bitbucket-api/issue/18

## 0.4.0 / 2014-05-14

  - Added API 2.0 endpoints for `Users` ( *get, followers, following, repositories* )
  - Added API 2.0 endpoints for `Teams`. ( *profile, members, followers, following, repositories* )
  - Added API 2.0 endpoints for `BranchRestrictions`. ( *all, create, get, update, delete* )
  - Added `delListener()` method for `ClientInterface`.
  - Bug: Mandatory parameters inside PullRequest's methods were not checked.
  - Documentation updated.

## 0.3.0 / 2014-05-12

  Started to implement version 2.0 of the API. 
    - All 1.0 endpoints that have a "twin" in version 2.0 will be updated to use the never version.
    - All specific 2.0 endpoints will be added gradual.

  - Implemented `Commits` and `Commits::Comments` endpoints for API 2.0
  - Updated `Repository` to use API 2.0 (create, delete) and implemented endpoints specific to API 2.0 ( *watchers, forks* )
  - Added `Repository::get()` ( *API 2.0* )
  - Updated `PullRequests::all()` to API 2.0
  - Updated `PullRequests::Comments::get()` and `PullRequests::Comments::all()` to API 2.0
  - Added all endpoints for PullRequests ( *API 2.0* )
  - Added repositories endpoint ( *API 2.0* )
  - Updated `Repositories::PullRequests::all()` to allow `state` param.
  - CS fixes.


## 0.2.1 / 2014-04-21

  - Added `Repositories::PullRequests::all()` method to get a list of all pull requests.


## 0.2.0 / 2014-02-24

  - Bug: group privileges returned 400 error ( [Fixes #14] )
  - Implemented HttpClient which abstracts HTTP layer from base clases and allows custom HTTP libraries to be used.
  - Implemented simple EventListener which can be used to change request before and after its executed.
  - Updated `Api::setCredentials()` to use our new EventListener.

[Fixes #14]: https://bitbucket.org/gentlero/bitbucket-api/issue/14

## 0.1.2 / 2013-12-24

  - Bug: Duplicate array keys in groups filters. ( [Fixes #12] )

[Fixes #12]: https://bitbucket.org/gentlero/bitbucket-api/issue/12


## 0.1.1 / 2013-11-26

  - Removed `newuser` endpoint. ( [Fixes #10] )
  - Removed `repositories/changesets/likes` endpoint. ( [ref #1] )
  - Code clean, fixed typos.

[Fixes #10]: https://bitbucket.org/gentlero/bitbucket-api/issue/10
[ref #1]: https://bitbucket.org/gentlero/bitbucket-api/issue/1


## 0.1.0 / 2013-06-09

  - First public release
