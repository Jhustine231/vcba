# PHP Complete CRUD Application

### ****Creating the Database Table****

Create a table named *crud* inside your MySQL database using the following code.

```sql
CREATE TABLE `stud_sched` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `stud_name` varchar(255) NOT NULL,
  `stud_sub` varchar(255) NOT NULL,
  `stud_time` varchar(255) NOT NULL,
  `stud_day` varchar(255) NOT NULL,
  `stud_grade` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
)
```

### ****Copy files to htdocs folder****

Download the above files. Create a folder named *crud* inside *htdocs* folder in *xampp* directory. Finally, copy the *crud* folder inside *htdocs* folder. Now, visit [localhost/crud](http://localhost/crud) in your browser and you should see the application.
