WAPH-Web Application Programming and Hacking
Instructor: Dr. Phu Phung
Name: Syed Mannan
Email: mailto:syeda45@udayton.edu
Short-bio: Hi, I’m Syed mannan - a student with a strong interest in cybersecurity and web application security. I’m currently learning secure coding practices and ethical hacking to build safer web applications.
Repository Information
Repository’s URL:  https://github.com/Syedmannan22/waph-Syedmannan22.git
This is a private repository for Syed mannan to store all code from the course. The organization of this repository is as follows.
Lab 1 - Foundations of the Web
Overview:
Lab 1 focused on the foundational concepts of the web specifically the HTTP protocol and the basic web application programming. It was divided into two main parts : 
1. Web and HTTP Protocol
a.	Hands on activities involved using the Wireshark application software to capture and analyze the HTTP traffic and the Telnet to manually send the HTTP requests.
b.	This particular section aimed to thoroughly understand how the HTTP requests and the responses work at the packet level.

2. Basic web application programming
a.	Introducing web application development using CGI - Common gateway interface with C programming.
b.	Covered the basics of PHP for developing simple web applications that handle user input.
https://github.com/Syedmannan22/tree/main/Labs/Lab1

Part 1 : The Web and HTTP Protocol 
Task 1 : Familiar with the Wireshark tool and HTTP protocol
• To examine the HTTP protocol, I used Wireshark, a powerful network protocol analyzer. I started by launching Wireshark with benefits like sudo wireshark & and selected the “any” network interface to capture all available traffic. Once capturing started, I opened a web browser and started surfing http://example.com/index.html. This action generated http traffic, which Wireshark captured in real time.
To identify http packets, I applied the filter http in the display filter bar. This allowed me to focus on HTTP GET and POST requests and their corresponding responses. I selected specific packets to inspect both the HTTP request and HTTP response. Further, I used “Follow HTTP Stream” feature by right clicking the packet to view the complete transaction between the client and server. It made to analyze how the data was transmitted across the network.

Screenshot 1 : HTTP Request Message













Caption: HTTP request message captured in Wireshark showing a GET request to /index.html with headers such as Host and User-Agent.
Screenshot 2 : HTTP Response Message
 
Caption: HTTP response message captured in Wireshark showing a 200 ok status code and headers such as content type and content length.
Screenshot 3 : HTTP Stream












Caption: HTTP stream in Wireshark showing the complete details of both http request in red and http response in blue between the client and server.
Task 2: Understanding HTTP using telnet and Wireshark
Summary :
In this task I used the Telnet program to manually create and send a minimal HTTP request to request to a web server and then used Wireshark to capture and analyze generated http traffic.
Initially I launched Wireshark, filtered the traffic with http and started capturing packets. Then in the terminal I initiated a telnet connection to website example.com
on port 80 using command : telnet example.com 80. Once connected, I typed a minimal HTTP GET request manually using command : GET /inex.html HTTP/1.0 HOST: example.com and pressed enter tab twice to complete the request.
Screenshot 1 : Terminal output of HTTP Request and Response
 
Caption : Terminal screenshot showing a minimal http get request sent using telnet and server http/1.0 200 OK response containing text/HTML content.
Screenshot 2 : HTTP Request in Wireshark
 
Caption : HTTP request in Wireshark from the telnet. compared with browser generated request in Task1 and found that this telent request lacks headers such as user-agent. accept and Accept encoding which makes it much more minimal. The telnet request only includes the minimum Get line and Host Header.
Screenshot 3 : HTTP Response in Wireshark
 

Caption : The Screenshot is a HTTP response of the telnet captured in Wireshark. This response is different from the http response captured message from the one in task 1. the difference I observed was response received via telnet have simple format like HTTP/1.0 instead of HTTP/1.1 depending on the server activity.

Part 2 : Basic Web Application Programming 
Task 1 : CGI Web Applications in C 
A. Basic CGI Program in C
. To develop the Hello world CGI program in C, I first created a simple c file named helloworld.c. In the file I wrote a program that uses the standard printf function to output HTTP headers followed by plain text message. . The program printf the content-type header to indicate that the content is plain text and prints the message “Hello World CGI! From Syed mannan , WAPH”. . Post writing a code, I complied with the gcc compiler with the command gcc helloworld.c -o helloworld.gci, which generated an executable file named helloworld.cgi next enabled CGI module in Apache web server by running the command sudo a2enmod cgid followed by restarting the Apache server using sudo systemct1 restart apache2. . Once server was configured, deployed the compiled CGI executable to standard CGI directory using command sudo cp helloworld.cgi /usr/lib/cgi-bin/. Finally, I tested the CGI program by opening web browser and typing http://localhost/cgi-bin/helloworld.cgi.

Screenshot 1 : CGI Program is invoked properly in the browser 
 
B. Second CGI Program with HTML Content
. As instructed copied previously created helloworld.c into index.c using command cp helloworld.c index.c and wrote a code in html content and plain content. Once the code is completed, compiled and deployed the program and tested the
program using hhtp://local.host/cgi-bin/index.cgi
Screenshot 1 : Second CGI Program 
 


Screenshot 2 : CGI program output with content-type is plain
 

Task 2 : A simple PHP Web Application with user input
A. To develop a basic PHP page i created a file name helloworld.php. This function contains PHP code that prints a simple greeting message along with the output of the phpinfo() function to display the server’s PHP configuration and this helped me to verify PHP is correctly installed and running on the Apache web server.
I saved file to my local lab directory and then copied it to Apache root directory using command : sudo cp helloworld.php /var/www/html/ and after deployment, i accessed in the browser http://localhost/helloworld.php

B. Echo Web Application
I created a PHP script named echo.php, which takes input from the user and echoes it back. I also tested this by accessing the file in a browser and passing my name as a parameter using a GET request in the URL:http://localhost/echo.php?data=SYEDMANNAN](https://github.com/Syedmannan22/waph-syedmannan22/blob/main/labs/lab1/.png).  The browser displayed the input value, confirming that the server correctly handled the user input. I deployed the file by running using command sudo cp echo.php /var/www/html.

Task 3 : Understanding HTTP GET and POST request 
A. Examining HTTP GET Request and Response using Wireshark
. To examine the HTTP GET request and response for the echo.php page I performed the following steps: 
1. Started Wireshark with command sudo wireshark &  and started to capture on any network interface. 
2. opened the web browser and visited the URL: http://localhost/echo.php?data=SYEDMANNAN 3. I returned to Wireshark and applied http filter to focus only on HTTP packets.
4. next located the HTTP GET request to echo.php and to the corresponding HTTP response in the captured packets.
Screenshot 1 : HTTP GET request













Screenshot 2 : HTTP Response














B. Sending an HTTP POST request with curl and analyzing in Wireshark.
To test the POST request i used the curl command - curl -X POST http://localhost/echo.php -d “data=Warm Greetings! ” . This command sends a POST request to echo.php file page with data data=Warm Greetings! Syed mannan . The response from the server is shown directly in the terminal, displaying the echoed name.

•	While running curl, Wireshark was still capturing traffic I located the HTTP POST request Wireshark.
•	The POST request shows the data inside the request body instead of URL.

Screenshot 2 : HTTP stream in Wireshark.










C. Comparison between HTTP GET and POST.
The similarities I observed : 
* Both are HTTP methods used to send requests from the client and to the server. 
* Triger the same echo.php file on server. 
* Both return the similar kind of responses like echoed name in plain text.
The differences :
1.	Data Location :  In HTTP GET the data is sent in the URL query string. 
                                        In HTTP POST the data is sent in the body of the request.

2.	URL example :   In HTTP GET the url is /echo.php?data=Warm Greetings! Syed mannan .     
                             In HTTP POST the url is /echo.php with data data=Warm Greetings! Syed mannan in body.

3.	Visibility 	      : In HTTP GET its visible in browser address bar. 
                                  In HTTP POST it is not shown in the address bar.

 

