/**
 * Prog5 Main Class
 * CSCI 150 Program 5
 * @author - Jack Finamore
 * Last Revised March 20th 2017
 * 
 * This program provides a client side mail system with one user logged in at a time.
 * (It models a one computer mail system)
 */
import java.util.Scanner;
public class Prog5 {

	public static void main(String[] args) 
	{
		String user = "";
		Scanner console = new Scanner(System.in);
		MailSystem mailSystem = new MailSystem();
		String menuChoice;
		Boolean menuBreak = true;
		while(menuBreak)
		{
			System.out.println("L)og In W)riteMessage I)nbox S)ent Mail O)ff-Log Out E)xit");
			menuChoice = console.next();
			switch(menuChoice)
			{
			case "L":
				user = userLogIn(console, user);
				break;
			case "W":
				writeMessage(user, console, mailSystem );
				break;
			case "I":
				display('I', mailSystem, user );
				break;
			case "S":
				display('S', mailSystem, user);
				break;
			case "O":
				user = userLogOut(user);
				break;
			case "E":
				System.out.println("Thank you for using the Mail System.");
				menuBreak = false;
				console.close();
				break;
			default:
				System.out.println("Please enter one of the options provided. It is case sensitive.");
				break;
			}//End of switch
			
		}//End of while loop
		
	}//End of main

	/**
	 * Method printError - prints an error message to the user if you aren't logged in 
	 * 						or if someone else tries to log in.
	 * @param user - This is the current user/owner of the mailbox
	 * @return - The proper error message depending on logInCheck's value
	 */
	public static void printError(String user)
	{
		if(user.length() > 0)
		{
			System.out.println("Someone is logged in.\nPlease log out.");
		}//End of if
		else
		{
			System.out.println("Please log in before you can write a message, check your inbox, or outbox.");
		}//End of else
		
	}//End of printErrors
	
	/**
	 * Method userLogIn - this method logs in a user.
	 * @param console - Scanner object to read in input
	 * @param user - This is the current user/owner of the mailbox
	 * Returns the user variable with a name in it. 
	 */
	public static String userLogIn(Scanner console, String user)
	{
		if(user.length() == 0)
		{
			System.out.println("Please enter your name.");
			user = console.next();
			return user;
		}//End of if
		else
		{
			printError(user);
			return "";
		}//End of else
		
	}//End of userLogIn
	
	/**
	 * Method userLogOut - logs out the user if someone is logged in.
	 * @param user - This is the current user/owner of the mailbox
	 * Returns an empty user name as well as returns the logInCheck to false to reset the check for everything.
	 */
	public static String userLogOut(String user)
	{
		if(user.length() > 0)
		{
			System.out.println("You have successfully logged out.");
			return "";
		}//End of if
		else
		{
			printError(user);
			return "";
		}//End of else
		
	}//End of userLogOut
	
	/**
	 * Method display - displays the appropriate inbox or outbox for the user depending on
	 * @param type - type of Mailbox to display
	 * @param mailSystem - our Mail System that holds all the users and messages
	 * @param user - this is the name of the user/owner of the mailbox we are in currently 
	 * Returns all messages in the specific mailbox chosen or if it can't determine Mailbox
	 */
	public static void display(char type, MailSystem mailSystem, String user)
	{
			if(user.length() > 0)
			{
				if(type == 'I')
				{
					mailSystem.printMessages(user,"inbox");
					System.out.println();
				}//End of nested if
				else if(type == 'S')
				{
					mailSystem.printMessages(user, "outbox");
				}//End of nested else if
				else
				{
					System.out.println("Can't determine Mailbox");
				}//End of nested else
			}//End of if
			else
			{
				printError(user);
			}//End of else
			
	}//End of display
	
	/**
	 * Method writeMessage - Allows user to write a message to someone else and delivers it
	 * @param user - this is the name of the user/owner of the mailbox we are in currently 
	 * @param console - Scanner object to read in input
	 * @param mailSystem - This is the host of our mailsystem for the program
	 * Delivers the message and doesn't return anything other than "Message Delivered."
	 */
	public static void writeMessage(String user, Scanner console, MailSystem mailSystem)
	{
		Message m;
		String message = "test";
		if(user.length() > 0)
		{	
			System.out.println("Please enter the name of the person you'd like to send the message to: ");
			m = new Message(user, console.next());
			console.nextLine();
			System.out.println("Enter several lines of text terminated with an empty line.");
			message = console.nextLine();
			while(message.length() > 0)
			{
				m.append(message);				
				message = console.nextLine();
				
			}//End of while loop
			
			mailSystem.deliver(m);
			System.out.println("Message Delivered.");
		}//End of if
		else
		{
			printError(user);
		}//End of else
		
	}//End of write message
}//End of Prog5
