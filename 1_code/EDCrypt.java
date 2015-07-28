import java.net.*;
import java.io.*;
import java.security.*;
import javax.crypto.*;
import javax.crypto.spec.*;
import java.util.Scanner;
import javax.xml.bind.DatatypeConverter;
import java.nio.charset.Charset;

public class EDCrypt {

    private Cipher cipher;
    private String secretKey = "abcdefghijklmnop"; 
    private String iv = "abcdefghijklmnop";

    private SecretKey keySpec;
    private IvParameterSpec ivSpec;
    private Charset CHARSET = Charset.forName("UTF8");

    public EDCrypt(){

        keySpec = new SecretKeySpec(secretKey.getBytes(CHARSET), "AES");
        ivSpec = new IvParameterSpec(iv.getBytes(CHARSET));
        try {
            cipher = Cipher.getInstance("AES/CFB8/NoPadding");
        } catch (Exception e)
		{e.printStackTrace();}
    }
    public String decrypt(String input){

        try {
            cipher.init(Cipher.DECRYPT_MODE, keySpec, ivSpec);
            return  new String(cipher.doFinal(DatatypeConverter.parseBase64Binary(input))); 
        } catch (Exception e)
		{e.printStackTrace();}
		return "error";
    }
    public String encrypt(String input){
        try {
            cipher.init(Cipher.ENCRYPT_MODE, keySpec, ivSpec);
            return DatatypeConverter.printBase64Binary(cipher.doFinal(input.getBytes(CHARSET))).trim();
        } catch (Exception e)
		{e.printStackTrace();}
		return "error";
    }

}
