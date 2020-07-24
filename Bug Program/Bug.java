/**
 * Program 1
 * Prog1 Bug class
 *  CSCI 150 Professor Collins
 * @author Jack Finamore
 * Last Revised 1/26/17
 *
 * This program mimics the movement of a Bug and has the classes that give it those actions
 */
public class Bug 
{
	private int position;//Variable that holds the position of the bug on the line
	private boolean state = true;//Variable that shows which direction the bug is facing
	
	/**
	 * Bug method that constructors the object with where it will start
	 * @param initialPosition variable that tells us where on the line the Bug starts
	 */
	public Bug(int initialPosition)
	{
		this.position = initialPosition;
	}
	/**
	 * Move method that moves the bug left or right depending on which way the bug is facing
	 */
	public void move()
	{
		if(state == true)
		{
			position += 1;
		}
		if(state == false)
		{
			position -=1;
		}
	}
	/**
	 * Turn method that changes which direction the bug is facing 
	 */
	public void turn()
	{
		state = !state;
	}
	/**
	 * getPosition method that tells you the location of the bug on the line
	 * @return position which is the location of the bug on the line
	 */
	public int getPosition()
	{
		return position;
	}

}
