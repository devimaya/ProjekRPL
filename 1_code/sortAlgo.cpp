//Written by: Sean Wang
//Tested by: Sean Wang
//Debugged by: Sean Wang

// SORT ALGORITHM


#include<iostream>
#include<fstream>
#include<string.h>
#include<stdio.h>
#include<stdlib.h>
#include<math.h>
#include<ctime>
#include<iomanip>

#define parkSize 9  // change # of parking spots
#define timeIntervals 10 // Number of time units per day.
// 96 for a full 24-hour day

using namespace std;

void loadMatrix ( int **inputArray);
void cleaner( int **inputArray);
void sort (int ** sortArray);

int main(int argc, char *argv[]) {
  int **parkingID;
  parkingID = new int*[parkSize];
  for (int i=0; i < parkSize; i++){
    parkingID[i] = new int[timeIntervals];
  }
  if (parkingID == NULL) {
    cout << "Out of Memory \n" << endl;
    return 0;
  }
  
  // initialize to zero
  for(int x= 0; x < parkSize; x++ ){
    for(int y=0; y< timeIntervals;y++){
      parkingID[x][y]=0;
    }
  }
  
  loadMatrix(parkingID);// load current matrix information to the table
  
  /*
  ** COMMENTED OUT FOR DEMONSTRATION PURPOSES **

  cleaner(parkingID);// cleans up any old reservations

  */
  /*
  ** CHECKS THAT FILE IS PROPERLY MADE **

  ofstream out3 ("parkingTest.txt");
  for (int x = 0; x < parkSize; x++) {
    for (int y = 0; y < timeIntervals; y++) {
      if ( y == timeIntervals-1 ){
	out3 << parkingID[x][y] << endl;
      }
      else{
	out3 << parkingID[x][y];
      }
    }
  }
  */
     // input should be extracted from the database
  int timeLength = 0;//input timeLength/15
  int timeStart = 0; //input timeStart / 15
  int resType = 0; // need to pull this
  int resID = 0;
  int time1,time2;
  int reserveFlag=0;
  int checkFlag=0;
  int i,j,k;
  for(i =1; i < argc; i++)
    {
      if( strcmp(argv[i], "-reserve") == 0)
	{
	  reserveFlag = 1;
	  timeStart = atoi(argv[i+1]);
	  timeLength = atoi(argv[i+2])-timeStart;
	  resType = atoi(argv[i+3]);
	  if (resType > 4 || resType < 0) {
	    cout << "Reservation type incorrect" << endl;
	    return 0;
	  }
	  resID = atoi(argv[i+4]);
	  if ( resID < 10) {
	    cout << "resID incorrect" << endl;
	    return 0;
	  }
	}
      if( strcmp(argv[i], "-clean")==0) {
	cleaner(parkingID);
      }
      
      if( strcmp(argv[i], "-check") == 0)
	{
	  checkFlag = 1;
	  time1 = atoi(argv[i+1]);
	  time2 = atoi(argv[i+2]);
	  resID = atoi(argv[i+3]);
	}
      if ( strcmp(argv[i], "-sort") == 0){
	sort(parkingID);
      }
    }
  if ( checkFlag == 1) {
    //perform check function
    for( j=0 ; j<parkSize; j++) 
	{
	  if (parkingID[j][time1] == resID) {
	    for (k=0; k<(time2-time1); k++) {
		if(parkingID[j][time1+k] != 0) {
		  printf("%d",parkingID[j]);
		}
	      }
	  } 
	}
  }
  else if ( reserveFlag == 1) {
    //FCFS reservation
    //sort function occurs at different time
    for(i=0; i < parkSize; i++) {
      if ( parkingID[i][timeStart] == 0 ) { //initial condition check
	//check entire space is available
	for( int j = 0; j < timeLength; j++) {
	  if(parkingID[i][timeStart+j] != 0) {
	    goto failure;
	  }
	}
	//insert reservation at this time;
	//if previous statement completes
	for( int j = 0; j < timeLength; j++) {
	  parkingID[i][timeStart+j] = resType;
	}
	parkingID[i][timeStart]=resID; // set start of resrevation with reservation ID
	cout << "Slot reserved successfully" << endl;
	goto breakloop;
      }
    failure:; //skip to next slot if the whole space is not available
    }
    cout << "No available parking" << endl;
  breakloop:; // slot reserved successfully
  }
  ofstream out ("parking.txt");
  for (int x = 0; x < parkSize; x++) {
    for (int y = 0; y < timeIntervals; y++) {
      out << parkingID[x][y]<<endl;
    }
  }
  out.close();
  int data;
  ofstream out2 ("parkingView.txt");
  for (int x = 0; x < parkSize; x++) {
    for (int y = 0; y < timeIntervals; y++) {
      data = parkingID[x][y];
      if ( y == timeIntervals-1 ){
	out2 << data << endl;
      }
      else{
	setw(15);
	out2 << data<< " ";
      }
    }
  }
  out2.close();
  for ( i=0; i < parkSize; i++){
    delete parkingID[i];
  }
  delete parkingID;
}

void loadMatrix (int **inputArray) {
  int x=0,y=0;
  int data;
  const char *inname = "parking.txt";
  ifstream infile(inname);
  if (!infile) {
    cout << "Cannot open file. Creating new one.\n";
    return;
  }
  for( x= 0; x < parkSize; x++ ){
    for( y=0; y< timeIntervals;y++){
      infile >> data;
      inputArray[x][y]=data;
    }
  }
  infile.close();
}

void cleaner (int **inputArray) {
  //get current time
  time_t t =time(0);
  struct tm * now = localtime(&t);
  int time = ceil(((now->tm_hour)*60 + now->tm_min)/15);
  
  int i,j,k;
  for ( i = 0; i < parkSize; i++ ) {
    if ( inputArray[i][time]==0){
      //delete everything previous
      for (k=0;k<time;k++){
	inputArray[i][k]=0; // delete the reservation;
      }
    }
    else {
      continue; // check next spot;
    } 
  }
}

void sort(int **sortArray){
  int i,j,k,time1,time2,end,start,resID,length,before,after;
  int bci=0,aci=0,bc=0,ac=0;
  int counter =0;
  int originID;
  cout << "sort function initialization" << endl;
  for(i =0; i < parkSize; i++) {
    for ( j=0; j < timeIntervals; j++) {
      // find reservation to sort
      if (sortArray[i][j] == 2) {
	counter = 0 ;
	originID = i;
	//get length of reservation
	time1 = j-1;
	while(sortArray[i][j]==2){
	  j++;
	}
	time2= j-1;
	cout << "time 1 " << time1 << " time 2 " << time2 << endl;
	cout << "time 1 " << sortArray[i][time1] << " time 2 " <<sortArray[i][time2] << endl;
	// get initial before and after counter count.
	int timeLength = time2-time1;
	resID = sortArray[i][time1];
	end=time2+1; start=time1-1;
	bci=0;aci=0;
	while(sortArray[i][start]==0 && start!=0){
	  ++bci; start--;
	}
	while(sortArray[i][end]==0 && end!=parkSize ){
	  ++aci; end++;
	}
	cout << "aci:" << aci << " bci:" << bci << endl;
	// check other parking spots for better spot
	while (counter < bci || counter < aci){
	  for(i=0; i< parkSize; i++) {
	    // check for fit
	    cout << "fit check: "<< i << endl;
	    if ( sortArray[i][time1] == 0 ) { //initial condition check
	      //check entire space is available
	      for( int j = time1; j <=time2; j++) {
		if(sortArray[i][j] != 0) {
		  goto next;
		}
	      }
	    }
	    else {
	      continue;
	    }
	    //get before and after counter
	    end=time2+1; start=time1-1;
	    bc=0,ac=0;
	    cout << "end: " << end << " start: " << start << endl;
	    while(sortArray[i][start]==0 && start!=0){
	      ++bc; start--;
	    }
	    while(sortArray[i][end]==0 && end!=parkSize ){
	      ++ac; end++;
	    }
	    cout << "ac:" << ac << " bc:" << bc << endl;
	    //insert reservation at this time;
	    //if previous statement completes
	    // and ac/bc is less than the current counter
	    
	    if(ac <= counter || bc <= counter){
	      for( j = time1; j <= time2; j++) {
		sortArray[i][j] = 2;
	      }
	      sortArray[i][time1]=resID; // set start of reservation with reservation ID
	      //remove original reservation
	      for( j = time1; j <= time2; j++) {
		sortArray[originID][j] =0;
	      }
	      cout << "Reservation ID: " << resID << " moved successfully" << endl;
	      goto breakloop;
	    }
	    else {
	    counter++;
	    cout << "counter: " << counter << endl;
	    next:;
	    }
	  }
	}
      }
    }
  breakloop:; // success, find another spot to move
  }
}
