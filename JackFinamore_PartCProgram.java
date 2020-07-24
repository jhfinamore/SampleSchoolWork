/* Jack Finamore
 * Assignment Part C Program
 * Dec. 6 2016
 * 
 * PseudoCode:
 * Class JackFinamore_PartCProgram
 * Initialize all global variables
 *  -------------------------------
 * Main Method
 * Initialize variables
 * Repeat the following while not done
 * 		Prompt the user for menu option
 * 		If input is 1
 * 			Call method wage_Getter
 * 		Otherwise if input is 2
 * 			Call method tip_Calculator
 * 		Otherwise if input is 3
 * 			Call method wage_Reporter
 * 		Otherwise if input is 4
 * 			Call method dining_Total	
 * 		Otherwise if input is 5
 * 			Call method checker
 * 		Otherwise
 * 			Display message saying wrong input
 * --------------------------------------------------------
 * Method wage_Getter
 * Returns wageHolder file
 * 		*****
 * Initialize all local variables
 * Prompt user for user's first name
 * Prompt user for user's last name
 * Prompt user for salary
 * Repeat while greater than 40
 * 		Prompt user for number of hours worked
 * 		If hours is 40
 * 			Prompt for any overtime hours
 * Display the users name
 * Store the users name
 * If overtime hours is greater than 0
 * 		Calculate regular pay by calling method calc_wages 
 * 		Calculate overtime pay by calling method calc_wages
 * 		Display the regular pay and number of hours worked and overtime hours and overtime pay
 * 		Store the regular pay and number of hours worked and overtime hours and overtime pay
 * Otherwise
 * 		Calculate pay by calling method of calc_wages
 * 		Display number of hours work and the pay
 * 		Store number of hours work and the pay
 * --------------------------------------------------------	
 * Method calc_Wages
 * Parameter: Salary = how much they make
 * Parameter: hours = how much they work
 * Parameter: overTimeHours = any hours over 40 they worked
 * Returns pay
 * 			*****
 * Initialize all local variables
 * If(overTimeHours equals 0)
 * 		Calculate pay by hours times salary
 * Otherwise
 * 		Calculate pay by overtime hours times times salary times OVERTIME_PAY
 * -------------------------------------------------------
 *  Method tipCalculator
 * 		 ***
 *  Initializes all local variables
 *  Prompt user for check amount
 *  Prompt user for satisfaction level
 * 	If satisfationLevel equals 1
 * 			Calculate tip by satisfactionLevel1 time checkAmount
 * 			Calculate totalCheck by tip plus checkAmount
 * 			Store tip 
 *			Store dinner total
 * 			Display the persons satisfactionLevel and what it means
 * 			Display the tip 
 * 			Display the checkAmount
 * Otherwise if satisfationLevel equals 2
 * 			Calculate tip by satisfactionLevel2 times checkAmount
 * 			Calculate totalCheck by tip plus checkAmount
 *			Store tip 
 *			Store dinner total
 * 			Display the persons satisfactionLevel and what it means
 * 			Display the tip 
 * 			Display the checkAmount	
 * Otherwise satisfationLevel equals 3
 * 			Calculate tip by satisfactionLevel3 times checkAmount
 * 			Calculate totalCheck by tip plus checkAmount
 *			Store tip 
 *			Store dinner total
 * 			Display the persons satisfactionLevel and what it means
 * 			Display the tip 
 * 			Display the checkAmount
 * ----------------------------------------------------------------
 * Method wageReporter
 * 		****
 * Initialize all local variables
 * Repeat the following until done
 * 		Read the file 
 * 		Display the file to the user
 * --------------------------------------------------------------
 * Method dining_total 
 * 		****
 * Initialize all local variables
 * Repeat the following while not done
 * 		Calculate total tips by value stored in tips
 * 		Calculate total dinners by values stored in dinners
 * Display the two totals
 * --------------------------------------------------------------
 * Method checker
 * Parameters input - Scanner
 * 	***** 
 * Prompt user if they want to exit
 * If they do
 * 		Display a thank you for using the program
 * 		End of Program
 * Otherwise	
 * 		Go back to menu
 */
import java.util.*;
import java.io.*;

public class JackFinamore_PartCProgram 
{
	//Initialize all global variables
	public static int currentSize = 0;
	public static int count = 0;
	public static int menu;
	public static double[] tips = new double[100];
	public static double[] dinners = new double[100];
	public static File wageHolder = new File("wages.txt");
	public static Scanner input = new Scanner(System.in);
	public static Scanner wageInput = input;
	public static PrintWriter wagesOutput;
	public static Scanner fileImporter;
	public static Scanner tipInput;
	
	public static void main(String[] args) throws IOException 
	{
		//Initialize all variables
		fileImporter = new Scanner(wageHolder);
		boolean end = true;
		//Menu
		do
		{
		System.out.println("Welcome to the Wage Calculator/Tip Calculator Program.");
		System.out.println("Please enter whether you want to use the Wage Calculator as 1 or Tip Calculator as 2.");
		System.out.println("Please enter 3 for Reporting the wages and 4 for the Dining Total.");
		System.out.print("Otherwise please enter exit as 5.");
		menu = input.nextInt();
			{
				switch (menu)
					{
					case 1: //wage calculator
						wage_Getter();
						break;
			
					case 2: //tip calculator
						tip_calculator();
						break;
			
					case 3://wage reporter
						wage_Reporter();
						break;
			
					case 4://dining total
						dining_Total();
						break;	
			
					case 5: //menu exit
						end = checker();
						break;
			
				default:
					System.out.println("Invalid Input. Please enter 1, 2, 3, 4, or 5.");
				}		
			}// end of switch	
		}while(end == true);
		
	}//end of main
/**
 * Method wageGetter calculates and exports pay 
 * @return wageHolder - file holding names and pay
 * @throws IOException 
 */
	public static File wage_Getter() throws IOException
	{
		//initialize all variables
		wagesOutput = new PrintWriter(new FileWriter(wageHolder, true));
		double overtimeHours = 0, hours;
		double overTimePay, regularPay, totalPay;
		double salary;
		double temp;
		String firstName, lastName;

		//User prompts
		System.out.print("Please enter your employee's first name: ");
		firstName = wageInput.next();
		System.out.print("Please enter your employee's last name: ");
		lastName = wageInput.next();
		System.out.print("Please enter your salary: ");
		salary = wageInput.nextDouble();
		do
			{
			System.out.print("Please enter your hours worked (Max 40): ");
			hours = wageInput.nextDouble();
				if (hours == 40)
				{
					System.out.print("If you worked any overtime hours, please enter them now, otherwise enter 0): ");
					overtimeHours = wageInput.nextDouble();
				}
			}while(hours > 40);
		
		System.out.print("Your employee " + firstName + " " + lastName);
		wagesOutput.print("Your employee " + firstName + " " + lastName);
		if(overtimeHours > 0)
		{
			overTimePay =  calc_Wages(salary,hours,overtimeHours);
			temp = overtimeHours;
			overtimeHours = 0;
			regularPay = calc_Wages(salary, hours, overtimeHours);
			overtimeHours = temp;
			totalPay = overTimePay + regularPay;
			System.out.print(" worked " + hours + " hours and their");
			System.out.printf("%8s%5.2f", " pay is $", regularPay);
			System.out.print(" and they worked for " + overtimeHours + " overtime hours. Their overtime pay is $");
			System.out.printf("%.2f", overTimePay);
			System.out.printf("%14s%5.2f", ", total pay is $", totalPay);
			wagesOutput.print(" worked " + hours + " hours and their");
			wagesOutput.printf("%8s%5.2f", " pay is $", regularPay);
			wagesOutput.print(" and they worked for " + overtimeHours + " overtime hours. Their overtime pay is $");
			wagesOutput.printf("%.2f", overTimePay);
			wagesOutput.printf("%14s%5.2f", ", total pay is $", totalPay);
		}
		else
		{
			regularPay = calc_Wages(salary,hours,overtimeHours);
			System.out.print(" worked " + hours + " hours and their pay is: ");
			System.out.printf("%.2f", regularPay);		
			wagesOutput.print(" worked " + hours + " hours and their pay is: ");
			wagesOutput.printf("%.2f", regularPay);
		}//End of if statement	
		System.out.println();
		wagesOutput.println();
		wagesOutput.close();
		return wageHolder;
		
	}//end of method wage_Getter
	/**
	 * Method calc_wages calculates pay and overtime pay
	 * @param salary
	 * @param hoursWorked
	 * @param overtimeHours
	 * @return pay
	 */
	public static double calc_Wages(double salary, double hoursWorked, double overtimeHours)
	{
		//initialize all variables
		double pay;
		final double OVERTIME_PAY = 1.50;
		if(overtimeHours == 0)
		{
			pay = salary * hoursWorked;
			return pay;
		}
		else
		{
			pay =((overtimeHours) * (salary * OVERTIME_PAY));
			return pay;
		}//end of extended if
			
	}//end of method calc_wages
	/**
	 * method tip_calculator Calculates the tip of an order
	 */
	public static void tip_calculator()
	{
		//initialize all variables
		double tip, checkTotal;
		double checkAmount = 0;
		int satisfactionLevel = 0;
		final double SATISFACTION1 = .2;
		final double SATISFACTION2 = .15;
		final double SATISFACTION3 = .1;
		tipInput = new Scanner(System.in);
		
		System.out.print("Please enter your check amount: ");
		checkAmount = tipInput.nextDouble();
		System.out.println("Please enter your check Balance as 1 for totally satisfied, 2 for satisfied, and 3 for dissatisfied.");
		satisfactionLevel = tipInput.nextInt();			
		if(satisfactionLevel == 1)
		{			
			tip = checkAmount * SATISFACTION1;
			checkTotal = checkAmount + tip;
			tips[currentSize] = tip;
			dinners[currentSize] = checkTotal;
			System.out.print("You were totally satisfied with your meal. Your tip is ");
			System.out.printf("%.2f%1s", tip, ".\n");
			System.out.print("Your check total is ");
			System.out.printf("%.2f%1s", checkTotal, ".\n");
			System.out.println("Thank you for using this program!");

		}
		else if(satisfactionLevel == 2)
		{
			tip = checkAmount * SATISFACTION2;
			checkTotal = checkAmount + tip;
			tips[currentSize] = tip;
			dinners[currentSize] = checkTotal;
			System.out.print("You were satisfied with your meal. Your tip is ");
			System.out.printf("%.2f%1s", tip, ".\n");
			System.out.print("Your check total is ");
			System.out.printf("%.2f%1s", checkTotal, ".\n");
			System.out.println("Thank you for using this program!");
		}
		else
		{
			tip = checkAmount * SATISFACTION3;
			checkTotal = checkAmount + tip;
			tips[currentSize] = tip;
			dinners[currentSize] = checkTotal;
			System.out.print("You were disatisfied with your meal. Your tip is ");
			System.out.printf("%.2f%1s", tip, ".\n");
			System.out.print("Your check total is ");
			System.out.printf("%.2f%1s", checkTotal, ".\n");
			System.out.println("Thank you for using this program!");
		}//end of extended if
		currentSize++;

	}//end of method tip_calculator 
	/**
	 * Method wageReporter Prints everything in the file
	 */
	public static void wage_Reporter() throws FileNotFoundException
	{
		fileImporter = new Scanner(wageHolder);
		String line;
		while(fileImporter.hasNextLine())
		{

			line = fileImporter.nextLine();
			System.out.println(line);
		}//end of while
	}//end of wage_Reporter
	/**
	 * Method dining_Total calculates the total of tips and dinners
	 */
	public static void dining_Total()
	{
		double tipsTotal = 0, diningTotal = 0;
		for(int i = 0; i <= currentSize; i++)
		{
			tipsTotal += tips[i];
			diningTotal += dinners[i];
		}//end of for loop
		System.out.println("You served " + currentSize +" meals today.");
		System.out.print("The total tips for the night are $");
		System.out.printf("%.2f", tipsTotal);
		System.out.println();
		System.out.print("You total meals paid are $");
		System.out.printf("%.2f", diningTotal);
		System.out.println();
	}//end of dining_Total
	
	/**
	 * Method checker - makes sure the user wants to end
	 * @return true or false based on users input
	 */
	public static boolean checker()
	{
		String check;
		System.out.print("Are you sure you are ready to end? Enter 'YES' if you are, Otherwise enter '1': ");
		check = input.next();
		check.toUpperCase();
		if(check.equals("YES"))
		{
			System.out.print("Thank you for using this program. I hope you enjoyed it.");
			wagesOutput.close();
			input.close();
			tipInput.close();
			fileImporter.close();
			return false;
		}//end of if
		return true;
	}//end of method checker

}//end of class JackFinamore_PartCProgram	