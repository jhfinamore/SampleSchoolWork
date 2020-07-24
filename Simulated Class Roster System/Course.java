/**
 * Program 6 Course class
 * CSCI 150 Professor Collins
 * @author - Jack Finamore
 * Last Revised April 5th, 2017
 * 
 * This class models a Course object, the user will be able to update grades, display students, and enroll students
 */

import java.util.ArrayList;
import java.util.Scanner;

public class Course 
{
	public String courseID;//This variable will hold the course Name and Number
	public int sectionNo;//This variable will hold the section number of the class
	public int studentsEnrolled;//This variable will hold the number of students enrolled
	public ArrayList<Student> studentsInClass;//This variable holds an arraylist of student objects
	/**
	 * Method Course - constructor for our Course objects
	 * @param courseID
	 * @param sectionNo
	 */
	public Course(String courseID, int sectionNo)
	{
		this.courseID = courseID;
		this.sectionNo = sectionNo;
		this.studentsEnrolled = 0;
		studentsInClass = new ArrayList<Student>();
	}//End of Course method
	
	/**
	 * Method getID - returns courseID to the student to the user
	 * @return courseID - variable that holds the course name and number
	 */
	public String getID()
	{
		return courseID;
	}//End of getID method
	
	/**
	 * Method getSection - returns sectionNo to the student to the user
	 * @return sectionNo - the section number for this specific course
	 */
	public int getSection()
	{
		return sectionNo;
	}//End of getSection method
	
	/**
	 * Method getEnrollNumber - returns the number of students enrolled to the user
	 * @return studentsEnrolled - the number of students currently in the class
	 */
	public int getEnrollNumber()
	{
		return studentsEnrolled;
	}//end of getEnrollNumber method
	
	/**
	 * Method enrollStudents - enrolls students in the class by adding them to the ArrayList
	 * @param fname - First name of student
	 * @param lname - Last name of student
	 */
	public void enrollStudents(String fname, String lname)
	{
		studentsInClass.add(new Student(fname, lname));
		studentsEnrolled++;
		
	}//End of enrollStudents method
	
	/**
	 * Method displayStudents - displays the students name and grade in the class
	 */
	public void displayStudents()
	{
		Student stu;//Student object
		if(studentsInClass.size() > 0)
		{
			for(int j = 0; j < studentsInClass.size(); j++)
			{
				stu = studentsInClass.get(j);
				System.out.println(stu.getFirstName() + " " + stu.getLastName() + " Grade: " + stu.getLetterGrade());
			}//End of for loop
		}//End of if
		else
		{
			System.out.println("There isn't any students in that class section.");
		}//End of else
	}//End of method displayStudents
		
	/**
	 * Method gradeUpgrade - updates the grades of all the students in the Course one by one
	 */
	public void gradeUpgrade()
	{
		Scanner console = new Scanner(System.in);//Scanner object that brings in input from the console
		Student stu;//Student object
		String grade;//Grade of the student
		if(studentsInClass.size() > 0)
		{
			for(int j = 0; j < studentsInClass.size(); j++)
			{
				stu = studentsInClass.get(j);
				System.out.print("Students name: ");
				System.out.println(stu.getFirstName() + " " + stu.getLastName());
				System.out.println("Enter the students grade");
				grade = console.next();
				stu.updateGrade(grade);
			}//End of for loop
		}//End of if statement
		else
		{
			System.out.println("There isn't any students in that class section.");
		}//End of else statement
	}//End of gradeUpgrade method
	

}//End of Course class
