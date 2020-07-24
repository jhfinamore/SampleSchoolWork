/**
 * CSCI 150 Professor Collins
 * Program 3 Main Class
 * @author Jack Finamore
 * Last Revised 2/18/17
 * 
 * This class implements the Customer class and access a file with multiple customers stored within it.
 */
import java.util.Scanner;
import java.util.ArrayList;
import java.io.*;

public class Prog3 {

	public static void main(String[] args)  throws FileNotFoundException
	{
		// Initialize all variables
		Scanner in = new Scanner(new File("prog3in.txt"));
		ArrayList<Customer> treeCustomers = new ArrayList<Customer>();
		final double TREE_REMOVAL_COST = 150;
		final double TREE_TRIMMING_COST = 50;
		final double STUMP_GRINDING_COST = 30;
		final int STUMP_SIZE_EXTRA = 12;
		final double STUMP_ADDITIONAL_COST = 2.00;
		double stumpGrindingTotal;
		double treeTrimmingTotal = 0;
		double treeRemovalTotal = 0;
		String customerName = "";
		int treeRemoval;
		double diameter = 0;
		double hours;
		
		while(in.hasNext())
		{
			customerName = in.nextLine();
			treeRemoval = in.nextInt();
			hours = in.nextDouble();
			stumpGrindingTotal = 0;
			diameter = in.nextInt();
			while(diameter > -1)
			{
				
				if(diameter > STUMP_SIZE_EXTRA)
				{
					stumpGrindingTotal += STUMP_GRINDING_COST + ((diameter - STUMP_SIZE_EXTRA) * STUMP_ADDITIONAL_COST);
				}
				else
				{
					stumpGrindingTotal += STUMP_GRINDING_COST;
				}
				diameter = in.nextInt();
			}
			treeRemovalTotal = TREE_REMOVAL_COST * treeRemoval;
			treeTrimmingTotal = TREE_TRIMMING_COST * hours;
			treeCustomers.add(new Customer(customerName, treeRemovalTotal, treeTrimmingTotal, stumpGrindingTotal));
			in.nextLine();
		}
		
		for(int p = 0; p < treeCustomers.size(); p++)
		{
			System.out.printf("%-20s%16s","Customer: ", treeCustomers.get(p).getCustomerName() + "\n");
			System.out.printf("%-20s%7s%8.2f", "Tree Removal: ","$", treeCustomers.get(p).getRemovalTotal());
			System.out.println();
			System.out.printf("%-20s%7s%8.2f","Tree Trimming: ","$", treeCustomers.get(p).getTrimmingTotal());
			System.out.println();
			System.out.printf("%-20s%7s%8.2f","Stump Grinding: ","$", treeCustomers.get(p).getStumpGrindingTotal());
			System.out.println();
			System.out.printf("%-20s%7s%8.2f", "Customer Total: ", "$" , treeCustomers.get(p).totalCost());//Forget this line
			System.out.println();
			System.out.println();
		}
		
		in.close();
	}//End of Main

}//End of Prog3
