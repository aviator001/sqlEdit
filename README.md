<h2>Objective</h2>
Generate web app to view, add and edit data in any MySQL table or Query in just 4 lines of code, with pagination auto generated as well, as are the media queries, to build a truly responsive app that is mobile friendly  and works accross all platforms and screen sizes.
<br><br>
There are in fact 2 main functions, sqlEdit and sqlBrowse. As explained. sqlEdit has the ability ot add.modify data, however sqlBrowse can only generate view only apps.

<h2>Requirements and Dependencies</h2>
<h3>PHP Classes</h3>
<ul>
    <li><b>sql.class.php</b><div>MySQLi Database abstraction and helper class, required in order for forms.class.php to work</div></li>
    <li><b>forms.class.php</b><div>Main class that implements all the functionality. Dependent on sql.class.php</div></li>
</ul>

<h3>Server Operating Systen</h3>
<ul>
    <li>CentOS 7 64 Bit Server OS</li>
    <li>Windows Server, Windows XP, Windows 7, Windows 8, Windows 10 OS</li> 
    <li>MacOS</li>
    <li>MySQL sercer, MariaDB</li>
</ul>

<h3>Server Operating Environment</h3>
<ul>
    <li>PHP > Ver 7.0
    <li>MySQL
    <li>GD</li>
</ul>

<h3>Development Languages</h3>
PHP, MySQL

<h1>Features</h1>

<h3>Pagination</h3>
The automatic pagination uses a truly unique approach to seemless handle datasets ranging from 10 rows to 2 million rows, all without any complicated juggling of page numbers or special case handling code - and what resulys is one of the cleanest pagination implementations that you will see, that handles 10 pages the same way it handles 2,000,000. See examples or screenshots for examples.

Pagination may be turned off or on at any time by seeting the config values in the settings.ini file.

<h3>Styling</h3>
User has full athority of look and feel etc and may set their own styles and class at the desgnated sections that handless css rules.

<h3>Flexibility and ease of Configuration</h3>
Even though it is ridiculously simple to use, we still need to tell it where to find your databse/tables etc. This is done through the configuration file ('settings.ini'). It also has a bunch of other optional parameters, which if not set by you, have little impact on the proper functioning of the object.

<h3>Data View Management</h3>
Easily switch back and forth between the 2 available views - Boxed layout or full width layout, used in order to ease cluttering and conjestion when working on tables with a large nuber of colums or fieldsets.

There exists a trigger point, beyond which, if exceeded, the number of colums is exceeded, the display format switches automatically from the default 'grid view' to the row based 'fieldlist' mode, and each field is displayed on a new page row, and showing only one table record at a time. Subsequent rows are fetched upon the user requesting pages higher in number, using generated page links in the pagination area or by manipulating the page selctoe widget at the bottom of the screen.

<h3>User Experience.</h3>
Data is, without exception, loaded using the jquery ajax library, and as a rtesult, the user is never put through the experience of being constantly interrupted, while waiting for pages reloading over and over, and circumventing the creation of unnecessay high amount of stress externally in the network, and internally on the webserver filesystem i/o operations.

<h3>Global Properties Set via INI File</h3>
Here is a full last of parameters  that you can set in the settings.ini file.

<pre><code>
<b><i>#Database user name</i></b>
db_user=

<b><i>#Database password</i></b>
db_pass=

<b><i>#Name of the database trying to connect to</i></b>
db_name=

<b><i>#Database Server IP Address without any quotes</i></b>
db_server=

<b><i>#Represents the root folder where this application wa installed, in absolute form.</i></b>
host=sugardaddyscam.com/form

<b><i>#Represents the webroot folder, as in the external public web URL in absolute form.</i></b>
app=/form

<b><i>#Represents the publically accesible web url that holds the generated PHP files</i></b>
out_full=/sites/home/scam/public_html/form/output

<b><i>#Represents the internal folder locatiion generated PHP files</i></b>
out=/form/output

<b><i>#Max number of items to be displayed per page</i></b>
items_per_page=5

<b><i>#Max number of items to be displayed per page</i></b>
pagination=on

<b><i>#Max number of items to be displayed per page</i></b>
image_upload_folder=5

<b><i>#Autocomplete catalog table</i></b>
    catalog_db_name=terra
    catalog_tb_name=autocomplete
</code></pre>

<h3>Installation</h3>

<h3>Setup</h3>

<h3>Step by Step Insructions for Usage</h3>
<pre><code>
<?	
	$db_name="Enter database name";
	$table="Enter name of table you want to edit";
	include "class/utils.class.php";
	parse_str(http_build_query($_GET));
	$c=new utils;
	$c->connect(DB_SERVER,DB_USER,DB_PASS,$db_name);
	echo $c->SQLEdit($db_name,$table);
	include "paginate.php";
</code></pre>
<h3>Real World Code Samples</h3>
