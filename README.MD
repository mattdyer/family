Getting Started

Copy the json files from exampledata/ into data/.  These can be modifed to include your family.

Then run 

    /index.php?section=setup&page=SetupOptions


Enter a password for the site.  This will setup a login with the user name 'user1' and the password that you enter.

The data in the data folder will also be imported.

Start site
    docker-compose up

Running Tests

in another terminal run

    docker-compose restart composer

results will show in terminal where site was started