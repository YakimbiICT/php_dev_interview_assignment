package tj.zar.projects.imagehostingservice.app.view;

import tj.zar.java.patterns.common.Command;
import tj.zar.projects.imagehostingservice.app.activity.HomeActivity;
import tj.zar.projects.imagehostingservice.app.model.vo.ImageVo;

/**
 * Mediator between {@link HomeActivity} layout view and {@link HomeActivity}.
 * Controls all view operations of the {@link HomeActivity}.
 * 
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
public interface HomeActivityViewMediator {

	/**
	 * Sets command to execute generate images from flikr service event.
	 * 
	 * @param command
	 *            - {@link Command} to be executed when "generate flikr images"
	 *            button clicked
	 */
	void setGenerateFlikrCommand(Command command);

	/**
	 * Sets command to execute generate images from Instagram service event.
	 * 
	 * @param command
	 *            - {@link Command} to be executed when
	 *            "generate Instagram images" button clicked
	 */
	void setGenerateInstagramCommand(Command command);

	/**
	 * Fills the view component with given favorite images.
	 * 
	 * @param images
	 *            - favorite images array
	 */
	void fillFavoriteImages(ImageVo[] images);

	/**
	 * Fills the view component with given random images.
	 * 
	 * @param images
	 *            - random images array
	 */
	void fillRandomImages(ImageVo[] images);

	/**
	 * Shows simple message to the user.
	 * 
	 * @param msg
	 *            - message to be shown
	 */
	void showMessage(String msg);

	/**
	 * Sets command to execute when add description button clicked.
	 * 
	 * @param command
	 *            - {@link Command} to be executed when add description button
	 *            clicked.
	 */
	void setAddDescriptionCommand(Command command);

	/**
	 * Sets command to execute when add image to favorite button clicked.
	 * 
	 * @param command
	 *            - {@link Command} to be executed when add image to favorite
	 *            button clicked.
	 */
	void setAddFavoriteCommand(Command command);

	/**
	 * Sets command to execute when remove image from favorite list button
	 * clicked.
	 * 
	 * @param command
	 *            - {@link Command} to be executed when remove image from
	 *            favorite button clicked.
	 */
	void setRemoveFavoriteCommand(Command command);
	

}
