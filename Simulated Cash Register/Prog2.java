/**
 * Prog2 Prog2 Main Class
 * CSCI 150 Professor Collins
 * @author Jack Finamore
 * Last Revised Feb. 4th, 2017
 * 
 *  A class that implements and uses the Prog2 Cash Register Class
 */
import java.util.Scanner;

public class Prog2 {

	public static void main(String[] args) 
	{
		// Initialize all variables 
		Scanner console = new Scanner(System.in);
		CashRegister register1 = new CashRegister();
		String menuChoice; //User's input for what they would like to do
		Double priceOfItem; //User's input for price of item.
		
		System.out.println("Welcome to the Cash Register Program.");
		System.out.println("Please enter an N to start with a new customer. ");
		System.out.println("Please enter A to add an item.");
		System.out.println("Please enter D to display current total and number of items.");
		System.out.println("Please enter E to exit.");
		do
		{
			System.out.println("Please enter your choice: ");
			menuChoice = console.next();
			
			if(menuChoice.equals("N") || menuChoice.equals("n"))
			{
				System.out.println("You started a new customer.");
				register1.clear();
			}
			
			if(menuChoice.equals("A") || menuChoice.equals("a"))
			{
				System.out.print("Please enter the price of the item: ");
				priceOfItem= console.nextDouble();
				
				register1.addItem(priceOfItem);
			}
			
			if(menuChoice.equals("D") || menuChoice.equals("d"))
			{
				register1.display();
				System.out.println("----------");
				System.out.printf("%10.2f%5s", register1.getTotal(), " Total\n");
				System.out.printf("%19s%2d\n", "Number items: ", register1.getCount());
			}
			
			if(menuChoice.equals("E") || menuChoice.equals("e"))
			{
				register1.clear();
				System.out.printf("%10s%5.2f\n", "The daily total is: ", register1.getDailyTotal());
				System.out.println("Thank you for using this program!");
				
			}

		}while(!menuChoice.equals("E"));
		console.close();
	}//End of main method

}//End of Prog2 class
