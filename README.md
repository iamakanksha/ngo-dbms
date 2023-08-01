# "Light of Hope" - NGO Database Management System
5th semester mini project to fulfill VTU criteria for the subject Database Management System.

### Prerequisites
  1. A Windows/Linux/OS X computer system which supports XAMPP
     software.
  2. XAMPP software
  3. A web browser (Chrome/Mozilla FireFox/Safari)

### Installation of XAMPP
  1. Download XAMPP from Apache Friends. Choose the download with the version of PHP that you need.
  2. Click on the downloaded file to install. Do not start the Control Panel.
  3. In c:\xampp\apache\conf\httpd.conf change the following lines and then restart the XAMPP console.
  4. Click the "Start" buttons next to both "Apache" and "MySQL" in the XAMPP console.
  5. Test your XAMPP installation by opening a web browser and enter  http://localhost:8080/ in the address field.
     The XAMPP page should now appear.
  6. Type http://localhost:8080/phpmyadmin/ in the address field or click phpMyAdmin at the top of the page.

### Importing Database
  1. Click the "Start" buttons next to both "Apache" and "MySQL" in the XAMPP console.
  2. Type http://localhost:8080/phpmyadmin/ in the browser address field.
  3. Click on import tab at the top the page.Choose file eduform.sql and press GO at the end of the page.

### Execution
  1. Assume you installed xampp in C Drive.Place the folder Eduform in "HTDocs" folder located under the "XAMMP" folder on your C: drive. The file path is "C:\xampp\htdocs" for your Web server.
  2. Start the XAMPP program.Click on the "Start" button next to "Apache" to start your Apache Web server in the XAMPP control  panel. When Apache is running, the word "Running" will appear next to it, highlighted in green. Also start "MySQL" if your PHP scripts depend on a MySQL database to run.
  3. To start the site type http://localhost:8080/NGODBMS/Home.html into your browser.

### Understanding usage
The Home page of the site will be opened.Using the tabs given given at the top of the page,the about us,the events page,the work with us page,contact us page,the login page can be accessed.
If you are an employee, give your password and username combination on the login page for an employee or admin depending on your privileges and press the button "Log In".Once you log in, you will be directed to your Login session page and your personalised dashboard.

If you are not a employee, you do not have privileges to function the NGO database management system.
The employee dashboard allows you to view your events ,your donations ,your beneficiaries,your volunteers.You are allowed to edit your volunteers and donations collected by you.
The admin dashboard allows for all functions that lead to the manipulation of the entire NGO database.