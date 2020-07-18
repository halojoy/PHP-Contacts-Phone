----
-- phpLiteAdmin database dump (https://www.phpliteadmin.org/)
-- phpLiteAdmin version: 1.9.8.2
-- Exported: 6:33pm on July 4, 2020 (CEST)
-- database file: data\sqlite.db
----

----
-- Table structure for contacts
----
CREATE TABLE contacts(
            id INTEGER PRIMARY KEY,
            fname TEXT COLLATE NOCASE,
            lname TEXT COLLATE NOCASE,
            phone TEXT UNIQUE,
            city  TEXT );

----
-- Table structure for users
----
CREATE TABLE users(
            id INTEGER PRIMARY KEY,
            uname TEXT COLLATE NOCASE,
            upass TEXT );

----
-- structure for index sqlite_autoindex_contacts_1 on table contacts
----
;
