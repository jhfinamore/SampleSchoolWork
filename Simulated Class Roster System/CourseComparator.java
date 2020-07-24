/**
 * Program 6 CourseComparator
 * CSCI 150 Professor Collins
 * @author - Jack Finamore
 * Last Revised April 5th, 2017
 * 
 * This class compares two different course objects and sorts them according to their values
 */


import java.util.Comparator;

public class CourseComparator implements Comparator<Course>
{
	/**
	 * Method compare - compares two Course objects
	 * @param a - Course object
	 * @param b - Course object
	 * @return The appropriate number for the sorter to know how to rearrange the Course objects 
	 */
	public int compare(Course a, Course b)
	{
		if(a != null && b!= null)
		{
			if(a.getID().compareTo(b.getID()) > 0){return 1;}//End of if
			if(a.getID().compareTo(b.getID()) < 0){return -1;}//End of if
			return 0;
		}//End of if
		return 0;
	}//End of compare method
	
}//End of CourseComparator class
