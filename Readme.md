# Repository for the PLM Migration Project

## For YFJC/JCI Internal Use Only
## Michael Leng


---

## Information

This is the repository containing the source files for the web application created by Michael Leng during an internship period at the YFJC offices in Kangqiao. This web application and source files are for __YFJC/JCI internal use only__ and __may not__ be distributed freely. This repository was created as a means of collaboration between team members for this project only. This web application is to be used by YFJC/JCI engineers, migration team members, and administrators/schedulers as a tracking tool and migration assistant for the migration of files from the flat file server system to TeamCenter. Please email Michael Leng or Wolfix Cai for more details.

At the moment, the only files housed in this repository are the source files for the web application.


---

## Technical

This source code and web application was developed in a local development environment. Details are as follows:

	+ Built on OSX 10.10.3
	+ Built with XAMPP 5.6.8-0
	+ Built and tested on Apache 2.4.12
	+ Built and tested on MySQL 5.6.24
	+ Built and tested on PHP 5.6.8
	+ Built and tested with phpMyAdmin 4.4.3

If you would like to run this web application locally, you will need XAMPP or a similar software package. This web application also requires a database and multiple tables with sample data as well as other file modifications to run properly. Details are as follows:

	+ Modify SQL server settings in `imports/config.php` and `imports/configData.php`
		+ The primary key must be set to `id`, foreign key to `programid`, and `programid` must be a unique key in the `program` table.
	+ Modify database table settings in `imports/dataMigration.php` and `imports/dataEnditem.php`
	+ Modify the location of your joblist.txt in `updateTxt.php`
		+ You must modify permissions of the joblist.txt file on your server to `rw` for all users
	+ There are probably more modifications you need to make before the application will run properly, but these are all I remember off the top of my head. If you're setting up this web application up on your server and see any modifications that need to be made for the application to run, please fork the repository, add an entry here in `Readme.md`, and submit a pull request.

As you can probably see, it's not a great idea to set this web application up locally or on a server - at least for now - as it is still very much in development and can break at any time. There are also some other aspects that need to be setup before the web application will run smoothly on a different device, and will be added to the readme in the future. In the future more information and the databases with sample data will be actually added to the repository to make setting this application up and testing it much easier.


---

## Bugs and Broken Things

This is just a list of things that are either currently buggy or broken and are in line to be fixed.

	+ Authentication kind of doesn't work
		+ Username input into the `#usernameField` field is not passed to the `authMain.php` file properly
	+ More to be discovered...

This is just a list of things that used to be bugged or broken but have been fixed

	+ [FIXED] Refreshing from the database while viewing the enditem dashboard throws errors
	+ [FIXED] Inline editing does not push changes to MySQL database
	+ [FIXED] Inline table buttons in `enditemdash.php` do not work and throw errors
	+ [FIXED] % cleaned field in `migrationdash.php` throws errors.
	+ [FIXED] ItemQty field does not display proper data


---

## To-Do

	+ Implement login page and authentication
		+ Implement permissions levels
		+ Implement user authentication on page change with URL variables
	+ Add actions to inline buttons in `enditemdash.php`
	+ Add functionality to download button

	+ More to come...

## Done

	+ [DONE] Framework for both `migrationdash.php` and `enditemdash.php`
	+ [DONE] Finish inline editing
	+ [DONE] Add basic on-page documentation and help
	+ [DONE] Dynamically generated `itemqty` and `percentcleaned` values
	+ [DONE] Add new page with CAD file path, Program ID, and Catia release user input fields

## Scrapped
	
	+ [SCRAPPED] Add ability to add new entries to the migration dashboard's connected database: `migration`


---

## More to come...