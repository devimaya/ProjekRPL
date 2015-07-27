import java.net.*;
import java.io.*;
import java.security.*;
import javax.crypto.*;

public class ChatClient implements Runnable
{  
	private Socket socket = null;
	private Thread thread = null;
	private DataInputStream  console = null;
	private DataOutputStream streamOut = null;
	private ClientThread client = null;
	private EDCrypt cryptor = null;
	
	public ChatClient(InetAddress iAddress, int serverPort)
	{  
		System.out.println("Establishing connection. Please wait ...");
		try
		{  
			socket = new Socket(iAddress, serverPort);
			cryptor = new EDCrypt();
			System.out.println("Connected: " + socket);

			start();
		}
		catch(UnknownHostException uhe)
		{  
			System.out.println("Host unknown: " + uhe.getMessage()); 
		}
		catch(IOException ioe)
		{  
			System.out.println("Unexpected exception: " + ioe.getMessage()); 
		}
   }
   
   public void run() //loop utama, utk nerima user input n kirim ke server&client laen
   {  while (thread != null)
      {  try
         {  
			String a= console.readLine();
			String b = cryptor.encrypt(a);
			streamOut.writeUTF(cryptor.encrypt(a));
			streamOut.flush();
			}
         catch(IOException ioe)
         {  System.out.println("Sending error: " + ioe.getMessage());
            stop();
         }
      }
   }
	public void handle(String msg, int tes) //fungsi print message & exit jika ada command exit
	{  
		String dMsg = cryptor.decrypt(msg);
		if (dMsg.equals(".bye"))
      {  
		System.out.println("Good bye. Press RETURN to exit ...");
        stop();
      }
      else//edited
	  {
			System.out.println("Client"+tes + " : " + dMsg);
			System.out.println("("+msg+")");
			System.out.println();
		}
   }
   public void start() throws IOException //awal saat client dbuka. buat input dan output stream dan start thread utama client
   {  console = new DataInputStream(System.in);
      streamOut = new DataOutputStream(socket.getOutputStream());
      if (thread == null)
      {  client = new ClientThread(this, socket);
         thread = new Thread(this);                   
         thread.start();
      }
   }
   public void stop()
   {  if (thread != null)
      {  thread.stop();  
         thread = null;
      }
      try
      {  if (console != null)  console.close();
         if (streamOut != null)  streamOut.close();
         if (socket != null)  socket.close();
      }
      catch(IOException ioe)
      {  System.out.println("Error closing ..."); }
      client.close();  
      client.stop();
   }
   
   
   public static void main(String args[]) throws UnknownHostException
   {  
		ChatClient client = null;
		InetAddress address;
		if (args.length != 2)
        System.out.println("Usage: java ChatClient host port");
		else
        {
			address=InetAddress.getByName(args[0]);
			client = new ChatClient(address, Integer.parseInt(args[1]));
		}
		
		
   }

}
