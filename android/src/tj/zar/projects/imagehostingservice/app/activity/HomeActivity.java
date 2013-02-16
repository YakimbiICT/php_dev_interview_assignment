package tj.zar.projects.imagehostingservice.app.activity;

import tj.zar.java.patterns.common.Command;
import tj.zar.projects.imagehostingservice.app.controller.AddDescriptionCommand;
import tj.zar.projects.imagehostingservice.app.controller.AddFavoriteCommand;
import tj.zar.projects.imagehostingservice.app.controller.FillFavoriteImagesCommand;
import tj.zar.projects.imagehostingservice.app.controller.FillRandomImagesCommand;
import tj.zar.projects.imagehostingservice.app.controller.LoadImagesCommand;
import tj.zar.projects.imagehostingservice.app.controller.RemoveFavoriteCommand;
import tj.zar.projects.imagehostingservice.app.controller.ShowMessageCommand;
import tj.zar.projects.imagehostingservice.app.model.ImageHostingServiceProxy;
import tj.zar.projects.imagehostingservice.app.model.ImageHostingServiceProxyImpl;
import tj.zar.projects.imagehostingservice.app.view.HomeActivityViewMediator;
import tj.zar.projects.imagehostingservice.app.view.HomeActivityViewMediatorImpl;
import android.app.Activity;
import android.os.Bundle;

/**
 * Main application activity. Shows both favorite and random image lists,
 * communicates with remote server.
 * 
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
public class HomeActivity extends Activity {

	// -----------------------------------------------
	// Private fields
	// -----------------------------------------------

	/**
	 * View mediator of the current activity.
	 */
	private HomeActivityViewMediator viewMediator;
	
	/**
	 * Proxy to the ImageHostingService.
	 */
	private ImageHostingServiceProxy imageServiceProxy;
	
	// Commands

	/**
	 * Generates new random images from the Flikr image service.
	 */
	private Command generateFlikrCommand;
	
	/**
	 * Generates new random images from the Instagram image service.
	 */
	private Command generateInstagramCommand;
	
	/**
	 * Fills list view with random (non-favorite) images.
	 */
	private Command fillRandomImagesCommand;

	/**
	 * Fills list view with favorite images.
	 */
	private Command fillFavoriteImagesCommand;
	
	/**
	 * Shows information message if error occur.
	 */
	private Command showMessageCommand;

	/**
	 * Loads list of random (non-favorite) images.
	 */
	private Command loadRandomImagesCommand;

	/**
	 * Loads list of favorite images.
	 */
	private Command loadFavoriteImagesCommand;

	/**
	 * This command adds description to the images.
	 */
	private Command addDescriptionCommand;
	
	/**
	 * This command adds image to the favorite images list.
	 */
	private Command addFavoriteCommand;
	
	/**
	 * This command removes image from favorite images list.
	 */
	private Command removeFavoriteCommand;

	// -----------------------------------------------
	// Overridden methods (from Activity)
	// -----------------------------------------------

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		 
		// initialize view & model
		viewMediator 		= new HomeActivityViewMediatorImpl(this);
		imageServiceProxy 	= new ImageHostingServiceProxyImpl(this);
		
		// setup view commands
		viewMediator.setGenerateFlikrCommand(generateFlikrImagesCommand());
		viewMediator.setGenerateInstagramCommand(generateInstagramImagesCommand());
		viewMediator.setAddDescriptionCommand(addDescriptionCommand());
		viewMediator.setAddFavoriteCommand(addFavoriteCommand());
		viewMediator.setRemoveFavoriteCommand(removeFavoriteCommand());
		
		// execute default commands
		loadRandomImagesCommand().execute(null);
		loadFavoriteImagesCommand().execute(null);
	}

	// -----------------------------------------------
	// Commands (Mini Controllers)
	// -----------------------------------------------

	/**
	 * Gets command that loads list of random (non-favorite) images.
	 * 
	 * @return load list of random (non-favorite) images command
	 */
	private Command loadRandomImagesCommand() {
		if (loadRandomImagesCommand == null)
			loadRandomImagesCommand = new LoadImagesCommand(	LoadImagesCommand.RANDOM_IMAGES,
																imageServiceProxy,
																fillRandomImagesCommand(),
																showMessageCommand());
		return loadRandomImagesCommand;
	}

	/**
	 * Gets command that loads list of favorite images.
	 * 
	 * @return load list of favorite images command
	 */
	private Command loadFavoriteImagesCommand() {
		if (loadFavoriteImagesCommand == null)
			loadFavoriteImagesCommand = new LoadImagesCommand(	LoadImagesCommand.FAVORITE_IMAGES,
																imageServiceProxy,
																fillFavoriteImagesCommand(),
																showMessageCommand());
		
		return loadFavoriteImagesCommand;
	}

	/**
	 * Gets command that generates new random images from the Flikr image
	 * service.
	 * 
	 * @return generate new random images from the Flikr image service command
	 */
	private Command generateFlikrImagesCommand() {
		if (generateFlikrCommand == null)
			generateFlikrCommand = new LoadImagesCommand(	LoadImagesCommand.GENERATE_FLIKR,
															imageServiceProxy,
															fillRandomImagesCommand(),
															showMessageCommand());
		
		return generateFlikrCommand;
	}

	/**
	 * Gets command that generates new random images from the Instagram image
	 * service.
	 * 
	 * @return generate new random images from the Instagram image service
	 *         command
	 */
	private Command generateInstagramImagesCommand() {
		if (generateInstagramCommand == null)
			generateInstagramCommand = new LoadImagesCommand(	LoadImagesCommand.GENERATE_INSAGRAM,
																imageServiceProxy,
																fillRandomImagesCommand(),
																showMessageCommand());
		
		return generateInstagramCommand;
	}

	/**
	 * Gets command that fills list view with random (non-favorite) images.
	 * 
	 * @return fill list view with random (non-favorite) images command
	 */
	private Command fillRandomImagesCommand() {
		if (fillRandomImagesCommand == null)
			fillRandomImagesCommand = new FillRandomImagesCommand(viewMediator);
		
		return fillRandomImagesCommand;
	}

	/**
	 * Gets command that fills list view with favorite images.
	 * 
	 * @return fill list view with favorite images command
	 */
	private Command fillFavoriteImagesCommand() {
		if (fillFavoriteImagesCommand == null)
			fillFavoriteImagesCommand = new FillFavoriteImagesCommand(viewMediator);
		
		return fillFavoriteImagesCommand;
	}

	/**
	 * Gets command that shows information message if error occur.
	 * 
	 * @return show information message if error occur command
	 */
	private Command showMessageCommand() {
		if (showMessageCommand == null)
			showMessageCommand = new ShowMessageCommand(viewMediator);
		
		return showMessageCommand;
	}

	/**
	 * Gets command that adds description to the images.
	 * 
	 * @return add description command
	 */
	private Command addDescriptionCommand() {
		if (addDescriptionCommand == null)
			addDescriptionCommand = new AddDescriptionCommand(imageServiceProxy);
		
		return addDescriptionCommand;
	}

	/**
	 * Gets command that adds image to the favorite images list.
	 * 
	 * @return add image to the favorite command
	 */
	private Command addFavoriteCommand() {
		if (addFavoriteCommand == null)
			addFavoriteCommand = new AddFavoriteCommand(imageServiceProxy);

		return addFavoriteCommand;
	}

	/**
	 * Gets command that removes image to the favorite images list.
	 * 
	 * @return remove image to the favorite command
	 */
	private Command removeFavoriteCommand() {
		if (removeFavoriteCommand == null)
			removeFavoriteCommand = new RemoveFavoriteCommand(imageServiceProxy);
		
		return removeFavoriteCommand;
	}
	
}
