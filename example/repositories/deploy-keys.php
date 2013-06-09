<?php

require_once __DIR__.'/../../vendor/autoload.php';

$dk = new Bitbucket\API\Repositories\Deploykeys;

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
$dk->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );

# get a list of keys
print_r($dk->all($accountname, $repo_slug));

# get a key content
#print_r($dkey->get($accountname, $repo_slug, 508372));

# add a new key
#print_r($dkey->create($accountname, $repo_slug, 'ssh-rsa [...]', 'test key'));

# update an existing key
#print_r($dkey->update($accountname, $repo_slug, '508380', array('label' => 'test [edited]')));

# delete an existing key
#print_r($dkey->delete($accountname, $repo_slug, '508380'));