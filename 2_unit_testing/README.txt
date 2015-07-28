Readme2: Unit Testing


---- Valet Parking Interface ----

To test my code, you need to have the be able to run the app:
http://developer.android.com/training/basics/firstapp/running-app.html

When the code is running the virtual device will run. You need to click on the app in
the virtual machine. Then you can test the app by putting input. Watch as you press the
"Welcome to Fit-a-Lot. Click here to start". You will notice that when you press this
I simulated a database with registations by implementing a random generator that acts
as a license plate reader. Each time you press the button simulates another car coming
into the garage. The button will lead you to one of two screens.

1. You have a reservation
 or
2. You do not have a reservation

If you do have reservation, you will see your information that you will verify by pressing
the button. Then, you will click the screen again to open the gate and restart the screen for
the next person.

If you do not have a reservation, you will see a screen that asks for a time to pick up
your car. You will then be asked to input your phone number and then swipe your drivers
license which is simulated by a button. You then click the screen again to open the gate
and reset the screen for the next person.

Demo 2:

	A database has been programmed into the valetparking assistant for the purposes of this demo. When you open the code 
you will see an array programmed with five people containing their information. 

Initially the application will ask you if you are a customer or a valet. If you are a customer you will be asked if it is a 
walk-in or a reservation. If you are a reservation it will ask you for your license plate once entered the information realted to
the license plate will appear on the screen such as Name,ticket number and lot number. If the customer is a walk-in the application
will ask the user for their drivers license number and it will show their information. The user if a walk-in will be asked approx.
what time they will be leaving at. 

Now the car is handed over to the valet. The car must go through a security check to be parked. Once the car is parked each
car will be provided with a lot number. 

When the customer would like to take their car back the valet simply inputs the ticket number and the car is successfully returned. 



~ Justin Cruz


---- Website and Databse -----
HOW TO TEST:

The website is tested by pointing the browser to se1.engr.rutgers.edu/~13group5 and 
then navigating
to other pages on the site, and making sure all links are working properly and are 
vectoring to the
right place.
Within the website, testing of the forms is done by filling out the forms and submitting the 
information.
After the submition, logging into se1.engr.rutgers.edu/phpmyadmin, and manually viewing the tables within 
the 
database to make sure that the tables were correctly created, and that all the information was stored
correctly.

~ Matthew Brazza


---- Algorithms -----
HOW TO TEST:

The program outputs three files: parking.txt, parkingTest.txt, and parkingView.txt

parking.txt is strictly for I/O operations and should not be viewed.

parkingTest.txt is a formatted output file that can be used to check if the program correctly loaded the 
previous iteration of the matrix.

parkingView.txt is a formatted output file that can be used to check the current status of the reservations.  
Changes made in the program are immediately saved within this file and parking.txt.  parkingView.txt is the 
primary file to check if the program is working correctly.

~ Sean Wang


----Reservation and Database----
HOW TO TEST:
Once we are at the website on the top of the page as a header, you will see the reservation tab. On the reservation page,once your arrow is hovered on the
reservation page the drop-down menu will pop-up and create a reservation, edit a reservation and delete a reservation will be displayed. Then once you click
create a reservation you will be forwarded to a online reservation page.
Once you fill in the required form, the information will be saved on the database.
To view that information, which has been entered go to se1.engr.rutgers.edu/phpmyadmin and intable reservation123 you should be able to 
view the information which has been entered. 

Demo 2:

 Implemented for this demo on the header you will see the page for the manager. Once a mouse is hovered on the managers page there are two options,
1)input data and 2)view graph. The graph provided is to see how well the parking garage is doing and when is the parking garage making the most profit
and when it is making the least profit. Once the manage clicks on input data, he will be forwarded to a form where he will enter the data, once entered he can
use the graph and analyse the data to maximize profits.


~Parth Patel
