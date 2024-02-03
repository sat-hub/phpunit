# SATHub PHPUnit

This library is an extension to PHPUnit.

## Database tests

    CREATE DATABASE sathub_phpunit;
    CREATE USER phpunit@localhost IDENTIFIED BY 'testing';
    GRANT ALL ON sathub_phpunit.* TO phpunit@localhost;
