package tj.zar.projects.imagehostingservice.app.controller;

import tj.zar.java.patterns.common.Command;
import tj.zar.projects.imagehostingservice.app.model.ImageHostingServiceProxy;

/**
 * Loads images from the image hosting service.
 * 
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
public class LoadImagesCommand implements Command {

	// -----------------------------------------------
	// Constants
	// -----------------------------------------------

	/**
	 * If this type has been specified then command loads non-favorite (random)
	 * images.
	 */
	public static final String RANDOM_IMAGES 		= "random";

	/**
	 * If this type has been specified then command loads favorite images.
	 */
	public static final String FAVORITE_IMAGES 		= "favorite";

	/**
	 * If this type has been specified then command sends request to generate
	 * images from the Flikr and loads new generated images.
	 */
	public static final String GENERATE_FLIKR 		= "flikr";

	/**
	 * If this type has been specified then command sends request to generate
	 * images from the Insagram and loads new generated images.
	 */
	public static final String GENERATE_INSAGRAM 	= "insagram";

	// -----------------------------------------------
	// Private fields
	// -----------------------------------------------

	/**
	 * Type of images loading. See {@link #RANDOM_IMAGES},
	 * {@link #FAVORITE_IMAGES}, {@link #GENERATE_FLIKR} and
	 * {@link #GENERATE_INSAGRAM} load types.
	 */
	private String type;

	/**
	 * Image Hosting Service proxy used to set new description.
	 */
	private ImageHostingServiceProxy imageServiceProxy;
	
	/**
	 * Command to be executed when load finished.
	 */
	private Command successCommand;
	
	/**
	 * Command to be executed when error occur while loading.
	 */
	private Command errorCommand;

	// -----------------------------------------------
	// Constructors
	// -----------------------------------------------

	/**
	 * 
	 * @param type
	 *            - load type. Can be {@link #RANDOM_IMAGES},
	 *            {@link #FAVORITE_IMAGES}, {@link #GENERATE_FLIKR} or
	 *            {@link #GENERATE_INSAGRAM}
	 * @param imageServiceProxy
	 *            - Image Hosting Service proxy used to set new description
	 * @param successCommand
	 *            - command to be executed when load finished
	 * @param errorCommand
	 *            - command to be executed when error occur while loading
	 */
	public LoadImagesCommand(String type,
			ImageHostingServiceProxy imageServiceProxy, Command successCommand,
			 					Command errorCommand) {
		this.type			 	= type;
		this.imageServiceProxy 	= imageServiceProxy;
		this.successCommand 	= successCommand;
		this.errorCommand 		= errorCommand;
	}

	// -----------------------------------------------
	// Overridden methods (from Command)
	// -----------------------------------------------

	@Override
	public void execute(Object data) {
		
		if (type.equals(RANDOM_IMAGES)) 
			imageServiceProxy.obtainImages(successCommand, errorCommand);
		
		else if (type.equals(FAVORITE_IMAGES)) 
			imageServiceProxy.obtainFavoriteImages(successCommand, errorCommand);
		
		else if (type.equals(GENERATE_FLIKR)) 
			imageServiceProxy.generateFlikrImages(successCommand, errorCommand);
		
		else if (type.equals(GENERATE_INSAGRAM)) 
			imageServiceProxy.generateInstagramImages(successCommand, errorCommand);
		
	}
	
}
