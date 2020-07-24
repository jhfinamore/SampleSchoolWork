/**
 * Program 6 Student class
 * CSCI 150 Professor Collins
 * @author - Jack Finamore
 * Last Revised April 5th, 2017
 * 
 * This class models a Student. It holds their name and grade. Users are able to update grades and get the grades.
 */

public class Student 
{
	public String firstName;//This variable holds the students first name
	public String lastName;//This variable holds the students last name
	public String letterGrade;//This variable holds the students grade
	
	/**
	 * Method Student - constructs our student object
	 * @param first - first name of student
	 * @param last - last name of student
	 */
	public Student(String first, String last)
	{
		firstName = first;
		lastName = last;
		letterGrade = "";
	}//End of Student constructor method
	
	/**
	 * Method getFirstName - returns the students first name to the user
	 * @return firstName - student objects first name
	 */
	public String getFirstName()
	{
		return firstName;
	}//End of getFirstName method
	
	/**
	 * Method getLastName - returns the students last name to the user
	 * @return lastName - student objects last name
	 */
	public String getLastName()
	{
		return lastName;
	}//End of students getLastName method
	
	/**
	 * Method getLetterGrade - returns the students grade to the user
	 * @return "N/a" if the grade isn't set or the letter grade that is set
	 */
	public String getLetterGrade()
	{
		if(letterGrade.equals(""))
		{
			return "N/a";
		}//End of if
		return letterGrade;
	}//End of method getLetterGrade

	/**
	 * Method updateGrade - updates the students grade 
	 * @param grade - grade that the student object will now hold
	 */
	public void updateGrade(String grade)
	{
		letterGrade = grade;
	}//End of updateGrade method

}//End of Student class
