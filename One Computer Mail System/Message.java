/**
 * Program 4 Message Class
 * CSCI 150 Professor Collins
 * @author Jack Finamore
 * Last Revised March 14th, 2017
 *
 * This class models an e-mail message.
 */
public class Message 
{
	private String sendersName;
	private String recipientsName;
	private String messageBody;
	
	/**
	 * This class initializes the Message object
	 * 
	 * @param sName the senders name provided
	 * @param rName the recipients name provided
	 */
	public Message(String sName, String rName)
	{
		sendersName = rName;
		recipientsName = sName;
		messageBody = "";
	}
	
	/**
	 * This message returns the senders name
	 * 
	 * @return sendersName the name of the sender
	 */
	public String getSender()
	{
		return sendersName;
	}
	
	/**
	 * This message returns the recipients name
	 * 
	 * @return recipientsName the name of the recipient
	 */
	public String getRecipient()
	{
		return recipientsName;
	}
	
	/**
	 * This message adds the users input into the message body 
	 * 
	 * @param line the line inputed in the main program
	 */
	public void append(String line)
	{
		messageBody += line + "\n";
	}
	
	/**
	 * This message returns the message body to the user
	 * @return messageBody variable holding the text of the body 
	 */
	public String toString()
	{
		return "From: "+ this.recipientsName + "\n" + "To: " + this.sendersName + "\n" + messageBody; 
	}
	
	
	
}//End of Message class
