/**
 * Prog2 CashRegister Class
 * CSCI 150 Professor Collins
 * @author Jack Finamore
 * Last Revised Feb. 4th, 2017
 * 
 *  A simulated cash register that tracks the daily total and
 *  the total amount due.
 */

import java.util.ArrayList;

public class CashRegister
{
   private ArrayList<Double> price;//This array list will hold all the values of price
   private double dailyTotal;//This will hold the daily total of all cash registers
  
   /**
      Constructs a cash register with cleared item count and total.
      
   */
   public CashRegister()
   {
	   price= new ArrayList<Double>();
   }

   /**
      Adds an item to this cash register.
      @param price the price of this item
     
   */
   public void addItem(double price)
   {
      this.price.add(price);
      
   }

   /**
      Gets the price of all items in the current sale.
      @return the total amount
   */
   public double getTotal()
   {
	  double totalPrice = 0;
	  for(int i = 0; i < price.size();i++ )
	  {
		  totalPrice += price.get(i);
	  }
      return totalPrice;
   }
   
   /**
      Gets the number of items in the current sale.
      @return the item count
   */
   
   public int getCount()
   {
      return price.size(); 
   }
    
   /**
      Clears the item count and the total.
   */
   
   public void clear()
   {
	  for(int i = 0; i < price.size(); i++)
	  {
		  dailyTotal += price.get(i);
		  
	  }//End of for loop
      price.clear(); 
   }
   
   /**
    * Display method that prints out to the console the price of every item in the array
    */
   public void display()
   {
	
	   for(int i = 0; i < price.size(); i++)
	   {
		   System.out.printf("%10.2f\n", price.get(i));
	   }//End of for loop
	  
   }
   
   /**
    * This method returns the variable daily total
    */
   public double getDailyTotal()
   {
	   return dailyTotal;
   }
}//End of CashRegister class

