/**
 * CSCI 150 Professor Collins
 * Program 3 Customer class
 * @author Jack Finamore
 * Last Revised 2/18/17
 * 
 * This class stores and keeps the records of customers and their totals for different services and calculates the total.
 */

public class Customer 
{
	private String customerName;
	private double treeRemovalTotal;// the customers total tree removal cost
	private double treeTrimmingTotal;// the customers total tree trimming cost
	private double stumpGrindingTotal;// the customers total stump grinding cost
	
	/**
	 * This class stores all the data in the customer object
	 * @param name Name of the customer
	 * @param treeRemovalCost the customers total tree removal cost
	 * @param treeTrimmingCost the customers total tree trimming cost
	 * @param stumpGrindingCost the customers total stump grinding cost
	 */
	public Customer(String name, double treeRemovalCost, double treeTrimmingCost, double stumpGrindingCost)
	{
		customerName = name;
		treeRemovalTotal = treeRemovalCost;
		treeTrimmingTotal = treeTrimmingCost;
		stumpGrindingTotal = stumpGrindingCost;

	}
	
	/**
	 * This method returns the customers name to the user
	 * @return customerName the name of the customer
	 */
	public String getCustomerName()
	{
		return customerName;
	}
	
	/**
	 * This method returns the tree removal total to the user
	 * @return treeRemovalTotal the total cost of removal for the object
	 */
	public double getRemovalTotal()
	{
		return treeRemovalTotal;
	}
	
	/**
	 * This method returns the tree trimming total to the user
	 * @return treeTrimmingTotal the total cost of trimming for the object
	 */
	public double getTrimmingTotal()
	{
		return treeTrimmingTotal;
	}
	
	/**
	 * This method returns the stump grinding total to the user
	 * @return stumpGrindingTotal the total cost of grinding for the object
	 */
	public double getStumpGrindingTotal()
	{
		return stumpGrindingTotal;
	}
	
	/**
	 * This method returns the total of all the different charges to the user. 
	 * @return the calculation for the total by adding all the seperate costs together
	 */
	public double totalCost()
	{
		return treeRemovalTotal + treeTrimmingTotal + stumpGrindingTotal;
		
	}
	
}
