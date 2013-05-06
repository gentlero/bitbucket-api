<?php

require_once __DIR__.'/../vendor/autoload.php';

$user = new Bitbucket\API\User;

// Your Bitbucket credentials
$bb_user = 'username';
$bb_pass = 'password';

/**
 * $accountname The team or individual account owning the repository.
 * repo_slub    The repository identifier.
 */
$accountname    = 'company';
$repo_slug      = 'sandbox';


// login
$user->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );

# get user profile
# print_r($user->get());

# update user profile
/*print_r($user->update(array(
    'first_name'    => 'John',
    'last_name'     => 'Doe'
)));*/

# get user privileges
#print_r($user->privileges());

# get a list of repositories an account follows
#print_r($user->follows());

# get a list of repositories visible to an account
#print_r($user->repositories()->get());

# get a list of repositories the account is following
#print_r($user->repositories()->overview());

# get the list of repositories on the dashboard
#print_r($user->repositories()->dashboard());