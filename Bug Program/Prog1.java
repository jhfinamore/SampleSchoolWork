/**
 * Program 1 Prog1 
 * CSCI 150 Professor Collins
 * @author Jack Finamore
 * Last Revised 1/26/17
 * 
 * This class implements the Bug class through a user menu
 */
import java.util.Scanner;

public class Prog1 {

	public static void main(String[] args) {
		// Initialize all variables
		Bug menuBug1 = new Bug(10);//Initializes a Bug object with a starting position of 10
		String menuInput;//Input variable for user to choose what they would like to do
		Boolean check = true;//Variable to end loop
		Scanner console = new Scanner(System.in);//Scanner object for the console
		
		System.out.println("Welcome to the Bug Program! Your bug is starting at 10.");
		do
		{
			System.out.println("Please enter m if you wish to move, t if you wish to turn,\ng if you wish to get position, and q if you wish to quit. Thank you!");
			menuInput = console.next();
			switch(menuInput)
			{
				case "m": 
						System.out.println("You moved!");
						menuBug1.move();
						break;
				case "t":
						System.out.println("You turned!");
						menuBug1.turn();
						break;
				case "g":
						System.out.println("Your position is: " + menuBug1.getPosition());
						break;
				case "q": 
						System.out.print("Thank you for using the program. Goodbye!");
						console.close();
						check = false;
						break;
				default:
						System.out.println("Incorrect choice! Please enter m, t, g, or q.");
						break;
			}//End of switch
		}while(check);//End of do while
		
	}//End of Main

}//End of class Prog1
