/**
 * Program 6 Main class Prog6
 * CSCI 150 Professor Collins
 * @author - Jack Finamore
 * Last Revised April 5th, 2017
 * 
 * This class implements and uses the Course and Student objects and is a menu driven program using those classes.
 */

import java.util.Scanner;
import java.util.Arrays;
import java.io.*;

public class Prog6
{
	public static void main(String[] args) throws FileNotFoundException
	{
		Scanner console = new Scanner(System.in);//Scanner for console
		File courseFile = new File("prog6.txt");//This file holds the course list 
		Scanner inputScanner = new Scanner(courseFile);
		Course[] courses = new Course[100];//This variable will hold all the courses in the file.
		int placeInArray = 0;//This value will hold how big the array is
		String courseID;//Will hold the combo of courseName and courseNo.
		String courseName;//Will hold the course Name for initialization
		String courseNo;//Will hold the course number for initialization
		int sectionNo;//Will hold the section number for initialization
		int menuChoice;//Holds the users choice for the menu
		boolean menuSentinel = true;//This variable will break the loop when it is false
		
		while(inputScanner.hasNextLine())
		{
			if(inputScanner.hasNextLine())
			{
				courseName = inputScanner.next();
				//System.out.println(courseName + " 1");
				courseNo = inputScanner.next();
				//System.out.println(courseNo + " 2");
				sectionNo = inputScanner.nextInt();
				//System.out.println(sectionNo + " 3");
				courseID = courseName + " " + courseNo;
				courses[placeInArray] = new Course(courseID, sectionNo);
				placeInArray++;
			}//End of if
			
		}//End of while 
		
		while(menuSentinel)
		{
			System.out.println("1)List all courses 2)Enroll students 3)Sort courses 4)Enter grades 5)Display a single class roll 6)Quit");
			menuChoice = console.nextInt();
			switch(menuChoice)
			{
				case 1:
					System.out.println("Case 1");
					System.out.println("Course Name, Section No., Students Enrolled");
					for(int i = 0; i < placeInArray; i++)
					{
							System.out.println(courses[i].getID() + " " + courses[i].getSection() + " " + courses[i].getEnrollNumber());
					}//End of for loop
					break;//End of case 1
				case 2:
					System.out.println("Case 2");
					enrollStudent(console, courses);
					break;//End of case 2
				case 3:
					System.out.println("Case 3");
					Arrays.sort(courses, new CourseComparator());
					Arrays.sort(courses, new SectionComparator());
					break;//End of case 3
				case 4: 
					System.out.println("Case 4");
					enterGrades(courses, console);
					break;//End of case 4
				case 5:
					System.out.println("Case 5");
					rollDisplay(courses, console);
					break;//End of case 5
				case 6:
					System.out.println("Thank you for using this program.");
					menuSentinel = false;
					inputScanner.close();
					console.close();
					break;//End of case 6
				default:
					System.out.println("Please enter one of the 6 choices.");
					break;//End of default
					
			}//End of switch
		}//End of while loop
	}//End of main
	
	/**
	 * Method enrollStudents - prompts user for students name and class information and enrolls them.
	 * @param console - Scanner object for the console to input the values
	 * @param c - An array of Course objects that will store the students inside of them. 
	 */
	public static void enrollStudent(Scanner console,Course[] c)
	{
		String fname;//Holds the students first name
		String lname;//Holds the students last name
		String classID;//Holds the classID
		int section;//Holds the section number
		int place;//Holds the place of the course in the Array c
		
		do
		{
			System.out.print("Please enter the student's first name(Enter 1 if done): ");
			fname = console.next();
			if(!fname.equals("1"))
			{
				System.out.print("Please enter the student's last name: ");
				lname = console.next();
				System.out.println("Please enter the class name: ");
				classID = console.next();
				System.out.println("Please enter course number: ");
				classID  = classID + " " + console.next();
				System.out.println("Please enter the section number: ");
				section = console.nextInt();
				place = classGetter(c, classID, section);
				if(place >= 0)
				{
					c[place].enrollStudents(fname, lname);
				}//End of if
				else
				{
					System.out.println("That class doesn't exist.");
				}//End of else
			}
		}while(!fname.equals("1"));
		
	}//End of enrollStudents method
	
	/**
	 * Method classGetter - this method returns the spot in the array of the specific class section. 
	 * @param courses - the array of Course objects to search through
	 * @param classID - the class name and number
	 * @param sectionNo - the classes section number
	 * @return i - the place in the array of that specific class otherwise returns -1
	 */
	public static int classGetter(Course[] courses, String classID, int sectionNo)
	{
		String courseID;//Holds the courseID
		int section;//Holds the section number
		
		for(int i = 0; i < courses.length; i++)
		{
			if(courses[i] != null)
			{
				courseID = courses[i].getID();
				section = courses[i].getSection();
				if(classID.equals(courseID) && sectionNo == section)
				{
					return i;
				}//End of nested if
			}//End of if
		}//End of for loop
		return -1;
	}//End of method classGetter
	
	/**
	 * Method rollDisplay - Prompts for a class and a section and displays all the students in the class
	 * @param courses - An array of Course objects and will display the students in the specific Course
	 * @param console - Scanner object to read input from the console
	 */
	public static void rollDisplay(Course[] courses, Scanner console)
	{
		String courseID;//Holds the complete courseID
		String className;//Holds the course name
		String classNo;//Holds the course number
		int sectionNo;//Holds the section number
		int place;//Holds the place of the course in Array courses
		
		System.out.println("Please enter the class name.");
		className = console.next();
		System.out.println("Please enter the class No.");
		classNo = console.next();
		System.out.println("Please enter the section No.");
		sectionNo = console.nextInt();
		courseID = className + " " + classNo;
		place = classGetter(courses, courseID, sectionNo);
		if(place >= 0)
		{
			courses[place].displayStudents();
		}//End of if
		else
		{
			System.out.println("That class doesn't exist sorry.");
		}//End of else
		
	}//End of method rollDisplay
	
	/**
	 * Method enterGrades - This class prompts user for a section and then will go through the Student objects in the class and update grades
	 * @param c - An array of Course objects that hold our classes
	 * @param console - Scanner object to read input from the console. 
	 */
	public static void enterGrades(Course[] c, Scanner console)
	{
		String courseID;//Holds the class ID
		String className;//Holds the class name
		String classNo;//Holds the class number
		int sectionNo;//Holds the section number
		int place;//Holds the place of the course in Array c
		System.out.println("Please enter the class name.");
		className = console.next();
		System.out.println("Please enter the class No.");
		classNo = console.next();
		System.out.println("Please enter the section No.");
		sectionNo = console.nextInt();
		courseID = className + " " + classNo;
		place = classGetter(c, courseID, sectionNo);
		if(place >= 0)
		{
			c[place].gradeUpgrade();
		}//End of if
		else
		{
			System.out.println("That class doesn't exist sorry.");
		}//End of else
	}//End of enterGrades method
	
}//End of Prog6 class
