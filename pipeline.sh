#!/bin/bash
d
cd main
composer install
ret=$?
if [ $ret != 0 ]
then
    exit $ret
fi

composer run tests
ret=$?
if [ $ret != 0 ]
then
    exit $ret
fi
cd ..