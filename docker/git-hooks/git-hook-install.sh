#!/bin/sh

# Symlink the git pre-commit hook to its destination: run ./git-hook-install.sh
if [ ! -h ".git/hooks/pre-commit" ] ; then
   ln -s $PWD"/docker/git-hooks/pre-commit" ".git/hooks/pre-commit"
fi

if [ ! -h "../.git/hooks/pre-push" ] ; then
   ln -s $PWD"/docker/git-hooks/pre-push" ".git/hooks/pre-push"
fi