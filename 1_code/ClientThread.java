/*
Thread ini adlh utk print string yang dikirim oleh server/client lain.
Fungsi printnya (client.handle) ada di class ChatClient. Di thread ini cuma buat manggil fungsi itu aja.
*/
import java.net.*;
import java.io.*;

public class ClientThread extends Thread
{  private Socket socket = null;
   private ChatClient client = null;
   private DataInputStream streamIn = null;

   public ClientThread(ChatClient tClient, Socket tSocket)
   {  client = tClient;
      socket = tSocket;
      open();  
      start();
   }
   
   public void open()
   {  try
      {  streamIn  = new DataInputStream(socket.getInputStream());
      }
      catch(Exception e)
      {  e.printStackTrace();
         client.stop();
      }
   }
	public void close()
	{  
	try
      {  if (streamIn != null) streamIn.close();
      }
    catch(Exception e)
      {  e.printStackTrace();
      }
   }
	public void run()
	{  
		while (true)
		{  try
			{  
			//edited
				String a = streamIn.readUTF();
				int b = streamIn.readInt();
				client.handle(a,b);
			}
         catch(IOException ioe)
         {  System.out.println("Listening error: " + ioe.getMessage());
            client.stop();
         }
      }
   }
}
