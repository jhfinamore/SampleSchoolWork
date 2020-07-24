/**
 * Program 4 Mailbox class
 * CSCI 150 Professor Collins
 * @author Jack Finamore
 * Last Revised March 14th
 * 
 * This class implements and uses the Message class and creates a Mailbox
 */
import java.util.*;

public class Mailbox
{
	private ArrayList<Message> list;
	private String owner;
	
	/**
	 * Constructor Mailbox - creates a mailbox for a specific person
	 * @param name - name for owner of the box
	 */
	public Mailbox(String name)
	{
		
		list = new ArrayList<Message>();
		owner = name;
	}//End of Mailbox constructor
	
	/**
	 * getOwner method - returns the name of the owner
	 * @return owner - name of mailbox owner
	 */
	public String getOwner()
	{
		return owner;
	}//End of getOwner

	/**
	 * AddMessage method - add messages to list of messages in a specific mailbox
	 * @param m - message the person wishes to send
	 */
	public void AddMessage(Message m)
	{
		list.add(m);
	}//End of AddMessage
	
	/**
	 * getMessage method - returns Message based off which one the user wants
	 * @param i - the number in the list array you wish to access
	 * @return the message at the specific i location
	 */
	public Message getMessage(int i)
	{
		return list.get(i);
	}//End of getMessage
	
	/**
	 * removeMessage method - removes message at specific location
	 * @param i - the number in the list array you wish to access
	 */
	public void removeMessage(int i)
	{
		list.remove(i);
	}//End of removeMessage
	
	/**
	 * getSize method - returns to the user the size of the list array
	 * @return size of list array
	 */
	public int getSize()
	{
		return list.size();
		
	}//End of getSize
	
}//End of Mailbox class
