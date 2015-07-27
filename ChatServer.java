import java.net.*;
import java.io.*;

public class ChatServer implements Runnable
{  
	private ServerThread clients[] = new ServerThread[10]; //array thread utk setiap client
	private String nicks[] = new String[10];
	private ServerSocket server = null;
	private Thread       thread = null;
	private EDCrypt cryptor = null;
	private int clientOnline = 0; //jumlah client yg online
	
	

   
   public ChatServer(int port)
   {  try
      {  System.out.println("Binding to port " + port + ", please wait  ...");
         server = new ServerSocket(port);
		 cryptor = new EDCrypt();
         System.out.println("Server started: " + server);
         start(); }
      catch(IOException ioe)
      {  System.out.println("Can not bind to port " + port + ": " + ioe.getMessage()); }
   }
   public void run() //loop menerima client
   {  while (thread != null)
      {  try
         {  //System.out.println("Waiting for a client ..."); 
            addThread(server.accept()); }
         catch(IOException ioe)
         {  System.out.println("Server accept error: " + ioe); stop(); }
      }
   }
  public void start() //bikin thread pertama sebagai servernya
   {  if (thread == null)
      {  thread = new Thread(this); 
         thread.start();
      }
   }
   public void stop() //utk stop thread server
   {  if (thread != null)
      {  thread.stop(); 
         thread = null;
      }
   }
   private int findClient(int ID) //cari client (nomor brp di array clients[])
   {  for (int i = 0; i < clientOnline; i++)
         if (clients[i].getID() == ID)
            return i;
      return -1;
   }
   public synchronized void handle(int ID, String In) //yg ngurus&ngirim input" dari client/server
   {  
		String input = "", temp = "";
		input = cryptor.decrypt(In);
		if (input.equals(".bye")) //client keluar dari chatroom
      {  
			temp = cryptor.encrypt(".bye");
			clients[findClient(ID)].send(temp, -1);
			remove(ID); 
		 }
	  else if (input.equals(".list")) //client minta list ID
	  {
		temp = cryptor.encrypt("Displaying online user's ID :");
		clients[findClient(ID)].send(temp, -1);
		for (int i=0; i<clientOnline; i++)
		{
			temp = clients[i].getNick();
				clients[findClient(ID)].send(temp, -1);
		}
	  }
      else //chat dari client ditampilin
         {
			//String tempName = clients[findClient(ID)].socket.getNick();
			
			for (int i = 0; i < clientOnline; i++)
            clients[i].send(In, ID);   
		}
		input = ""; temp = "";
   }
   public synchronized void remove(int ID) //saat client keluar dari chatroom
   {  
	  int temp = findClient(ID);
      if (temp >= 0)
      {  
		ServerThread toTerminate = clients[temp];
        System.out.println("Removing client thread " + ID + " at " + temp);
        if (temp < clientOnline-1)//utk benerin listnya saat ada client yg keluar (biar nggak lompat")
            for (int i = temp+1; i < clientOnline; i++)
               clients[i-1] = clients[i];
        clientOnline--;
        try
        {  
			toTerminate.close(); 
		}
         catch(IOException ioe)
        {  
			System.out.println("Error closing thread: " + ioe); 
		}
         toTerminate.stop(); }
   }
   private void addThread(Socket socket) //yg dilakukan saat client masuk chatroom. (Client baru selalu dimasukin di akhir array)
   {  if (clientOnline < clients.length)
      {  System.out.println("Client accepted: " + socket);
         clients[clientOnline] = new ServerThread(this, socket);
         try
         {  clients[clientOnline].open(); 
            clients[clientOnline].start();
            clientOnline++;
			
		}
         catch(IOException ioe)
         {  System.out.println("Error opening thread: " + ioe); } }
      else
         System.out.println("Client refused: maximum " + clients.length + " reached.");
   }
   
      public static void main(String args[])
   {  ChatServer server = null;
      if (args.length != 1)
         System.out.println("Usage: java ChatServer port");
      else
         server = new ChatServer(Integer.parseInt(args[0]));
   }
}
