A CRUD (Create Read Update Delete) app written in PHP 8.1 connecting to mySQL Database.
It has far more comments than a professional work would need to navigate through the code, but this is my tutorial piece of learning the technology.

#Changelog
##Iteration 1
- made dbConnect.php which is meant to be placed outside of the webroot and referenced for connection to the DB
- results.php to fetch the data and form.php to upload data to the DB
- sanitzed inputs for the DB
- error messages in the form.php for phone and email
- addedd image upload that will save the picture in the /images folder, assign a unique name to it, and save it in the DB

##Iteration 2
- switched from mysqli to PDO, added "mysqli" branch to preserve previous Iteration
- added nav links to the header and added header and footer to all the pages so they can be shown individually instead of crowded on the index.php
