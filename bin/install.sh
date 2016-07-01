#/bin/bash

echo "You are about to install demo: set ACL and create database"
read -p "Are you sure? " -n 1 -r
echo    # (optional) move to a new line
if [[ $REPLY =~ ^[Yy]$ ]]
then
    # Manage ACL
    sudo setfacl -R -m u:www-data:rwX -m u:`whoami`:rwX app/cache app/logs
    sudo setfacl -dR -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs

    # Create database and populate
    php app/console doctrine:database:create
    php app/console doctrine:schema:create
fi

