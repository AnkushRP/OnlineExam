# DBMS-MINI-Project
 DBMS project on topic Online Examination System

## Acknowledgements

- Original project by [rakesh-m-r](https://github.com/rakesh-m-r)
- PHPMailer for email handling: [PHPMailer GitHub](https://github.com/PHPMailer/PHPMailer)

### Modifications by me

- Integrated MailHog for local email testing
- Fixed SMTP and password reset issues

This project retains the original Apache License 2.0. See the LICENSE file for details.

Note: This project is for demonstration purposes. Email functionality uses MailHog to simulate sending OTPs. No real Gmail or SMTP authentication required. Passwords are hashed using PHP crypt() before storing in the database.

<b>Technology Used:</b>

<b>Front-End:</b> HTML,CSS,JavaScript

<b>Back-End:</b> PHP,MySql

<b>Software Used:</b>XAAMP

ONLINE EXAMINATION SYSTEM is a web-based examination system where
examinations are given online. either through the internet or intranet using computer
system. The main goal of this online examination system is to effectively evaluate the
student thoroughly through a totally automated system that not only reduce the required
time but also obtain fast and accurate results.


ONLINE EXAMINATION SYSTEM is an online test simulator is to take online
examination, test in an efficient manner and no time wasting for manually checking of the
test paper. The main objective of this web based online examination system is to
efficiently evaluate the student thoroughly through a fully automated system that not only
saves lot of time but also gives fast and accurate results. For students they give papers
according to their convenience from any location by using internet and time and there is
no need of using extra thing like paper, pen etc.


Functional Specification:
This is a simple Online Examination System mini-project developed using PHP and MySQL.
The project includes a secure password reset feature using OTP verification.
1. Student and Staff login system
2. Password reset via OTP
3. OTP emails captured locally using MailHog (no real email required)
4. MySQL database for user storage
5. Simple and responsive frontend

<b>Schema Diagram</b>
 <img src="https://imgur.com/CEVPaEm.png" width=100%>
 
 
<b>ER-Diagram</b>
<img src="https://imgur.com/cXSgrXO.png" width=100%>


<b>How to run this project locally</b>
1. Install XAMPP (PHP + Apache + MySQL + phpmyadmin + fakesendmail).
2. clone this repo to htdocs folder in XAAMP software.
3. Open xampp-control.exe file and then click start for Apache and MySQL.
4. Open http://localhost/phpmyadmin & Create new database with name projet.
5. import the SQL file present in SQL Files Folder using import option in phpmyadmin.
6. Change credentials in sql.php file with your database credentials(for xaamp default credentials available, database name we shud give same as created in phpmyadmin(in this case it is "projet").
7. open http://localhost/ (name of folder u have cloned in htdocs folder) . you see the home page.
8. Also u can open http://localhost/phpmyadmin to make any changes.
9. For password reset mail->Open MailHog UI: http://127.0.0.1:8025 (for this https://github.com/mailhog/MailHog/releases/download/v1.0.1/MailHog_windows_386.exe needed to be installed) and run .exe file of it).








