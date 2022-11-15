A CRUD (Create Read Update Delete) app written in PHP 8.1 connecting to mySQL Database.
It has far more comments than a professional work would need to navigate through the code, but this is my tutorial piece of learning the technology.

# Changelog
## Iteration 1
- Made dbConnect.php which is meant to be placed outside of the webroot and referenced for connection to the DB
- Results.php to fetch the data and form.php to upload data to the DB
- Sanitzed inputs for the DB
- Error messages in the form.php for phone and email
- Added image upload that will save the picture in the /images folder, assign a unique name to it, and save it in the DB

## Iteration 2
- Awitched from mysqli to PDO, added "mysqli" branch to preserve previous Iteration
- Added nav links to the header and added header and footer to all the pages so they can be shown individually instead of crowded on the index.php
- Added a login.php page and hid the form.php behind it, so not everyone can upload data to the DB
- Put the database connection into the header along with starting the session
