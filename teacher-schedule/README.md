# PHP Complete CRUD Application

### ****Creating the Database Table****

Create a table named *crud* inside your MySQL database using the following code.

```sql
CREATE TABLE `teach_sched` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `teach_name` varchar(255) NOT NULL,
  `teach_sub` varchar(255) NOT NULL,
  `teach_time` varchar(255) NOT NULL,
  `teach_day` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
)
```

### ****Copy files to htdocs folder****

Download the above files. Create a folder named *crud* inside *htdocs* folder in *xampp* directory. Finally, copy the *crud* folder inside *htdocs* folder. Now, visit [localhost/crud](http://localhost/crud) in your browser and you should see the application.
