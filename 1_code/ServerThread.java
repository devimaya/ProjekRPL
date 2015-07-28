/*
Thread ini adalah untuk menerima input dari setiap client yang ada di dalam chatroom.
*/
import java.net.*;
import java.io.*;

public class ServerThread extends Thread
{  private ChatServer server = null;
   private Socket socket = null;
   private int ID = -1;
   private DataInputStream  streamIn  =  null;
   private DataOutputStream streamOut = null;
   
   private String nickname = null;

   public ServerThread(ChatServer tServer, Socket tSocket)
   {  super();
      server = tServer;
      socket = tSocket;
      ID     = socket.getPort();
	  nickname = "Client" + Integer.toString(ID);
   }
   public void send(String msg, int ID)
   {   try
       {  streamOut.writeUTF(msg);
          streamOut.flush();
		  
		  //edit
		  streamOut.writeInt(ID);
		  streamOut.flush();
       }
       catch(IOException ioe)
       {  System.out.println(nickname + " ERROR sending: " + ioe.getMessage());
          server.remove(ID);
          stop();
       }
   }
   public int getID()
   {  return ID;
   }
   
   public String getNick()
   {
	return nickname;
	}
   
   public void run() //loop utama (utk baca input)
   {  System.out.println("Server Thread " + ID + " running.");
      while (true)
      {  try
         {  server.handle(ID, streamIn.readUTF());
         }
         catch(IOException ioe)
         {  System.out.println(ID + " ERROR reading: " + ioe.getMessage());
            server.remove(ID);
            stop();
         }
      }
   }
   
   
   
   public void open() throws IOException
   {  streamIn = new DataInputStream(new 
                        BufferedInputStream(socket.getInputStream()));
      streamOut = new DataOutputStream(new
                        BufferedOutputStream(socket.getOutputStream()));
   }
   public void close() throws IOException
   {  if (socket != null)    socket.close();
      if (streamIn != null)  streamIn.close();
      if (streamOut != null) streamOut.close();
   }

   
   
}
