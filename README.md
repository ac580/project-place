# How to run the project
1. Clone this repository or download the zip file
2. Please open the terminal and cd into this project directory
3. After that, enter command       php -S 127.0.0.1:1337
4. So the web pages can now be linked to this host
5. Enter the link "localhost:1337/login.php" on your browser
6. If you are confused with the functionality of the web, feel free to look at the webexplanation.ppt on the repository.




Note: The host of the sql database is from the UK therefore the response may be a bit slow. If you want to link to your local host, please edit your database detail on those pages:

1. db.php from the Controller folder on line 6: (host,username,password,databasename)
2. bdd.php from the Controller folder on line 5: (host,databasename,username,password)
3. searchClient.php on line157: (host,username,password,databasename)

Then run the script datingsite.sql on your mysql database, make sure you have edit to the name of your database in line 1.
