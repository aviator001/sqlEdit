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


<h2>Installation</h2>
<div>2 step process. Get files, and configure. Done. You can get the source files in 2 ways. GIT or download a zip.</div>

<h3>Step 1 </h3>
<h4>OPTION 1</h4>
<pre><code>
git clone https://github.com/aviator001/sqlEdit.git
</code></pre>

<h4>OPTION 2</h4>
<h4>Download from link below:></h4>
<pre><code>
https://gangsterforms.com/sqlEdit.zip
</code></pre>

<div>Once downloaded, unzip archive anywhere.


<h3>Step 2 </h3>
<h4>Configure settings.ini</h4>

<div>Both options, GIT and Zip file download it will create a folder call sqlEdit. As part of the next an final step, you will configure your settings, by modifying the settings.ini file that is in the sqlEdit folder.</div>

<div>Configure your settings.ini file with the information below and you  mare done with configuration.</div>
<div>Here is a full last of parameters  that you can set in the settings.ini file.:</div>
<ul>
<li>Database Server IP</li>
<li>Database Username</li>
<li>Database Password</li>
<li>Database Name</li>
</ul>
<div>And this is what settings.ini looks like</div>
<pre><code>
<b><i>#Database user name</i></b>
db_user=

<b><i>#Database password</i></b>
db_pass=

<b><i>#Name of the database trying to connect to</i></b>
db_name=

<b><i>#Database Server IP Address without any quotes</i></b>
db_server=

<b><i>#Max number of items to be displayed per page</i></b>
items_per_page=5

<b><i>#Max number of items to be displayed per page</i></b>
pagination=on
</pre></code>

<h2>Insructions for Usage</h2>
<h3>Step 1</h3>
<h4>Edit sampleCode.php'</h4>
<div>Once settings.ini is configured, open up the sample code php file - and enter in values fro the database and table (first 2 lines  as shown below.)</div>

<h3>Step 2</h3>
<h4>Run sampleCode.php'</h4>
<div>Open sampleCode.php in your browser, and you will be presented with the data from the table that you specified in editable format.</div>

<h2>Real World Code Samples</h2>
<pre><code>
	/* Modify first 2 lines only! */
	// Enter the MySQL Database Name that has the table you want to edit
	$db_name="Enter database name";
	// Enter the MySQL table that you want to edit data for
	$table="Enter name of table you want to edit";
	/* do Not edit below this line */
	
	parse_str(http_build_query($_GET));
	include "class/utils.class.php";
	$c=new utils;
	$c->connect(DB_SERVER,DB_USER,DB_PASS,$db_name);
	echo $c->SQLEdit($db_name,$table);
	include "paginate.php";

</code></pre>
