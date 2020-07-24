/**
 * Program 4 MailSystem Class
 * CSCI 150 Professor Collins
 * @author Jack Finamore
 * Last Revised: March 14th 2017
 * 
 * This class implements and uses the Mailbox and Message classes.
 * It models a mailsystem with delivering and printing out the inbox's and outbox's of the respective people.
 */
import java.util.ArrayList;

public class MailSystem 
{
	private ArrayList<Mailbox> mbList;
	
	/**
	 * MailSystem method that initializes an array of mailbox objects
	 */
	public MailSystem()
	{
		mbList = new ArrayList<Mailbox>();
	}//End of constructor
	
	/**
	 * deliver method - Delivers the messages to the corresponding mailboxes
	 * @param m a message that is to be sent and delivered
	 */
	public void deliver(Message m)
	{	
		//If the sender and recipient only save the message once instead of twice
		
		int senderBox = getIndex(m.getSender());//Holds location of box of sender
		int recipientBox = getIndex(m.getRecipient());//Holds location of box of recipient
		if(!m.getSender().equals(m.getRecipient()))//Makes sure to prevent that you aren't saving the message twice
		{
			if(senderBox != -1)//Checks to see if the sender has a mailbox
			{
				mbList.get(senderBox).AddMessage(m);//Adds messages to their mailbox
				//For recipient saving in this case
				if(recipientBox != -1 )//Checks to see if the recipient has a mailbox
				{
					mbList.get(recipientBox).AddMessage(m);//Adds messages to their mailbox
				}//End of nested if
				else
				{
					//Creates the Mailbox and adds it
					mbList.add(new Mailbox(m.getRecipient()));
					recipientBox = getIndex(m.getRecipient());
					mbList.get(recipientBox).AddMessage(m);
				}//End of nested else
			}//End of if
			else
			{
				//Creates new mailbox and adds message to mailbox
				mbList.add(new Mailbox(m.getSender()));
				senderBox = getIndex(m.getSender());
				mbList.get(senderBox).AddMessage(m);
				//For recipient saving in this case, same as above
				if(recipientBox != -1)
				{
					mbList.get(recipientBox).AddMessage(m);
				}//End of nested if
				else
				{
					mbList.add(new Mailbox(m.getRecipient()));
					recipientBox = getIndex(m.getRecipient());
					mbList.get(recipientBox).AddMessage(m);	
				}//End of nested else
			}//End of else
		}//End of first if
		else
		{
			if(senderBox != -1)
			{
				mbList.get(recipientBox).AddMessage(m);//Adds messages to their mailbox
			}
			else
			{
				//Creates the Mailbox and adds it
				mbList.add(new Mailbox(m.getRecipient()));
				recipientBox = getIndex(m.getRecipient());
				mbList.get(recipientBox).AddMessage(m);
			}
		}
		
	}//End of deliver method
	
	/**
	 * Method printMessages - prints out the inbox's and outbox's of the respected owners
	 * @param owner - name of the owner of the box
	 * @param messageType - type of box
	 */
	public void printMessages(String owner, String messageType)
	{	
		boolean empty = false;
		Mailbox mbSender;//Mailbox of sender
		Mailbox mbRecip;//Mailbox of recipient
		int indexBox = getIndex(owner);//Location of box for owner
		int size = 0;//The number of messages in the box
		String senderName;//The name of the sender
		String recipientName;//The name of the recipient
		
		if(indexBox != -1)
		{
			size = mbList.get(indexBox).getSize();//The number of messages in the owners box
			for(int i = 0; i < size; i++)
			{
				senderName = mbList.get(indexBox).getMessage(i).getSender();//The senders name based on message in array
				mbSender = mbList.get(getIndex(senderName));
				recipientName = mbList.get(indexBox).getMessage(i).getRecipient(); //The recipients name based on message in array
				mbRecip = mbList.get(getIndex(recipientName));
				
				if(messageType.equals("inbox"))//Checks to see if messageType is inbox
				{
					if(senderName.equals(owner))
					{
							System.out.println(mbSender.getMessage(i));//Prints out the message
							empty = true;
					}
				}
				else if(messageType.equals("outbox"))//Checks to see if messageType is outbox
				{
					if(recipientName.equals(owner))
					{
						System.out.println(mbRecip.getMessage(i));//Prints out the message
						empty = true;
					}
				}
			}//
		}
		if(indexBox == -1 || !empty)//Prints message if their isn't one or if they don't have any messages
		{
				System.out.println("No Messages.");
		}
	}//End of printMessages
	
	/**
	 * Method getIndex - returns spot in mbList of the owners mailbox
	 * @param owner - name of the person who's mailbox you are checking
	 * @return location of owners mailbox
	 */
	private int getIndex(String owner)
	{
		for(int i = 0; i < mbList.size();i++)
		{
			if(mbList.get(i).getOwner().equals(owner))
			{
				return i;
			}//End of if that returns location of selected owners mailbox
			
		}//End of for loop checking against owner
		return -1;
	}//End of getIndex
	
}//End of MailSystem
