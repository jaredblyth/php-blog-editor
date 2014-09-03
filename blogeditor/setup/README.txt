Blog Editor can be set up and running within just a few minutes by following these steps:

1) Ensure you have access to a PHP server and MySQL database

2) Navigate to the database using phpMyAdmin

3) Set up the following tables using the set-up scripts. Ensure you are in the correct databse and then paste the code into the SQL command line.

- Blog
- Blog Comments
- Members
- Subscribers

(Alternatively, you can manually set up the tables in phpMyAdmin to match the schemas shown in the images above)

4) Upload & unzip the Blog Editor files onto your PHP server

5) Change the database connection info in 'admin/test-connect.php' & 'admin/mysql-connect.php'

6) Change the login password in admin/password.php

7) Change the client variable in 'inc/client.php' (optional)

8) Change the cookie names in 'admin/functions.php', 'login.php' & 'logout.php' (& also 'login_mobile.php' & 'logout_mobile.php') (optional)

9) Provide write access for the 'images' folder (this only needs to be done on some servers if you are restricted from uploading images)

10) Provide write access for 'newsletter-intro.php' & 'newsletter-signature.php' (again, only needs to be done on some servers)

Note - 'view-subscribers.php' is selecting from two tables - subscribers & members - so amend this script if you don't have both of these tables set-up
