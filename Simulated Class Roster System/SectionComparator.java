/**
 * Program 6 SectionComparator
 * CSCI 150 Professor Collins
 * @author - Jack Finamore
 * Last Revised April 5th, 2017
 * 
 * This class compares two different course objects(specifically their sections) and sorts them according to their values.
 * It only does this if the two Course objects have the same name.
 */

import java.util.Comparator;

public class SectionComparator implements Comparator<Course>
{
	/**
	 * Method compare - compares two Course objects
	 * @param a - Course object
	 * @param b - Course object
	 * @return The appropriate number for the sorter to know how to rearrange the Course objects by section
	 */
	public int compare(Course a, Course b)
	{
		if(a != null && b!= null && a.getID().compareTo(b.getID()) == 0)
		{
			if(a.getSection() > b.getSection()) return 1;//End of if
			if(a.getSection() < b.getSection()) return -1;//End of if
			return 0;
		}//End of if
		return 0;
	}//End of compare method

}//End of SectionComparator class
