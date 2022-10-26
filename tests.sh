#!/usr/bin/env sh

rm data/userSearches.json
rm tests/bookingRequests.json

echo "{}" >> data/bookingQuotes.json
echo "{}" >> tests/data/behat/userSearches.json

./vendor/phpstan/phpstan/phpstan analyse -l 7 src
if [ $? -eq 0 ]
then
    ./vendor/phpspec/phpspec/bin/phpspec run --format=dot
    if [ $? -eq 0 ]
    then
       exit 0
    fi
fi
exit 1
